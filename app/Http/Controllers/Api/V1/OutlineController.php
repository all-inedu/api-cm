<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\Outline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class OutlineController extends Controller
{

    public function getListOutlineByModule(Request $request)
    {
        $module_id = $request->module_id;

        $outline = DB::table('outlines');

        if ( $module_id == null ) {
            return response()->json(['success' => false, 'error' => 'Invalid parameter'], 400);
        }

        if ( !is_numeric($module_id) ) {
            return response()->json(['success' => false, 'error' => 'Invalid parameter'], 400);
        }

        $outline = $outline->where('module_id', $module_id)->get();

        // $collection = collect($outline);
        // $grouped = $collection->groupBy('section_id');

        return response()->json(['success' => true, 'data' => $outline], 200);
        
    }
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'module_id'  => 'required|numeric|exists:modules,id',
            'section_id' => ['required', 'numeric', 'exists:sections,id',
                        Rule::unique('outlines')->where(function ($query) use ($request) {
                            return $query->where('module_id', $request->module_id)
                            ->where('section_id', $request->section_id);
                        })        
            ],
            'name'       => 'required|string|max:255'
            // 'desc'       => 'required'
        ]);

        if ($validator->fails()) 
        {
            if (Outline::where('module_id', $request->module_id)->where('section_id', $request->section_id)->exists()) {

                $updated_data = $this->update($request); 
                return response()->json(['success' => true, 'message' => 'Outline has successfully updated', 'data' => $updated_data], 201);
            }

            return response()->json(['success' => false, 'error' => $validator->errors()], 401);
        }

        // if (Outline::where('name', $request->get('name'))->exists()) {
        //     return response()->json(['success' => false, 'error' => 'Outline name already exists.']);
        // }

        try {
            
            $outline = Outline::create([
                'module_id'  => $request->module_id,
                'section_id' => $request->section_id,
                'name'       => $request->name,
                'desc'       => isset($request->desc) ? $request->desc : ''
            ]);

            $module = Module::findOrFail($request->module_id);
            $module->progress = 3;
            $module->save();
            
        } catch (QueryException $qe) {

            Log::error($qe->getMessage());
            return response()->json(['success' => false, 'error' => 'Invalid Query'], 400);
        } catch (Exception $e) {
            
            Log::error($e->getMessage());

            return response()->json(['success' => false, 'error' => 'Bad Request'], 400);
        }

        return response()->json(['success' => true, 'message' => 'Outline has successfully stored', 'data' => compact('outline')], 201);
    }

    public function update($outline_data)
    {
        try {
            
            $outline = Outline::updateOrCreate(
                ['module_id' => $outline_data->module_id, 'section_id' => $outline_data->section_id],
                ['name' => $outline_data->name]
            );

        } catch (QueryException $e) {

            Log::error($e->getMessage());
            return false;

        } catch (Exception $e) {

            Log::error($e->getMessage());
            return false;
        }

        return compact('outline');
    }
}
