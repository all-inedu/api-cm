<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\Outline;
use App\Models\Part;
use App\Models\Element;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class ListenController extends Controller
{
    public function getModuleBySlug($slug)
    {
        $module = Module::select('modules.*', 'categories.name as category_name')
                    ->join('categories', 'categories.id', '=', 'modules.category_id')
                    ->where('slug', $slug)->first();
        return response()->json(['success' => true, 'data' => compact('module')], 200);
    }

    public function getSectionDataBySlug($slug)
    {
        $outline = Outline::select('outlines.id', 'outlines.name as outline_name', 'sections.id as section_id', 'sections.name as section_name')
                    ->rightJoin('sections', 'sections.id', '=', 'outlines.section_id')
                    ->join('modules', 'modules.id', '=', 'outlines.module_id')
                    ->where('slug', $slug)->get();
        return response()->json(['success' => true, 'data' => compact('outline')], 200); 
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
                            (SELECT COUNT(*) FROM elements WHERE part_id = parts.id) as total_element,
                            (SELECT COUNT(*) FROM last_reads WHERE part_id = parts.id AND user_id = '.$user_id.') as total_read,
                            (SELECT ROUND(total_read*100 / total_element)) as percentage
                            ')
                    ->where('outline_id', $outline_id)
                    ->join('outlines', 'outlines.id', '=', 'parts.outline_id')
                    ->get();
                    
        return response()->json(['success' => true, 'data' => compact('part')], 200);
    }

    public function getModuleContent($part_id, $group_id = "1")
    {
        $element = Element::with('elementdetails')
                    ->where('group', $group_id)
                    ->where('part_id', $part_id)->orderBy('order', 'asc')->get();
                    
        //! COUNT GROUP BY $part_id
        $max_value_of_group = Element::where('part_id', $part_id)->max('group'); //jumlah group = jumlah pagex
        $current_page = $group_id;

        $cst_pagination = array(
            'current_page' => $current_page,
            'data' => $element,
            'first_page_url' => URL::to('api/v1').'listen/element/'.$part_id.'/1',
            'from' => $current_page,
            'last_page' => $max_value_of_group,
            'last_page_url' => URL::to('api/v1').'listen/element/'.$part_id.'/'.$max_value_of_group,
            'links' => [array(
                'url' => null,
                'label' => "&laquo; Previous",
                'active' => false,
            ), array(
                "url" => "http://127.0.0.1:8000/api/v1/listen/element/".$part_id."/".$current_page,
                "label" => $current_page,
                "active" => true
            ), array(
                'url' => null,
                'label' => "Next &raquo;",
                'active' => false,
            )],
            'next_page_url' => $current_page != $max_value_of_group ? URL::to('api/v1').'listen/element/'.$part_id.'/'.$current_page + 1 : null,
            'path' => URL::to('api/v1').'listen/element/'.$part_id.'/'.$current_page,
            'per_page' => null,
            'prev_page_url' => $current_page > 1 ? URL::to('api/v1').'listen/element/'.$part_id.'/'.$current_page - 1 : null,
            'to' => null,
            'total' => $max_value_of_group
        ); 
        return $cst_pagination;
    }
}
