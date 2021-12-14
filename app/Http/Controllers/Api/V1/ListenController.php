<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\Outline;
use App\Models\Part;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListenController extends Controller
{
    public function getModuleBySlug($slug)
    {
        $module = Module::where('slug', $slug)->first();
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
}
