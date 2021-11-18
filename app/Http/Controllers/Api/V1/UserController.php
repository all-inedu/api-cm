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

class UserController extends Controller
{

    private $paginationStudent;

    public function __construct() {

        $this->paginationStudent = RouteServiceProvider::PAGINATION_PAGE_STUDENT;
    }
    
    public function getDataUser(Request $request)
    {

        $id = $request->id;
        try {
            if (is_numeric($id)) {
                $user = DB::table('users')->where('role_id', 1)->where('id', $request->id)->paginate($this->paginationStudent);
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

        if ( ($category) && ($value) ) {

            if ($category == "name") {

                $users = DB::table('users')->where('first_name', 'like', '%'.$value.'%')
                            ->orwhere('last_name', 'like', '%'.$value.'%')
                            ->paginate($this->paginationStudent);

            } else if ($category == "email") {

                $users = DB::table('users')->where('email', 'like', '%'.$value.'%')
                            ->paginate($this->paginationStudent);

            } else if ($category == "is_verified") {

                $users = DB::table('users')->where('is_verified', $value)
                            ->paginate($this->paginationStudent);

            } else {

                $users = DB::table('users')->paginate($this->paginationStudent);

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
