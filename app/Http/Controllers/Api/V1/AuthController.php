<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use DateTime;
use Exception;
use Illuminate\Support\Facades\Log;
use App\Models\Login;

class AuthController extends Controller
{

    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login', 'register', 'checkToken']]);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        //Error messages
        $messages = [
            "email.exists" => "Email doesn't exists"
        ];

        $rules = [
            'email' => 'required|email|exists:users',
            'password' => 'required|min:6',
        ];

        $validator = Validator::make($credentials, $rules, $messages);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->errors()], 401);
        }

        try {
            // attempt to verify the credentials and create a token for the user
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['success' => false, 'error' => 'Wrong password'], 400);
                //! NOT USED BUT USABLE
                // return response()->json(['error' => 'We can\'t find an account with this credentials. Please make sure you entered the right information and you have verified your email address'], 400);
            }
        } catch (JWTException $e) {
            // something went wrong while attempting to encode the token
            return response()->json(['success' => false, 'error' => 'Failed to login, please try again.'], 500);
        }

        $currentUser = Auth::user();
        $currentUser['token'] = $token;

        Login::create([
            'user_id' => $currentUser->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        return response()->json(['success' => true, 'data' => $currentUser], 200);
    }

    public function logout(Request $request)
    {
        $validator = Validator::make($request->all(), ['token' => 'required']);
        if ($validator->fails()) {

            return response()->json(['success' => false, 'error' => $validator->errors()], 400);
        }
        
        try {
            JWTAuth::invalidate($request->input('token'));
            return response()->json(['success' => true, 'message'=> "You have successfully logged out."]);
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['success' => false, 'error' => 'Failed to logout, please try again.'], 500);
        }
    }

    public function register(Request $request)
    {
        //* CUSTOM VALIDATOR FOR BIRTHDAY *//
        Validator::extend('olderThan', function($attribute, $value, $parameters)
        {
            $minAge = ( ! empty($parameters)) ? (int) $parameters[0] : 13;
            return (new DateTime)->diff(new DateTime($value))->y >= $minAge;

            // or the same using Carbon:
            // return Carbon\Carbon::now()->diff(new Carbon\Carbon($value))->y >= $minAge;
        });

        //Error messages
        $messages = [
            "birthday.older_than" => "You must be 15 years old or above"
        ];

        $validator = Validator::make($request->all(), [
            'first_name'   => 'required|string|max:255',
            'last_name'    => 'required|string|max:255',
            'birthday'     => 'required|olderThan:14',
            'phone_number' => 'required|max:25',
            'role_id'      => 'required|integer',
            'email'        => 'required|string|email|max:255|unique:users',
            'password'     => 'required|string|min:6|confirmed',
        ], $messages);

        if ($validator->fails()) {

            return response()->json(['success' => false, 'error' => $validator->errors()], 400);
        }

        $name = $request->first_name.' '.$request->last_name;
        $email = $request->email;
        $password = $request->password;

        $user = User::create([
            'first_name'   => $request->get('first_name'),
            'last_name'    => $request->get('last_name'),
            'birthday'     => $request->get('birthday'),
            'phone_number' => $request->get('phone_number'),
            'role_id'      => $request->get('role_id'),
            'email'        => $request->get('email'),
            'password'     => Hash::make($request->get('password')),
        ]);

        $token = JWTAuth::fromUser($user);

        //! Generate verification Code
        $verification_code = rand(1000, 9999);

        DB::table('user_verifications')->insert([
            'user_id' => $user->id,
            'token' => $verification_code,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        try {
            $subject = "Please verify your email address.";
            Mail::send('email.verify', ['name' => $name, 'verification_code' => $verification_code],
                function($mail) use ($email, $name, $subject) {
                    $mail->from(getenv('FROM_EMAIL_ADDRESS'), "no-reply@all-inedu.com");
                    $mail->to($email, $name);
                    $mail->subject($subject);
                });
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
        

        return response()->json(compact('user', 'token'), 201);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 60
        ]);
    }

    public function checkToken()
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return response()->json(['status' => 'Token is Invalid']);
            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return response()->json(['status' => 'Token is Expired']);
            } else {
                return response()->json(['status' => 'Authorization Token not found']);
            }
        }
        return response()->json(['status' => 'Token is valid']);
    }
}
