<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Answers;
use App\Models\Module;
use App\Models\Outline;
use App\Models\Part;
use App\Models\Element;
use App\Models\LastRead;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class ListenController extends Controller
{

    public function getModuleContent($part_id, $group_id = "1")
    {

        $user = Auth::user();
        $user_id = $user->id;

        $element = Element::with('elementdetails')
                    ->where('group', $group_id)
                    ->where('part_id', $part_id)->orderBy('order', 'asc')
                    ->get();

        $no = 1;
        $big_data = $element;   
        foreach ($element as $key => $value) {
            $element_id = $value['id'];
            switch ($value['category_element']) {
                case "blank":
                    $get_answers = Answers::where('user_id', $user_id)->where('element_id', $element_id)->first();
                    $element[$key]['answer'] = isset($get_answers['answer']) ? $get_answers['answer'] : null;
                    break;

                case "multiple":
                    $get_answers = Answers::where('user_id', $user_id)->where('element_id', $element_id)->first();
                    $element[$key]['answer'] = isset($get_answers['element_detail_id']) ? $get_answers['element_detail_id'] : null;
                    break;

                case "file":
                    $get_answers = Answers::where('user_id', $user_id)->where('element_id', $element_id)->first();
                    $element[$key]['answer'] = isset($get_answers['file_path']) ? $get_answers['file_path'] : null;
                    break;
            }
        }
        
                    
        //! COUNT GROUP BY $part_id
        $max_value_of_group = Element::where('part_id', $part_id)->max('group'); //jumlah group = jumlah pagex
        $current_page = $group_id;
        $next_page = $current_page + 1;
        $previous_page = $current_page - 1;

        $cst_pagination = array(
            'current_page' => $current_page,
            'data' => $element,
            'first_page_url' => URL::to('api/v1').'/listen/element/'.$part_id.'/1',
            'from' => $current_page,
            'last_page' => $max_value_of_group,
            'last_page_url' => URL::to('api/v1').'/listen/element/'.$part_id.'/'.$max_value_of_group,
            'next_page_url' => $current_page != $max_value_of_group ? URL::to('api/v1').'/listen/element/'.$part_id.'/'.$next_page : null,
            'path' => URL::to('api/v1').'/listen/element/'.$part_id.'/'.$current_page,
            'per_page' => null,
            'prev_page_url' => $current_page > 1 ? URL::to('api/v1').'/listen/element/'.$part_id.'/'.$previous_page : null,
            'total' => $max_value_of_group
        ); 
        
        //! GET LAST READ
        $last_read = LastRead::where('group', $group_id)
                    ->where('part_id', $part_id)
                    ->where('user_id', $user_id)->first();
        if (isset($last_read)) {
            $read_id = $last_read->id;
            $cst_pagination['read_id'] = $read_id;
        }
        
        return $cst_pagination;
    }

    public function getPartByOutlineId($outline_id)
    {
        $currentUser = Auth::user();
        if (!$currentUser) {
            return response()->json(['success' => false, 'message' => 'Bad Request'], 400);
        }
        $user_id = $currentUser->id;

        $part = Part::selectRaw('
                            parts.id, parts.title as part_title, outlines.name as outline_name,
                            (SELECT MAX(`group`) FROM elements WHERE part_id = parts.id) as total_group,
                            (SELECT COUNT(*) FROM last_reads WHERE part_id = parts.id AND user_id = '.$user_id.') as total_read,
                            (SELECT ROUND(total_read*100 / total_group)) as percentage
                            ')
                    ->where('outline_id', $outline_id)
                    ->join('outlines', 'outlines.id', '=', 'parts.outline_id')
                    ->get();
                    
        return response()->json(['success' => true, 'data' => compact('part')], 200);
    }

    public function getSectionDataBySlug($slug)
    {
        $outline = Outline::select('outlines.id', 'outlines.name as outline_name', 'sections.id as section_id', 'sections.name as section_name')
                    ->rightJoin('sections', 'sections.id', '=', 'outlines.section_id')
                    ->join('modules', 'modules.id', '=', 'outlines.module_id')
                    ->where('slug', $slug)->get();
        return response()->json(['success' => true, 'data' => compact('outline')], 200); 
    }
    
    public function getModuleBySlug($slug)
    {
        $module = Module::select('modules.*', 'categories.name as category_name')
                    ->join('categories', 'categories.id', '=', 'modules.category_id')
                    ->where('slug', $slug)->where('modules.status', 1)->first();
        return response()->json(['success' => true, 'data' => compact('module')], 200);
    }

}
