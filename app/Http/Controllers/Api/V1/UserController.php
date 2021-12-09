<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Exception;
use JWTAuth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Psy\CodeCleaner\ValidConstructorPass;
use App\Models\Login;

class UserController extends Controller
{

    private $paginationStudent;

    public function __construct() {

        $this->paginationStudent = RouteServiceProvider::PAGINATION_PAGE_STUDENT;
    }

    public function countUserWeekly()
    {
        // echo $date = date("Y-m-d",strtotime('monday this week')).' To '.date("Y-m-d",strtotime("sunday this week"));    
        $start_date = date("Y-m-d",strtotime('monday this week'));
        $end_date = date("Y-m-d",strtotime("sunday this week"));
        $data = array();

        for ($i = 0 ; $i < 7 ; $i++) {
            $data['register']['total_user'][] = User::where('role_id', 1)->where('created_at', date('Y-m-d', strtotime("+".$i." day", strtotime($start_date))))->count();
            $data['register']['day'][] = date('l', strtotime("+".$i." day", strtotime($start_date)));
            $data['register']['date'][] = date('d-m-Y', strtotime("+".$i." day", strtotime($start_date)));

            $data['login']['total_user'][] = Login::where('created_at', date('Y-m-d', strtotime("+".$i." day", strtotime($start_date))))->count();
            $data['login']['day'][] = date('l', strtotime("+".$i." day", strtotime($start_date)));
            $data['login']['date'][] = date('d-m-Y', strtotime("+".$i." day", strtotime($start_date)));
        }

        return compact('data');
    }

    public function countUserRegistered()
    {
        return User::where('role_id', '=', 1)->count();
    }
    
    public function getDataUser(Request $request)
    {

        $id = $request->id;
        try {
            if (is_numeric($id)) {

                $user = DB::table('users')->where('role_id', 1)->where('id', $request->id)->get();
            } else if ($id == null) {

                $user = DB::table('users')->where('role_id', 1)->paginate($this->paginationStudent);
            } else if ($id == "count"){

                $user = DB::table('users')->where('role_id', 1)->count();
            } else {

                return response()->json(['success' => false, 'error' => "Invalid Parameter"]);
            }
        } catch (Exception $e) {

            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }

        return response()->json(["success" => true, "data" => $user]);

    }

    public function filterUser(Request $request)
    {
        $category = $request->category;
        $value = $request->value;

        if ( (isset($category)) && (isset($value)) ) {

            if ($category == "name") {

                $users = DB::table('users')
                            ->where(function($query) use ($value) {
                                $query->where('first_name', 'like', '%'.$value.'%')
                                    ->orwhere('last_name', 'like', '%'.$value.'%');
                            })->where('role_id', 1)
                            ->paginate($this->paginationStudent);

            } else if ($category == "email") {

                $users = DB::table('users')->where('email', 'like', '%'.$value.'%')
                            ->where('role_id', 1)
                            ->paginate($this->paginationStudent);

            } else if ($category == "is_verified") {

                $value = ($value == "true" || $value == 1) ? 1 : 0;
                $users = DB::table('users')->where('is_verified', $value)
                            ->where('role_id', 1)
                            ->paginate($this->paginationStudent);

            } else {

                $users = DB::table('users')->where('role_id', 1)->paginate($this->paginationStudent);

            }

            return response()->json(['success' => true, 'data' => $users]);
        }

        return response()->json(['success' => false, "error" => "Invalid parameter"]);
    }

    public function getAuthenticatedUser()
    {
        try {

            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());
        }

        return response()->json(compact('user'));
    }
}
