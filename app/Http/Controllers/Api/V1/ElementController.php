<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use Exception;
use App\Models\Element;
use App\Models\ElementDetail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ElementController extends Controller
{
    public function list(Request $request)
    {
        return Element::with('parts')->get();
    }

    public function store(Request $request)
    {

        // $data = array(
        //     'part_id' => 1,
        //     'data' => 
        //     array(
        //         'c_element'   => 'multiple',
        //         'description' => 'Ini contoh studi kasus', //value
        //         'video_link'  => null,
        //         'image_path'  => null,
        //         'question'    => 'Ini pertanyaannya',
        //         'total_point' => 0,
        //         'order'       => 1, //! INDEX ARRAY +1
        //         'group'       => 1, //! GET LAST GROUP NUMBER THEN +1
        //         'answer_in_array' => 
        //         array(
        //             'answer' => 'pilih A salah',
        //             'value'  => false
        //         ), array(
        //             'answer' => 'pilih B salah',
        //             'value'  => false
        //         ), array(
        //             'answer' => 'pilih C benar',
        //             'value'  => true
        //         ), array(
        //             'answer' => 'pilih D salah',
        //             'value'  => false
        //         )
        //     ), array(
        //         'c_element'   => 'image',
        //         'description' => null,
        //         'video_link'  => null,
        //         'image_path'  => '/uploaded_files/image.png', //file
        //         'question'    => null,
        //         'total_point' => 0,
        //         'order'       => 2, //! INDEX ARRAY +1
        //         'group'       => 1, //! GET LAST GROUP NUMBER THEN +1
        //         'answer_in_array' => array()
        //     ), array(
        //         'c_element'   => 'video',
        //         'description' => null,
        //         'video_link'  => 'https://123.com',
        //         'image_path'  => '/uploaded_files/image.png', //file
        //         'question'    => null,
        //         'total_point' => 0,
        //         'order'       => 2, //! INDEX ARRAY +1
        //         'group'       => 1, //! GET LAST GROUP NUMBER THEN +1
        //         'answer_in_array' => array()
        //     ), array(
        //         'c_element'   => 'file',
        //         'description' => 'lorem ipsum',
        //         'video_link'  => null,
        //         'image_path'  => '/uploaded_files/image.png', //file
        //         'question'    => null,
        //         'total_point' => 0,
        //         'order'       => 2, //! INDEX ARRAY +1
        //         'group'       => 1, //! GET LAST GROUP NUMBER THEN +1
        //         'answer_in_array' => array()
        //     ), array(
        //         'c_element'   => 'blank',
        //         'description' => 'lorem ipsum',
        //         'video_link'  => null,
        //         'image_path'  => '/uploaded_files/image.png', //file
        //         'question'    => null,
        //         'type_blank'  => 'is exactly',
        //         'total_point' => 0,
        //         'order'       => 2, //! INDEX ARRAY +1
        //         'group'       => 1, //! GET LAST GROUP NUMBER THEN +1
        //         'answer_in_array' => array()
        //     )
        // );

        // print("<pre>".print_r($data, true)."</pre>");exit;

        

        $validator = Validator::make($request->all(), [
            'part_id' => 'required|numeric|exists:parts,id',
            'module_id' => 'required|numeric|exists:modules,id',
            'data'    => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->errors()], 401);
        }
            
        try {
            $i = 1;
            $requestData = $request->data;
            foreach ($requestData as $data) 
            {

                $category = $data['c_element'];
                switch ($category) {
                    case "image":
                        $postData = array(
                            'module_id'        => $request->module_id,
                            'part_id'          => $request->part_id,
                            'category_element' => $request->category_element,
                            'description'      => $request->description,
                            'total_point'      => 0,
                            'order'            => $request->order,
                            'group'            => $request->group,
                            'file'             => $request->file('value')
                        );
                        $this->storeImage($postData);
                        break;

                    case "video":
                        $this->storeVideo();
                        break;

                    case "text":
                        $postData = array(
                            'part_id'          => $request->part_id,
                            'category_element' => $request->category_element,
                            'description'      => $request->description,
                            'video_link'       => null,
                            'image_path'       => null,
                            'question'         => null,
                            'total_point'      => 0,
                            'order'            => $i,
                            'group'            => 0, //$request->group
                            'details_data'     => null
                        );
                        return $this->storeText($postData);
                        $i++;
                        break;

                    case "file":
                        $this->storeFile();
                        break;

                    case "multiple":
                        $postData = array(
                            'part_id'          => $request->part_id,
                            'category_element' => $request->category_element,
                            'description'      => $request->description,
                            'video_link'       => null,
                            'image_path'       => null,
                            'question'         => null,
                            'total_point'      => 0,
                            'order'            => $request->order,
                            'group'            => $request->group,
                            'details_data'     => array(
                                        'answer_in_array' => $data->answer,
                                        'correct_answer' => $data->correct_answer
                                        )
                        );
                        $response = $this->storeMultipleChoice($postData);
                        break;

                    case "blank":
                        $this->storeFillInTheBlank();
                        break;
                }
                
            }

            
        } catch (QueryException $qe) {

            Log::error($qe->getMessage());
            return response()->json(['success' => false, 'error' => 'Invalid Query'], 400);
        } catch (Exception $e) {
            
            Log::error($e->getMessage());
            return response()->json(['success' => false, 'error' => 'Bad Request'], 400);
        }

        return response()->json(['success' => true, 'message' => 'Element has successfully stored'], 201);
    }

    private function storeImage($postData)
    {
        $module_id = $postData->module_id;

        //! IF INSERT DB WAS SUCCESS THEN UPLOAD FILE
        if($file = $postData->hasFile('file')) 
        {
            $file            = $postData->file('file') ;
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

        //! INSERT INTO ELEMENT MASTER
        try {
            $element = Element::create([
                'part_id'          => $postData->part_id,
                'category_element' => $postData->category_element,
                'description'      => $postData->description,
                'video_link'       => $postData->video_link,
                'image_path'       => $postData->image_path,
                'question'         => $postData->question,
                'total_point'      => 0,
                'order'            => $postData->order,
                'group'            => $postData->group
            ]);

            $element_id = $element->id();
        } catch (Exception $e) {
            DB::rollBack();
        }
    }

    private function storeVideo()
    {

    }

    private function storeText($postData)
    {
        //! INSERT INTO ELEMENT MASTER
        try {
            $element = Element::create([
                'part_id'          => $postData['part_id'],
                'category_element' => $postData['category_element'],
                'description'      => $postData['description'],
                'video_link'       => $postData['video_link'],
                'image_path'       => $postData['image_path'],
                'question'         => $postData['question'],
                'total_point'      => 0,
                'order'            => $postData['order'],
                'group'            => $postData['group']
            ]);
        
        } catch (QueryException $e) {
            return array('success' => false, 'error' => $e->getMessage());

        } catch (Exception $e) {
            return array('success' => false, 'error' => $e->getMessage());
        }
        
        return array('success' => true, 'message' => 'Element has successfuly inserted', 'data' => compact('element'));
    }

    private function storeFile()
    {

    }

    private function storeMultipleChoice($postData)
    {
        DB::beginTransaction();

        //! INSERT INTO ELEMENT MASTER
        try {
            $element = Element::create([
                'part_id'          => $postData->part_id,
                'category_element' => $postData->category_element,
                'description'      => $postData->description,
                'video_link'       => $postData->video_link,
                'image_path'       => $postData->image_path,
                'question'         => $postData->question,
                'total_point'      => 0,
                'order'            => $postData->order,
                'group'            => $postData->group
            ]);

            $element_id = $element->id();

        } catch (Exception $e) {
            DB::rollBack();
            return array('success' => false, 'error' => $e->getMessage());
        }

        //! IF ELEMENT MASTER HAS SUCCESSFULY INSERTED THEN GET THE ID AND INSERT ELEMENT DETAIL
        try {
            $answerInArray = $postData->details_data->answerInArray;
            $correctAnswer = $postData->correct_answer;
            if (!is_array($answerInArray)) {
                throw new Exception('Undefined multiple choice answer');
            }

            for ($i = 0 ; $i < count($answerInArray) ; $i++)
            {
                $the_answer[] = ElementDetail::create([
                    'element_id' => $element_id,
                    'answer' => $answerInArray[$i],
                    'value' => $correctAnswer == $i ? 1 : 0
                ]);
            }
            
        } catch (Exception $e) {
            DB::rollBack();
            return array('success' => false, 'error' => $e->getMessage());
        }

        DB::commit();

        return array('success' => true, 'message' => compact('element', 'the_answer'));
    }

    private function storeFillInTheBlank()
    {

    }
}
