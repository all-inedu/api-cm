<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Module;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Providers\RouteServiceProvider;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Database\QueryException;

use function PHPSTORM_META\type;

class ModuleController extends Controller
{
    private $paginationModule;

    public function __construct() {

        $this->paginationModule = RouteServiceProvider::PAGINATION_PAGE_MODULE;
    }

    public function findModuleByName(Request $request)
    {
        $keyword = $request->get('keyword');
        $module = DB::table('modules');

        if ($keyword != "") {
            try {
                $module = $module->where('module_name', 'like', '%'.$keyword.'%')->get();
                return response()->json(['success' => true, 'data' => $module]);

            } catch (Exception $e) {
                Log::error($e->getMessage());
                return response()->json(['success' => false, 'error' => 'Invalid Query'], 400);
            }
        }

        return response()->json(['success' => true, 'data' => $module->get()]);

    }
    
    public function list(Request $request)
    {
        $id = $request->id;

        $module = DB::table('modules');

        if ($id == null) {

            $module = $module->paginate($this->paginationModule);
            return response()->json(['success' => true, 'data' => $module], 200);
        }

        if (!is_numeric($id)) {
            
            return response()->json(['success' => false, 'error' => 'Invalid parameter'], 400);
        }

        $module = $module->where('id', $id)->paginate($this->paginationModule);
        return response()->json(['success' => true, 'data' => $module], 200);
        
    }
    
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'module_name' => 'required|string|max:255',
            'desc'        => 'required',
            'category_id' => 'required|numeric|exists:categories,id',
            'price'       => 'required',
            'thumbnail'   => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->errors()], 401);
        }

        if (Module::where('module_name', $request->get('module_name'))->exists()) {
            return response()->json(['success' => false, 'error' => 'Module name already exists.']);
        }

        $file = $fileName = $destinationPath = '';

        try {
            
            //* UNUSED *//
            // DB::table("CALL insert_module(
            //     '".$request->get('module_name')."',
            //     '".str_replace("'", "\'", $request->get('desc'))."',
            //     '".$request->get('category')."',
            //     '".$request->get('price')."',
            //     '".$request->get('status')."'
            // )");

            if($file = $request->hasFile('thumbnail')) {
             
                $file = $request->file('thumbnail') ;
                $fileName = $file->getClientOriginalName() ;
                $destinationPath = public_path().'/uploaded_file' ;
                $file->move($destinationPath,$fileName);
            }

            $array = [
                'module_name' => $request->module_name,
                'desc'        => $request->desc,
                'category_id' => $request->category_id,
                'price'       => $request->price,
                'thumbnail'   => $fileName,
                'status'      => $request->status
            ];

            //* USED *//
            Module::create($array);

        } catch (QueryException $e) {
            Log::error($e->getMessage());
            return response()->json(['success' => false, 'error' => 'Invalid Query'], 400);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'error' => 'Bad Request'], 400);

            Log::error($e->getMessage());
        }

        return response()->json(['success' => true, 'message' => 'Module has successfully stored'], 201);
    }
    
}
