<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use Exception;
use App\Models\Element;
use Illuminate\Support\Facades\Log;

class ElementController extends Controller
{
    public function list(Request $request)
    {
        return Element::with('parts')->get();
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'part_id'          => 'required|numeric|exists:parts,id',
            'category_element' => 'required|string|max:255',
            'description'      => 'required',
            'video_link'       => 'required|string|max:255',
            'image_path'       => 'required',
            'question'         => 'required',
            'order'            => 'required',
            'group'            => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->errors()], 401);
        }

        try {
            
            Element::create([
                'part_id'          => $request->part_id,
                'category_element' => $request->category_element,
                'description'      => $request->description,
                'video_link'       => $request->video_link,
                'image_path'       => $request->image_path,
                'question'         => $request->question,
                'total_point'      => 0,
                'order'            => $request->order,
                'group'            => $request->group
            ]);
        } catch (QueryException $qe) {

            Log::error($qe->getMessage());
            return response()->json(['success' => false, 'error' => 'Invalid Query'], 400);
        } catch (Exception $e) {
            
            Log::error($e->getMessage());

            return response()->json(['success' => false, 'error' => 'Bad Request'], 400);
        }

        return response()->json(['success' => true, 'message' => 'Element has successfully stored'], 201);
    }
}
