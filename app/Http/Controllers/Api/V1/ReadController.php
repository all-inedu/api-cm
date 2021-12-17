<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Answers;
use App\Models\LastRead;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Providers\RouteServiceProvider;

class ReadController extends Controller
{

    private $maxSizeOfUploadedFile;

    public function __construct() {

        $this->maxSizeOfUploadedFile = RouteServiceProvider::MAX_SIZE_OF_UPLOADED_FILE;
    }

    public function read(Request $request)
    {
        $user = Auth::user();
        $user_id = $user->id;

        $validator = Validator::make($request->all(), [
            'module_id'  => 'required|numeric|exists:modules,id',
            'part_id'    => 'required|numeric|exists:parts,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->errors()], 400);
        }
        
        DB::beginTransaction();

        if ((!isset($request->read_id)) && ($request->read_id == NULL) ) {
            try {
                
                $parameters = array(
                    'module_id' => $request->module_id,
                    'part_id'   => $request->part_id,
                    'group'     => $request->group
                );

                if (array_key_exists("question", $request->all())) {

                    foreach ($request->question as $question) {

                        $category_element = $question['category_element'];
                        $element_id = $question['element_id'];
                        $data = [
                            'element_id'        => (int)$element_id,
                            'element_detail_id' => null,
                            'user_id'           => $user_id,
                            'answer'            => null,
                            'file_path'         => null,
                        ];
        
                        switch ($category_element) {
                            case "multiple":
                                $data['element_detail_id'] = $question['element_detail_id'];
                                break;
                            
                            case "blank":
                                $data['answer'] = $question['answer']; 
                                break;
        
                            case "file":
                                $file            = $question['file'];
                                $extension       = $file->getClientOriginalExtension();
                                $size            = $file->getSize();
                                $fileName        = 'uploaded_file/answer/'.$user_id.'/'.date('dmYHis').Str::random(5).".".$extension ;
                                $destinationPath = public_path().'/uploaded_file/answer/'.$user_id.'/';
        
                                if (file_exists(public_path($fileName))) {
                                    throw new Exception('Can\'t use same name. Filename already exists');
                                }
        
                                if ($size > $this->maxSizeOfUploadedFile) {
                                    throw new Exception('File size must be less than 20 Mb');   
                                }
        
                                $file->move($destinationPath,$fileName);
                                $data['file_path'] = $fileName;
                                break;
                        }
        
                        Answers::create($data);
                    }
                }
                    
                $this->saveToLastRead($parameters, $user_id);
                
                DB::commit();               

            } catch (Exception $e) {
                DB::rollBack();
                Log::error($e->getMessage());
                return response()->json(['success' => false, 'error' => $e->getMessage()], 400);
            }

            return response()->json(['success' => true, 'message' => 'success'], 201);
        }
    }

    public function saveToAnswer($parameters,  $user_id)
    {
        $index = 0;

        try {
            
            foreach ($parameters['question'] as $question) {

                $category_element = $question['category_element'];
                $element_id = $question['element_id'];
                $data = [
                    'element_id'        => (int)$element_id,
                    'element_detail_id' => 1,
                    'user_id'           => $user_id,
                    'answer'            => '123',
                    'file_path'         => '123',
                ];

                switch ($category_element) {
                    case "multiple":
                        $data['element_detail_id'] = $question['element_detail_id'];
                        break;
                    
                    case "blank":
                        $data['answer'] = $question['answer']; 
                        break;

                    case "file":
                        $file            = $question['file'];
                        $extension       = $file->getClientOriginalExtension();
                        $size            = $file->getSize();
                        $fileName        = 'uploaded_file/answer/'.$user_id.'/'.date('dmYHis').Str::random(5).".".$extension ;
                        $destinationPath = public_path().'/uploaded_file/answer/'.$user_id.'/';

                        if (file_exists(public_path($fileName))) {
                            throw new Exception('Can\'t use same name. Filename already exists');
                        }

                        if ($size > $this->maxSizeOfUploadedFile) {
                            throw new Exception('File size must be less than 20 Mb');   
                        }

                        $file->move($destinationPath,$fileName);
                        $data['file_path'] = $fileName;
                        break;
                }

                $answers = Answers::create($data);
            }
           

        } catch (Exception $e) {
            Log::error($e->getMessage());
            throw new Exception($e->getMessage());   
        }
        
        return $answers;
    }

    public function saveToLastRead($parameters, $user_id)
    {
        try { 
            $data = array(
                'user_id'    => $user_id,
                'module_id'  => $parameters['module_id'],
                'part_id'    => $parameters['part_id'],
                'group'      => $parameters['group'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            );
    
            $last_read = LastRead::create($data);

        } catch (Exception $e) {
            Log::error($e->getMessage());
            throw new Exception($e->getMessage());
        }
        return $last_read;
    }
}
