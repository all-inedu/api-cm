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

        $data = array(
            'part_id' => 1,
            'data' => 
            array(
                'c_element'   => 'multiple',
                'description' => 'Ini contoh studi kasus', //value
                'video_link'  => null,
                'image_path'  => null,
                'question'    => 'Ini pertanyaannya',
                'total_point' => 0,
                'order'       => 1, //! INDEX ARRAY +1
                'group'       => 1, //! GET LAST GROUP NUMBER THEN +1
                'answer_in_array' => 
                array(
                    'answer' => 'pilih A salah',
                    'value'  => false
                ), array(
                    'answer' => 'pilih B salah',
                    'value'  => false
                ), array(
                    'answer' => 'pilih C benar',
                    'value'  => true
                ), array(
                    'answer' => 'pilih D salah',
                    'value'  => false
                )
            ), array(
                'c_element'   => 'image',
                'description' => null,
                'video_link'  => null,
                'image_path'  => '/uploaded_files/image.png', //file
                'question'    => null,
                'total_point' => 0,
                'order'       => 2, //! INDEX ARRAY +1
                'group'       => 1, //! GET LAST GROUP NUMBER THEN +1
                'answer_in_array' => array()
            ), array(
                'c_element'   => 'video',
                'description' => null,
                'video_link'  => 'https://123.com',
                'image_path'  => '/uploaded_files/image.png', //file
                'question'    => null,
                'total_point' => 0,
                'order'       => 2, //! INDEX ARRAY +1
                'group'       => 1, //! GET LAST GROUP NUMBER THEN +1
                'answer_in_array' => array()
            ), array(
                'c_element'   => 'file',
                'description' => 'lorem ipsum',
                'video_link'  => null,
                'image_path'  => '/uploaded_files/image.png', //file
                'question'    => null,
                'total_point' => 0,
                'order'       => 2, //! INDEX ARRAY +1
                'group'       => 1, //! GET LAST GROUP NUMBER THEN +1
                'answer_in_array' => array()
            ), array(
                'c_element'   => 'blank',
                'description' => 'lorem ipsum',
                'video_link'  => null,
                'image_path'  => '/uploaded_files/image.png', //file
                'question'    => null,
                'type_blank'  => 'is exactly',
                'total_point' => 0,
                'order'       => 2, //! INDEX ARRAY +1
                'group'       => 1, //! GET LAST GROUP NUMBER THEN +1
                'answer_in_array' => array()
            )
        );

        print("<pre>".print_r($data, true)."</pre>");exit;

        $validator = Validator::make($request->all(), [
            'part_id' => 'required|numeric|exists:parts,id',
            'data'    => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->errors()], 401);
        }

        try {

            $requestData = $request->data;
            foreach ($requestData as $data) 
            {

                $category = $data->c_element;                
                switch ($category) {
                    case "image":
                        $this->storeImage();
                        break;

                    case "video":
                        $this->storeVideo();
                        break;

                    case "text":
                        $this->storeText();
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

    private function storeImage()
    {
        
    }

    private function storeVideo()
    {

    }

    private function storeText()
    {

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

        return array('success' => true, 'error' => compact('element', 'the_answer'));
    }

    private function storeFillInTheBlank()
    {

    }
}
