<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Element;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Module;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Providers\RouteServiceProvider;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Database\QueryException;
use PhpParser\Node\Stmt\Switch_;
use App\Models\Outline;
use App\Models\Part;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

use function PHPSTORM_META\type;

class ModuleController extends Controller
{
    private $paginationModule;

    public function __construct() {

        $this->paginationModule = RouteServiceProvider::PAGINATION_PAGE_MODULE;
    }

    public function preview($module_id)
    {
        $data = array();
        $module = Module::select('modules.*', 'categories.name as category_name')
                        ->join('categories', 'categories.id', '=', 'modules.category_id')->where('modules.id', $module_id)->get();
        foreach ($module as $item) {
            $data['module'] = array(
                'id'            => $item->id,
                'module_name'   => $item->module_name,
                'desc'          => $item->desc,
                'category_name' => $item->category_name,
                'price'         => $item->price,
                'thumbnail'     => $item->thumbnail,
                'status'        => $item->status,
                'progress'      => $item->progress,
                'slug'          => $item->slug
            );

            $outline_index = 0;
            $outline = Outline::select('outlines.*', 'sections.name as section_name')->where('module_id', $module_id)
                    ->join('sections', 'sections.id', '=', 'outlines.section_id')->get();
            foreach ($outline as $outline_item) {
                $data['module']['outline'][] = array(
                    'id' => $outline_item->id,
                    'section_name' => $outline_item->section_name,
                    'name' => $outline_item->name,
                    'desc' => $outline_item->desc
                );

                $part_index = 0;
                $part = Part::where('outline_id', $outline_item->id)->get();
                foreach ($part as $part_item) {
                    $data['module']['outline'][$outline_index]['part'][] = array(
                        'id' => $part_item->id,
                        'title' => $part_item->title
                    );

                    $element = Element::where('part_id', $part_item->id)->count();
                    $data['module']['outline'][$outline_index]['part'][$part_index]['total_element'] = $element;

                $part_index++;
                }

            $outline_index++;
            }

        }

        return $data;
    }

    public function countModuleByStatus() 
    {
        return array(
            'draft' => Module::where('status', 0)->count(),
            'publish' => Module::where('status', 1)->count(),
            'inactive' => Module::where('status', 2)->count()

        );
    }

    public function deactivateActivate(Request $request, $module_id)
    {
        $status = $request->status;

        try 
        {
            $module = Module::findOrFail($module_id);
            $module->status = $status;
            $module->save();
        } 
        catch (Exception $e) 
        {
            Log::error($e->getMessage());
            return response()->json(['success' => false, 'error' => 'Bad Request'], 400);
        }

        return response()->json(['success' => true, 'message' => 'Module has successfuly updated'], 200);
    }

