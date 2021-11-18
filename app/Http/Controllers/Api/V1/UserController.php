<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use JWTAuth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class UserController extends Controller
{

    
    
    public function getDataUser(Request $request)
    {

        
        $id = $request->id;
        try {
            if (is_numeric($id)) {
                $user = DB::table('users')->where('role_id', 1)->where('id', $request->id)->paginate(15);
            } else if ($id == null) {
                $user = DB::table('users')->where('role_id', 1)->paginate(15);
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
