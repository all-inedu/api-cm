<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OutlineController extends Controller
{
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'module_id'  => 'required|numeric',
            'section_id' => 'required|numeric',
            'name'       => 'required|string|max:255',
            'desc'       => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->errors()], 401);
        }
    }
}
