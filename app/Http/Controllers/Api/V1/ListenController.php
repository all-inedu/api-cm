<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\Outline;
use App\Models\Part;
use Illuminate\Http\Request;

class ListenController extends Controller
{
    public function getModuleBySlug($slug)
    {
        $module = Module::where('slug', $slug)->first();
        return response()->json(['success' => true, 'data' => $module], 200);
    }

    
}
