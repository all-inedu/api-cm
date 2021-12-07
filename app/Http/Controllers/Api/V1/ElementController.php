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

        $group = Element::where('part_id', $request->part_id)->max('group');
        $group += 1;
       
        DB::beginTransaction();

        try 
        {
            $i = 1;
            $requestData = $request->data;
            foreach ($requestData as $data)
            {

                $category = $data['category'];
                $postData = array(
                    'module_id'        => $request->module_id,
                    'part_id'          => $request->part_id,
                    'category_element' => $category,
                    'description'      => null,
                    'video_link'       => null,
                    'image_path'       => null,
                    'file_path'        => null,
                    'question'         => null,
                    'total_point'      => 0,
                    'order'            => $i,
                    'group'            => $group,
                    'file'             => null
                );

                switch ($category) {
                    case "image":

                        $postData['file'] = $data['file'];
                        $this->storeImage($postData);
                        break;

                    case "video":
                        $postData['video_link'] = $data['video_link'];
                        $this->storeVideo($postData);
                        break;

                    case "text":

                        $postData['description'] = $data['description'];
                        $this->storeText($postData);
                        break;

                    case "file":

                        $postData['file'] = $data['file'];
                        $this->storeFile($postData);
                        break;

                    case "multiple":

                        $postData['description'] = $data['description'];
                        $postData['details_data'] = array(
                            'answer_in_array' => $data->answer,
                            'correct_answer'  => $data->correct_answer
                        );
                        $this->storeMultipleChoice($postData);
                        break;

                    case "blank":
                        $this->storeFillInTheBlank();
                        break;
                }

            $i++; 
            }
        } catch (QueryException $qe) {
            DB::rollBack();
            Log::error($qe->getMessage());
            return response()->json(['success' => false, 'error' => 'Invalid Query'], 400);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return response()->json(['success' => false, 'error' => $e->getMessage()], 400);
        }

        DB::commit();
        return response()->json(['success' => true, 'message' => 'Element has successfully stored'], 201);
    }

    //////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////

    private function storeImage($postData)
    {
        $module_id = $postData['module_id'];

        //! IF INSERT DB WAS SUCCESS THEN UPLOAD FILE
        if (!$postData['file']) {
            return false;
        }
        
        $file            = $postData['file'];
        $extension       = $file->getClientOriginalExtension();
        $fileName        = 'uploaded_file/module/'.$module_id.'/'.date('dmYHis').".".$extension ;
        $destinationPath = public_path().'/uploaded_file/module/'.$module_id.'/';

        if (file_exists(public_path($fileName))) {
            throw new Exception('Can\'t use same name. Filename already exists');
        }

        $validator = Validator::make($file, [
            'file' => 'mimes:jpeg,jpg,png,gif|required|max:10000'
        ]);

        if ($validator->fails()) {
            throw new Exception($validator->errors());
        }

        $file->move($destinationPath,$fileName);
        
        //! INSERT INTO ELEMENT MASTER
        try {
            Element::create([
                'part_id'          => $postData['part_id'],
                'category_element' => $postData['category_element'],
                'description'      => $postData['description'],
                'video_link'       => $postData['video_link'],
                'image_path'       => $fileName,
                'file_path'        => $postData['file_path'],
                'question'         => $postData['question'],
                'total_point'      => 0,
                'order'            => $postData['order'],
                'group'            => $postData['group']
            ]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
        
    }

    //////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////

    private function storeVideo($postData)
    {
        //! INSERT INTO ELEMENT MASTER
        try {
            Element::create([
                'part_id'          => $postData['part_id'],
                'category_element' => $postData['category_element'],
                'description'      => $postData['description'],
                'video_link'       => $postData['video_link'],
                'image_path'       => $postData['image_path'],
                'file_path'        => $postData['file_path'],
                'question'         => $postData['question'],
                'total_point'      => 0,
                'order'            => $postData['order'],
                'group'            => $postData['group']
            ]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    //////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////

    private function storeText($postData)
    {
        //! INSERT INTO ELEMENT MASTER
        try {
            Element::create([
                'part_id'          => $postData['part_id'],
                'category_element' => $postData['category_element'],
                'description'      => $postData['description'],
                'video_link'       => $postData['video_link'],
                'image_path'       => $postData['image_path'],
                'file_path'        => $postData['file_path'],
                'question'         => $postData['question'],
                'total_point'      => 0,
                'order'            => $postData['order'],
                'group'            => $postData['group']
            ]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

    }

    //////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////

    private function storeFile($postData)
    {
        $module_id = $postData['module_id'];

        //! IF INSERT DB WAS SUCCESS THEN UPLOAD FILE
        if (!$postData['file']) {
            return false;
        }
        
        $file            = $postData['file'];
        $extension       = $file->getClientOriginalExtension();
        $fileName        = 'uploaded_file/module/'.$module_id.'/'.date('dmYHis').".".$extension ;
        $destinationPath = public_path().'/uploaded_file/module/'.$module_id.'/';

        if (file_exists(public_path($fileName))) {
            throw new Exception('Can\'t use same name. Filename already exists');
        }

        // $validator = Validator::make($file, [
        //     'file' => 'mimes:jpeg,jpg,png,gif|required|max:10000'
        // ]);

        // if ($validator->fails()) {
        //     throw new Exception($validator->errors());
        // }

        $file->move($destinationPath,$fileName);
        
        //! INSERT INTO ELEMENT MASTER
        try {
            Element::create([
                'part_id'          => $postData['part_id'],
                'category_element' => $postData['category_element'],
                'description'      => $postData['description'],
                'video_link'       => $postData['video_link'],
                'image_path'       => $postData['image_path'],
                'file_path'        => $fileName,
                'question'         => $postData['question'],
                'total_point'      => 0,
                'order'            => $postData['order'],
                'group'            => $postData['group']
            ]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    //////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////

    private function storeMultipleChoice($postData)
    {
        
        //! INSERT INTO ELEMENT MASTER
        try {
            $element = Element::create([
                'part_id'          => $postData['part_id'],
                'category_element' => $postData['category_element'],
                'description'      => $postData['description'],
                'video_link'       => $postData['video_link'],
                'image_path'       => $postData['image_path'],
                'file_path'        => $postData['file_path'],
                'question'         => $postData['question'],
                'total_point'      => 0,
                'order'            => $postData['order'],
                'group'            => $postData['group']
            ]);

            $element_id = $element->id();

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

        //! IF ELEMENT MASTER HAS SUCCESSFULY INSERTED THEN GET THE ID AND INSERT ELEMENT DETAIL
        try {
            $answerInArray = $postData['details_data']['answerInArray'];
            $correctAnswer = $postData['correct_answer'];
            if (!is_array($answerInArray)) {
                throw new Exception('Undefined multiple choice answer');
            }

            for ($i = 0 ; $i < count($answerInArray) ; $i++)
            {
                $the_answer[] = ElementDetail::create([
                    'element_id' => $element_id,
                    'answer'     => $answerInArray[$i],
                    'value'      => $correctAnswer == $i ? 1 : 0
                ]);
            }
            
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    //////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////

    private function storeFillInTheBlank()
    {

    }
}
