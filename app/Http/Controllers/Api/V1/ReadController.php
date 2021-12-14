<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\LastRead;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Support\Facades\Log;

class ReadController extends Controller
{

    public function read(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id'    => 'required|numeric|exists:users,id',
            'module_id'  => 'required|numeric|exists:modules,id',
            'part_id'    => 'required|numeric|exists:parts,id',
            'element_id' => 'required|numeric|exists:elements,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->errors()], 400);
        }

        try {
        
            $data = array(
                'user_id'    => $request->user_id,
                'module_id'  => $request->module_id,
                'part_id'    => $request->part_id,
                'element_id' => $request->element_id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            );

            $last_reads = LastRead::create($data);

        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['success' => false, 'error' => 'Bad Request'], 400);
        }

        return response()->json(['success' => true, 'data' => compact('last_reads')], 201);
    }
}
