<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Module;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ModuleController extends Controller
{
    
    //! FOR ADMIN
    public function list(Request $request)
    {
        $param = $request->param;
        if (($param == 1) || ($param == 0) || ($param == null)) {
            $module = DB::table('modules');

            switch (is_numeric($param)) {
                case (($param == 1) || ($param == 0)):
                    $module->where('status', $param);
                    break;
            }

            $module = $module->get();

            return response()->json(['success' => true, 'data' => $module], 200);
        }

        return response()->json(['success' => false, 'error' => 'Invalid parameter'], 400);
        
    }
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'module_name' => 'required|string|max:255',
            'desc'        => 'required',
            'category'    => 'required|string|max:255',
            'price'       => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->errors()], 401);
        }

        if (Module::where('module_name', $request->get('module_name'))->exists()) {
            return response()->json(['success' => false, 'error' => 'Module name already exists.']);
        }

        try {
            
            Module::create([
                'module_name' => $request->get('module_name'),
                'desc'        => $request->get('desc'),
                'category'    => $request->get('category'),
                'price'       => $request->get('price'),
                'status'      => $request->get('status')
            ]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'error' => 'Bad Request'], 400);

            Log::error($e->getMessage());
        }

        return response()->json(['success' => true, 'message' => 'Module has successfully stored'], 201);
    }
    //! FOR ADMIN
    
}
