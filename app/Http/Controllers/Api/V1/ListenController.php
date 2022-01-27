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
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Api\V1\UserController;
use App\Models\AnswerDetail;
use Symfony\Component\CssSelector\Parser\Shortcut\ElementParser;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Mail;
use Exception;
use App\Models\Log_mails;

class ListenController extends Controller
{

    private $user_id;
    private $user_name;
    private $exp_mentor_email;
    private $exp_mentor_name;
    private $notifyMentorSubject;

    public function __construct()
    {
        $user = Auth::user();
        if ($user) {
            $this->user_id = $user->id;
            $this->user_name = $user->first_name." ".$user->last_name;
            $this->exp_mentor_name = $user->exp_mentor_name;
            $this->exp_mentor_email = $user->exp_mentor_email;
        }

        $this->notifyMentorSubject = "Your Mentee's Progress";
    }

    public function userProgress($module_id)
    {
        $id = $this->user_id;
        $progress = DB::select('SELECT SUM(max_group) as total_page_read FROM 
                    (   
                        SELECT max(`group`) as max_group 
                        FROM `last_reads` WHERE user_id = '.$id.' AND module_id = '.$module_id.'
                        GROUP BY part_id
                    ) t');
        $total_progress = !empty($progress) ? $progress[0]->total_page_read : 0;

        $total_page = DB::select('SELECT SUM(jumlah_group) as total_page FROM 
                    (
                        SELECT max(`group`) as jumlah_group FROM parts p 
                        join elements e on e.part_id = p.id
                        join outlines o on o.id = p.outline_id
                        join modules m on m.id = o.module_id
                        where m.id = '.$module_id.'
                        GROUP BY p.id
                    ) t');
        $total_page = !empty($total_page) ? $total_page[0]->total_page : 0;
        $percentage = round($total_progress / $total_page * 100) == 0 ? 0 : $total_progress / $total_page * 100;

        return response()->json([
            'success' => true,
            'data' => array(
                'percentage' => $percentage
            )
        ]);
    }

    public function notifyMentor(Request $request)
    {
        if (!$this->exp_mentor_email) {
            return response()->json(['success' => true, 'error' => 'Haven\'t input mentor name']);
        }

        $data = array(
            'user_id'          => $this->user_id,
            'user_name'        => $this->user_name,
            'module_name'      => $request->module_name,
            'exp_mentor_name'  => $this->exp_mentor_name,
            'exp_mentor_email' => $this->exp_mentor_email
        );

        try {

            Mail::send('email.notifyMentor', $data, function ($message) {
                $message->from(getenv('MAIL_FROM_ADDRESS'), getenv('MAIL_FROM_NAME'));
                $message->to($this->exp_mentor_email, $this->exp_mentor_name);
                $message->subject($this->notifyMentorSubject);
            });

            return response()->json(['success' => true, 'message' => 'Message has been sent']);

        }catch (Exception $exception) {

            $log_mails = new Log_mails();
            $log_mails->mail_to = $this->exp_mentor_email;
            $log_mails->student = $this->user_name;
            $log_mails->message = $exception->getMessage();
            $log_mails->status = 'not sent';
            $log_mails->save();

            return response()->json(['success' => false, 'error' => $exception->getMessage()]);
        }

    }

    //************************* */
    //**** DASHBOARD USER *******/
    //************************* */

    public function lastRead()
    {
        return $this->algoLastRead($this->user_id);
    }

    public function algoLastRead($id)
    {
        $index = 0;
        $array = array();

        $last_read = LastRead::where('user_id', $id)->groupBy('module_id')->select('module_id')->orderBy('created_at', 'desc')->get();
        if (empty($last_read)) {
            return response()->json(['success' => true], 200);
        }

        foreach ($last_read as $read_module)
        {    
            //! cari part terakhir yg dibaca
            $query_latest_part = LastRead::join('parts', 'parts.id', '=', 'last_reads.part_id')
                                ->join('outlines', 'outlines.id', '=', 'parts.outline_id')
                                ->where('last_reads.user_id', $id)->where('last_reads.module_id', $read_module->module_id)
                                ->select(
                                    DB::raw('MAX(last_reads.part_id) as latest_part'), 
                                        'outlines.id', 'parts.title as part_name', 'outlines.name as outline_name',
                                        'last_reads.group as latest_group' 
                                        )->first();
            

            $latest_part = $query_latest_part->latest_part;
            $latest_group = $query_latest_part->latest_group;
            //// $query_next_part = Element::where('part_id', $latest_part)->whereIn('group', function ($query) use ($latest_group) {
            ////     return $query->select(DB::raw('MIN(`group`)'))->from('elements')->where('group', '>', $latest_group);
            //// })->first();
            
            // // //! kalau ada group berikutnya di dalam 1 part maka do this
            //// if (!empty($query_next_part)) {
            ////     $array[$index]['next_url'] = URL::to('api/v1').'/listen/element/'.$latest_part.'/'.$query_next_part->group;
            ////     $array[$index]['current_part_id'] = $latest_part;
            //// }

            $get_latest = Part::join('outlines', 'outlines.id', '=', 'parts.outline_id')
                                ->join('sections', 'sections.id', '=', 'outlines.section_id')
                                ->where('parts.id', $latest_part)
                                ->select('outlines.id', 'parts.title', 'outlines.name', 'sections.name as section_name')
                                ->first();
            

            // $array[$index]['current_part_id'] = $latest_part;
            $array[$index]['outline_id'] = $get_latest->id;
            $array[$index]['current_part_name'] = $get_latest->title;
            $array[$index]['current_outline_name'] = $get_latest->name;
            $array[$index]['section_name'] = $get_latest->section_name;
            //// $array[$index]['current_group'] = $query->latest_group; 

            $query_taken_date = DB::select('SELECT MIN(created_at) AS taken_date from last_reads WHERE user_id = '.$id.' AND module_id = '.$read_module->module_id);
            $taken_date = !empty($query_taken_date) ? $query_taken_date[0]->taken_date : null;
            $array[$index]['taken_date'] = $taken_date;   

            $progress = DB::select('SELECT SUM(max_group) as total_page_read FROM 
                        (   
                            SELECT max(`group`) as max_group 
                            FROM `last_reads` WHERE user_id = '.$id.' AND module_id = '.$read_module->module_id.'
                            GROUP BY part_id
                        ) t');
            $total_progress = !empty($progress) ? $progress[0]->total_page_read : 0;
            //// $array[$index]['total_progress'] = $total_progress;

            $modules = Module::join('categories', 'categories.id', '=', 'modules.category_id')
                            ->with('outlines')->with('outlines.parts')->where('modules.id', $read_module->module_id)->where('modules.status', 1)
                            ->select('modules.id', 'modules.module_name', 'modules.slug', 'categories.name as category_name')
                            ->get();
            foreach ($modules as $module) 
            {
                
                $module_id = $module->id;
                $module_name = $module->module_name;
                $array[$index]['module_id'] = $module_id;
                $array[$index]['module_name'] = $module_name;
                $array[$index]['slug'] = $module->slug;
                $array[$index]['category_name'] = $module->category_name;

                $total_page = DB::select('SELECT SUM(jumlah_group) as total_page FROM 
                (
                    SELECT max(`group`) as jumlah_group FROM parts p 
                    join elements e on e.part_id = p.id
                    join outlines o on o.id = p.outline_id
                    join modules m on m.id = o.module_id
                    where m.id = '.$module_id.'
                    GROUP BY p.id
                ) t');
                $total_page = !empty($total_page) ? $total_page[0]->total_page : 0;
                //// $array[$index]['jumlah_group'] = $total_page[0]->total_page;
                //// $array[$index]['percentage'] = $array[$index]['total_progress'] / $array[$index]['jumlah_group'] * 100;
                //// return $array;
                $array[$index]['percentage'] = round($total_progress / $total_page * 100) == 0 ? 0 : $total_progress / $total_page * 100;
            }
        $index++;
        }


        //* PISAHIN DATA SESUAI STATUS PROGRESS */
        $onprogress = $completed = array();
        foreach ($array as $item) {
            $percentage = isset($item['percentage']) ? $item['percentage'] : 0;
            if($percentage == 100) {
                $completed[] = $item;
            } else {
                $onprogress[] = $item;
            }
        }

        return array(
            'onprogress' => $onprogress,
            'completed' => $completed
        );
    }

    public function viewAnswer($module_slug)
    {
        $answer = Module::with([
            'outlines' => function($query) {
                $query->withAndWhereHas('parts', function ($query2) {
                    $query2->withAndWhereHas('elements', function ($query3) {
                        // $query3->withAndWhereHas('elementdetails', function ($query4) {
                            $query3->withAndWhereHas('answersdetails', function ($query5) {
                                $query5->where('user_id', $this->user_id);
                            });
                        // });
                    });
                });
            }
        ])->where('slug', $module_slug)->first();

        return response()->json($answer);
    }

    //**************************************** *//
    //******** MANAGE MODULE FUNCTION ******** *//
    //**************************************** *//

    public function getModuleContent($part_id, $group_id = "1")
    {

        $element = Element::query()->with(array('elementdetails' => function($query) {
                        $query->select('*')->orderByRaw('RAND()');
                    }))->where('group', $group_id)
                    ->where('part_id', $part_id)
                    ->orderBy('order', 'asc')
                    ->get();


        foreach ($element as $key => $value) {
            $element_id = $value['id'];
            switch ($value['category_element']) {
                case "blank":
                    $get_answers = Answers::where('user_id', $this->user_id)->where('element_id', $element_id)->first();
                    $element[$key]['answer'] = isset($get_answers['answer']) ? $get_answers['answer'] : null;
                    break;

                case "multiple":
                    $get_answers = Answers::where('user_id', $this->user_id)->where('element_id', $element_id)->first();
                    $element[$key]['answer'] = isset($get_answers['element_detail_id']) ? $get_answers['element_detail_id'] : null;
                    break;

                case "file":
                    $get_answers = Answers::where('user_id', $this->user_id)->where('element_id', $element_id)->first();
                    $element[$key]['answer'] = isset($get_answers['file_path']) ? $get_answers['file_path'] : null;
                    break;
            }
        }
        

        $cst_pagination = $this->createPagination($part_id, $group_id);
        $cst_pagination['data'] = $element;
        
        //! GET LAST READ
        $last_read = LastRead::where('group', $group_id)
                    ->where('part_id', $part_id)
                    ->where('user_id', $this->user_id)->first();
        if (isset($last_read)) {
            $read_id = $last_read->id;
            $cst_pagination['read_id'] = $read_id;
        }
        
        return $cst_pagination;
    }

    public function createPagination($part_id, $group_id)
    {
        $max_value_of_group = Element::where('part_id', $part_id)->max('group'); //jumlah group = jumlah page
        $max_value_of_group = isset($max_value_of_group) ? $max_value_of_group : 1;

        $current_page = $group_id;
        $next_page = $current_page + 1;
        $previous_page = $current_page - 1;
        $next_outline_id = $next_part_id = null;
        $next_page_url = $current_page != $max_value_of_group ? URL::to('api/v1').'/listen/element/'.$part_id.'/'.$next_page : null;

        //* THIS FUNCTION WILL RUN IF GROUP/PAGE HAS REACH THE END OF THE GROUP/PAGE OF THE PART
        if ($current_page == $max_value_of_group) 
        {

            //! QUERY TO GET $outline_id
            $query_get_outline = DB::table('parts')->whereIn('outline_id', function ($query) use ($part_id) {
                                    return $query->select('outline_id')->from('parts')->where('id', $part_id);
                                })->get();
            $outline_id = $query_get_outline[0]->outline_id;

            //! GET $module_id
            $get_module_id = Outline::where('id', $outline_id)->first();
            $module_id = $get_module_id->module_id;


            $query_get_next_part = DB::table('parts')->whereIn('id', function ($query) use ($part_id, $outline_id) {
                                        return $query->select(DB::raw('MIN(id)'))->from('parts')->where('id', '>', $part_id)->where('outline_id', $outline_id);
                                    })->select('id as next_part_id')->first();

            if (isset($query_get_next_part))
            {
                $next_part_id = $query_get_next_part->next_part_id;
                $next_page_url = URL::to('api/v1').'/listen/element/'.$next_part_id.'/1';
                
            }

            //! IF $next_part_id WAS THE LATEST PART IN $outline_id
            if (empty($query_get_next_part)) 
            {
                $query_get_next_outline = DB::table('outlines')->whereIn('id', function ($query) use ($outline_id, $module_id) {
                                            return $query->select(DB::raw('MIN(id)'))->from('outlines')->where('id', '>', $outline_id)->where('module_id', $module_id);
                                        })->select('id as next_outline_id')->first();
                
                $next_outline_id = isset($query_get_next_outline->next_outline_id) ? $query_get_next_outline->next_outline_id : null;
            }
        }

        return array(
            'current_page'    => $current_page,
            'data'            => null,
            'first_page_url'  => URL::to('api/v1').'/listen/element/'.$part_id.'/1',
            'from'            => $current_page,
            'last_page'       => $max_value_of_group,
            'last_page_url'   => URL::to('api/v1').'/listen/element/'.$part_id.'/'.$max_value_of_group,
            'next_page_url'   => $next_page_url,
            'path'            => URL::to('api/v1').'/listen/element/'.$part_id.'/'.$current_page,
            'per_page'        => null,
            'prev_page_url'   => $current_page > 1 ? URL::to('api/v1').'/listen/element/'.$part_id.'/'.$previous_page : null,
            'total'           => $max_value_of_group,
            'next_outline_id' => $next_outline_id
        ); 
    }

    public function getPartByOutlineId($outline_id)
    {

        $part = Part::selectRaw('
                            parts.id, parts.title as part_title, outlines.name as outline_name,
                            (SELECT MAX(`group`) FROM elements WHERE part_id = parts.id) as total_group,
                            (SELECT COUNT(*) FROM last_reads WHERE part_id = parts.id AND user_id = '.$this->user_id.') as total_read,
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

        // $persentase_keseluruhan = 0;
        // // $jumlah_part = 0;
        // foreach($outline as $outline_item){
        //     $part = Part::selectRaw('
        //                 parts.id, parts.title as part_title, outlines.name as outline_name,
        //                 (SELECT MAX(`group`) FROM elements WHERE part_id = parts.id) as total_group,
        //                 (SELECT COUNT(*) FROM last_reads WHERE part_id = parts.id AND user_id = '.$this->user_id.') as total_read,
        //                 (SELECT ROUND(total_read*100 / total_group)) as percentage
        //                 ')
        //         ->where('outline_id', $outline_item->id)
        //         ->join('outlines', 'outlines.id', '=', 'parts.outline_id')
        //         ->get();
        //     $jumlah_part = count($part);
            
        //     foreach ($part as $part_item) {
        //         $persentase_keseluruhan += $part_item->percentage;
        //     }
        // }

        // return $persentase_keseluruhan." dan ".$jumlah_part;

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
