<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Part;
use Illuminate\Database\QueryException;
use Exception;
use Illuminate\Support\Facades\Log;

class PartController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'outline_id' => 'required|numeric',
            'name'       => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->errors()], 401);
        }

        if (Part::where('name', $request->get('name'))->exists()) {
            return response()->json(['success' => false, 'error' => 'Part name already exists.']);
        }

        try {
            
            Part::create([
                'outline_id'  => $request->get('outline_id'),
                'name' => $request->get('name')
            ]);
        } catch (QueryException $qe) {

            Log::error($qe->getMessage());
            return response()->json(['success' => false, 'error' => 'Invalid Query'], 400);
        } catch (Exception $e) {
            
            Log::error($e->getMessage());

            return response()->json(['success' => false, 'error' => 'Bad Request'], 400);
        }

        return response()->json(['success' => true, 'message' => 'Part has successfully stored'], 201);
    }
}
