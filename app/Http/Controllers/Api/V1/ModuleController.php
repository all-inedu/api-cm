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
            'price'       => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->errors()], 401);
        }

        if (Module::where('module_name', $request->get('module_name'))->exists()) {
            return response()->json(['success' => false, 'error' => 'Module name already exists.']);
        }

        try {
            
            //* UNUSED *//
            // DB::table("CALL insert_module(
            //     '".$request->get('module_name')."',
            //     '".str_replace("'", "\'", $request->get('desc'))."',
            //     '".$request->get('category')."',
            //     '".$request->get('price')."',
            //     '".$request->get('status')."'
            // )");

            //* USED *//
            Module::create([
                'module_name' => $request->get('module_name'),
                'desc'        => $request->get('desc'),
                'category_id' => $request->get('category_id'),
                'price'       => $request->get('price'),
                'status'      => $request->get('status')
            ]);
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