    public function getDataModule(Request $request)
    {
        $outline = $module = $part = "";
        $module_id  = $request->module_id;
        $outline_id = $request->outline_id;
        $part_id    = $request->part_id;

        //** VALIDATION **/
        $unvalidated_data = array(
            'module_id'  => $module_id,
            'outline_id' => $outline_id,
            'part_id'    => $part_id
        );

        $rules = array(
            'module_id' => 'exists:modules,id',
        );

        if (($outline_id != null) || ($outline_id != 0)) {
            $rules['outline_id'] = 'exists:outlines,id';

            $outline = Outline::with('sections')
                        ->where('outlines.id', $outline_id)
                        ->orderBy('outlines.created_at', 'DESC')->get();
            $data['data_outline'] = $outline;
        }

        if (($part_id != null) || ($part_id != 0)) {
            $rules['part_id'] = 'exists:parts,id';
            
            $part = Part::with('outlines')
                        ->orderBy('parts.created_at', 'DESC')->get();
            $data['data_part'] = $part;
        }

        $validator = Validator::make($unvalidated_data, $rules);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->errors()], 401);
        }

        //** VALIDATION END **/

        $module = Module::where('modules.id', $module_id)
                        ->with('categories')
                        ->with('outlines')
                        ->orderBy('modules.created_at', 'DESC')->get();
        
            
        $data['data_module'] = $module;
        return $data;
    }

    public function findModuleByStatus (Request $request)
    {
        $status = $request->status;
        $module = DB::table('modules')
                    ->select('modules.*', 'categories.name as category_name')
                    ->join('categories', 'categories.id', '=', 'modules.category_id')
                    ->where('modules.status', $status)
                    ->paginate($this->paginationModule);
        $drafted_module   = Module::where('status', 0)->count();  //! 0 = Draft
        $published_module = Module::where('status', 1)->count();  //! 1 = Published
        $inactive_module  = Module::where('status', 2)->count();   //! 2 = Inactive
        $locked_module    = Module::where('status', 3)->count();  //! 3 = Locked
        return response()->json(['success' => true, 'data' => compact('module', 'drafted_module', 'published_module', 'inactive_module', 'locked_module')], 200);
    }

    public function findModuleByName(Request $request)
    {
        $drafted_module = $published_module = $inactive_module = 0;
        $keyword = $request->keyword;
        $status = $request->status;
        

        try {
            $module = DB::table('modules')
                    ->select('modules.*', 'categories.name as category_name')
                    ->join('categories', 'categories.id', '=', 'modules.category_id')
                    ->where('module_name', 'like', '%'.$keyword.'%');

            //! QUERY BY STATUS IF STATUS IS NOT NULL
            $module = isset($status) ? $module->where('modules.status', $status) : $module;
            $module = $module->paginate($this->paginationModule);

            $drafted_module   = Module::where('module_name', 'like', '%'.$keyword.'%')->where('status', 0)->count();  //! 0 = Draft
            $published_module = Module::where('module_name', 'like', '%'.$keyword.'%')->where('status', 1)->count();  //! 1 = Published
            $inactive_module  = Module::where('module_name', 'like', '%'.$keyword.'%')->where('status', 2)->count();   //! 2 = Inactive
            $locked_module    = Module::where('module_name', 'like', '%'.$keyword.'%')->where('status', 3)->count();   //! 3 = Locked

            return response()->json(['success' => true, 'data' => compact('module', 'drafted_module', 'published_module', 'inactive_module', 'locked_module')]);

        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['success' => false, 'error' => 'Invalid Query'], 400);
        }
        
        return response()->json(['success' => true, 'data' => compact('module', 'drafted_module', 'published_module', 'inactive_module', 'locked_module')]);

    }
    
    public function list(Request $request)
    {
        $id = $request->id;
        $drafted_module = $published_module = $inactive_module = 0;

        $module = DB::table('modules')
                    ->select('modules.*', 'categories.name as category_name')
                    ->join('categories', 'categories.id', '=', 'modules.category_id');

        if ($id == null) {

            $module = $module->paginate($this->paginationModule);
            $drafted_module   = Module::where('status', 0)->count();  //! 0 = Draft
            $published_module = Module::where('status', 1)->count();  //! 1 = Published
            $inactive_module  = Module::where('status', 2)->count();   //! 2 = Inactive
            $locked_module    = Module::where('status', 3)->count();  //! 3 = Locked
            return response()->json(['success' => true, 'data' => compact('module', 'drafted_module', 'published_module', 'inactive_module', 'locked_module')], 200);
        }

        if (!is_numeric($id)) {
            
            return response()->json(['success' => false, 'error' => 'Invalid parameter'], 400);
        }

        $module = $module->where('modules.id', $id)->get();

        return response()->json(['success' => true, 'data' => $module], 200);
        
    }
    
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'module_name' => 'required|string|max:255',
            'desc'        => 'required',
            'category_id' => 'required|numeric|exists:categories,id',
            'price'       => 'required|numeric'
            // 'thumbnail'   => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->errors()], 401);
        }

        if (!empty($request->module_id)) {
            $updated = $this->update($request);
            if ($updated['status_code'] == 201)
                return response()->json(['success' => true, 'message' => 'Module has successfully updated', 'data' => $updated['message']], 201);
            else
                return response()->json(['success' => false, 'error' => $updated['message']], 400);
        }

        if (Module::where('module_name', $request->module_name)->exists()) {
            return response()->json(['success' => false, 'error' => 'Module name already exists.']);
        }

        $file = $fileName = $destinationPath = null;

        DB::beginTransaction();
        //!INSERT CODE
        try {

            $array = [
                'module_name' => $request->module_name,
                'desc'        => $request->desc,
                'category_id' => $request->category_id,
                'price'       => $request->price,
                'thumbnail'   => null,
                'status'      => 0,
                'progress'    => 1, //! UPDATE PROGRESS
                'slug'        => Str::slug($request->module_name, '-')
            ];


            //* USED *//
            $module = Module::create($array);
            $module_id = $module->id;

        } catch (QueryException $e) {
            Log::error($e->getMessage());
            return response()->json(['success' => false, 'error' => 'Invalid Query'], 400);

        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['success' => false, 'error' => 'Bad Request'], 400);

        }

        //! IF INSERT DB WAS SUCCESS THEN UPLOAD FILE
        if($file = $request->hasFile('thumbnail')) 
        {
            $file            = $request->file('thumbnail') ;
            $extension       = $file->getClientOriginalExtension();
            $fileName        = 'uploaded_file/module/'.$module_id.'/'.date('dmYHis').".".$extension ;
            $destinationPath = public_path().'/uploaded_file/module/'.$module_id.'/';

            try {
                if (file_exists(public_path($fileName))) {
                    throw new Exception('Can\'t use same name. Filename already exists');
                }
            } catch (Exception $e) {
                DB::rollBack();
                return response()->json(['success' => false, 'error' => $e->getMessage()], 400);
            }

            $file->move($destinationPath,$fileName);
        }
        
        //! IF UPLOAD WAS SUCCESS THEN DO UPDATE TO SAVE THUMBNAIL PATH
        
        try {

            $module = Module::findOrFail($module_id);
            $module->thumbnail = $fileName;
            $module->save();

        } catch (QueryException $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return response()->json(['success' => false, 'error' => 'Invalid Query'], 400);
        }

        DB::commit();
        return response()->json(['success' => true, 'message' => 'Module has successfully stored', 'data' => compact('module')], 201);
    }

    public function update($module_data)
    {
        DB::beginTransaction();
        try {
            $module              = Module::findOrFail($module_data->module_id);
            $old_thumbnail       = $module->thumbnail;
            $module->module_name = $module_data->module_name;
            $module->desc        = $module_data->desc;
            $module->category_id = $module_data->category_id;
            $module->price       = $module_data->price;
            $module->slug        = Str::slug($module_data->module_name, '-');
            $module->save();
    
            $file = $fileName = $destinationPath = null;
    
            if($file = $module_data->hasFile('thumbnail')) 
            {
                $file = $module_data->file('thumbnail') ;
                $extension = $file->getClientOriginalExtension();
                $fileName = 'uploaded_file/module/'.$module_data->module_id.'/'.date('dmYHis').".".$extension ;
                $destinationPath = public_path().'/uploaded_file/module/'.$module_data->module_id.'/';

                //! CHECKING IF THERE'S A FILE INI THE DIRECTORY WITH $fileName
                if (file_exists(public_path($fileName))) {
                    throw new Exception('Can\'t use same name. Filename already exists');
                }

                //! CHECKING IF OLD FILE WAS THERE ON THE DIRECTORY AND NEED TO BE DELETED
                if (file_exists(public_path($old_thumbnail))) {
                    File::delete($old_thumbnail);
                }
                
                $file->move($destinationPath,$fileName);

                $module = Module::findOrFail($module_data->module_id);
                $module->thumbnail = $fileName;
                $module->save();
            }
            DB::commit();
        
        } catch (QueryException $e) {

            DB::rollBack();
            Log::error($e->getMessage());
            return array(
                'status_code' => 400,
                'message' => $e->getMessage()
            );

        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return array(
                'status_code' => 400,
                'message' => $e->getMessage()
            );
        }

        return array(
            'status_code' => 201,
            'message' => compact('module')
        );
    }
    
}
