<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\EmailReset;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Log;
use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    private $user_id;

    public function __construct() 
    {
        $user = Auth::user();
        if ($user) {
            $this->user_id = $user->id;
        }
    }

    public function changePassword(Request $request)
    {

        $old_password = $request->old_password;
        $password = $request->password;

        $user = User::find($this->user_id);
        if (is_null($user)) {
            return response()->json(['success' => false, 'error' => 'User not found'], 400);
        }

        $validator = Validator::make($request->all(), [
            'old_password' => 'required|string|min:6',
            'password' => 'required|string|min:6|confirmed'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->errors()], 400);
        }

        $password_check = Hash::check($old_password, $user->password);
        if (!$password_check) {
            return response()->json(['success' => false, 'error' => 'Wrong password'], 400);
        }

        try {

            $user->password = Hash::make($password);
            $user->save();

        } catch (Exception $e) {
            
            Log::error('#'.$this->user_id.' Change Password : '.$e->getMessage());
            return response()->json(['success' => false, 'error' => 'Something went wrong. Please try again.'], 400);

        }

        return response()->json([
            'success'=> true,
            'message'=> 'Your password has successfully changed.'
        ], 200);

    }

    public function verifyAndChangeEmail($verification_code)
    {
        $check = EmailReset::where('token', $verification_code)->first();

        if(!is_null($check)){

            DB::beginTransaction();
            try { 
                $user_inf = User::find($this->user_id);
                $user_inf->email = $check->email;
                $user_inf->save();
    
                EmailReset::where('token',$verification_code)->delete();
                DB::commit();
            } catch (Exception $e) {
                DB::rollBack();
                Log::error('#'.$this->user_id.' Verify and Change Email : '.$e->getMessage());
                return response()->json(['success' => false, 'error' => 'Something went wrong. Please try again.'], 400);
            }
            
            return response()->json([
                'success'=> true,
                'message'=> 'Your email address has successfully changed.'
            ], 200);
        }

        return response()->json(['success'=> false, 'error'=> "Verification code is invalid."]);
    }

    public function requestChangeEmail(Request $request)
    {
        $new_email = $request->email;
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|unique:users'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->errors()], 400);
        }

        //! Generate verification Code
        $verification_code = rand(1000, 9999);

        $user = Auth::user();
        $name = $user->first_name.' '.$user->last_name;

        try {

            EmailReset::where('user_id', $this->user_id)->delete();

            $email_reset = new EmailReset;
            $email_reset->user_id = $this->user_id;
            $email_reset->email = $new_email;
            $email_reset->token = $verification_code;
            $email_reset->save();

            $subject = "Email Change Verification";
            Mail::send('email.changeMailAddress', ['name' => $name, 'verification_code' => $verification_code],
                function($mail) use ($new_email, $name, $subject) {
                    $mail->from(getenv('MAIL_FROM_ADDRESS'), getenv('MAIL_FROM_NAME'));
                    $mail->to($new_email, $name);
                    $mail->subject($subject);
                });
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['success' => false, 'error' => 'Something went wrong. Please try again.'], 400);
        }

        return response()->json(['success' => true, 'message' => 'Mail has been sent'], 200);
    }

    public function profileUser()
    {
        $user = User::where('id', $this->user_id)->get();
        return response()->json(['data' => compact('user')], 200);
    }

    public function updateProfileUser(Request $request)
    {
        
        $user = User::findOrFail($this->user_id);
        $fileName = $old_profile_picture = $user->profile_picture;

        //* CUSTOM VALIDATOR FOR BIRTHDAY *//
        Validator::extend('olderThan', function($attribute, $value, $parameters)
        {
            $minAge = ( ! empty($parameters)) ? (int) $parameters[0] : 13;
            return (new DateTime)->diff(new DateTime($value))->y >= $minAge;
        });

        //Error messages
        $messages = [
            "birthday.older_than" => "You must be 15 years old or above"
        ];

        $validator = Validator::make($request->all(), [
            'first_name'   => 'required|string|max:255',
            'last_name'    => 'required|string|max:255',
            'birthday'     => 'required|olderThan:14',
            'phone_number' => 'required|min:10|max:25',
            'address'      => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->errors()], 400);
        }

        DB::beginTransaction();

        if($file = $request->hasFile('profile_picture')) 
        {
            $file            = $request->file('profile_picture') ;
            $extension       = $file->getClientOriginalExtension();
            $fileName        = 'uploaded_file/user/'.$this->user_id.'/'.date('dmYHis').".".$extension ;
            $destinationPath = public_path().'/uploaded_file/user/'.$this->user_id.'/';

            try {
                if (file_exists(public_path($fileName))) {
                    throw new Exception('Can\'t use same name. Filename already exists');
                }

                //! CHECKING IF OLD FILE WAS THERE ON THE DIRECTORY AND NEED TO BE DELETED
                if (file_exists(public_path($old_profile_picture))) {
                    File::delete($old_profile_picture);
                }
            } catch (Exception $e) {
                DB::rollBack();
                return response()->json(['success' => false, 'error' => $e->getMessage()], 400);
            }

            $file->move($destinationPath,$fileName);
        }

        try {

            $user->first_name   = $request->first_name;
            $user->last_name    = $request->last_name;
            $user->birthday     = $request->birthday;
            $user->phone_number = $request->phone_number;
            $user->address      = $request->address;
            $user->profile_picture = $fileName;
            $user->save();

        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Update Profile : '.$e->getMessage());
            return response()->json(['success' => false, 'error' => 'Something went wrong. Please try again.']);
        }

        
        DB::commit();

        return response()->json(['success' => true, 'data' => compact('user')], 200);
    }
}
