<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Module;
use Exception;

class ModuleController extends Controller
{
    
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

        try {
            
            Module::create([
                'module_name' => $request->get('module_name'),
                'desc'        => $request->get('desc'),
                'category'    => $request->get('category'),
                'price'       => $request->get('price'),
                'status'      => $request->get('status')
            ]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }

        return response()->json(['success' => true, 'message' => 'Module has successfully stored'], 201);


    }
}
