<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Part;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Exception;
use Illuminate\Support\Facades\Log;

class PartController extends Controller
{
    public function list(Request $request)
    {
        $outline_id = $request->outline_id;
        switch ($outline_id)
        {
            case "all":
                return Part::getQuery()->orderBy('created_at', 'asc')->get();
                break;
            
            case (is_numeric($outline_id) && $outline_id != 0):
                $part = Part::where('outline_id', $outline_id)->orderBy('created_at', 'asc')->get();
                return compact('part');
                break;
        }
        
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'outline_id' => 'required|numeric|exists:outlines,id',
            'title'      => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->errors()], 401);
        }

        if (!empty($request->part_id)) {
            $updated = $this->update($request);
            if ($updated)
                return response()->json(['success' => true, 'message' => 'Part has successfully updated', 'data' => $updated], 201);
            else
                return response()->json(['success' => false, 'error' => 'Invalid Query'], 400);
        }

        if (Part::where('title', $request->get('title'))->exists()) {
            return response()->json(['success' => false, 'error' => 'Part title already exists.']);
        }

        try {
            
            $part = Part::create([
                'outline_id' => $request->get('outline_id'),
                'title'       => $request->get('title'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        } catch (QueryException $qe) {

            Log::error($qe->getMessage());
            return response()->json(['success' => false, 'error' => 'Invalid Query'], 400);
        } catch (Exception $e) {
            
            Log::error($e->getMessage());

            return response()->json(['success' => false, 'error' => 'Bad Request'], 400);
        }

        return response()->json(['success' => true, 'message' => 'Part has successfully stored', 'data' => compact('part')], 201);
    }

    public function update($part_data)
    {
        try 
        {    
            $part = Part::find($part_data->part_id);
            $part->title = $part_data->title;
            $part->save();
        
        } catch (QueryException $e) {

            Log::error($e->getMessage());
            return false;

        } catch (Exception $e) {

            Log::error($e->getMessage());
            return false;

        }

        return compact('part');
    }

    public function delete (Request $request)
    {
        $part_id = $request->part_id;
        try {

            $part = Part::findOrFail($part_id);
            $part_name = $part->title;
            $part->delete();
            
        } catch (QueryException $e) {
            Log::error($e->getMessage());
            return response()->json(['success' => false, 'error' => 'Invalid Query'], 400);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['success' => false, 'error' => 'Bad Request'], 400);
        }
        
        return response()->json(['success' => true, 'message' => 'Part : '.$part_name.' has successfully deleted'], 200);
    }
}
