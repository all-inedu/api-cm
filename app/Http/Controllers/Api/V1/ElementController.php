<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use Exception;
use App\Models\Element;
use App\Models\ElementDetail;
use App\Models\Module;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Providers\RouteServiceProvider;

class ElementController extends Controller
{

    private $maxSizeOfUploadedImage;

    public function __construct() {

        $this->maxSizeOfUploadedImage = RouteServiceProvider::MAX_SIZE_OF_UPLOADED_IMAGE;
    }

    public function updateOrder(Request $request)
    {

        DB::beginTransaction();
        try {
            $element_id       = $request->element_id;
            $part_id          = $request->part_id;
            $group            = $request->part_id;
            $new_order_number = $request->order;
    
            //! FIND THE OLD ELEMENT ID WITH REQUESTED ORDER NUMBER 
            $sql_other_element = Element::where('part_id', $part_id)->where('group', $group)->where('order', $new_order_number)->firstOrFail();
            $other_element_id = $sql_other_element->id;
    
            //! UPDATE NEW ELEMENT ORDER NUMBER
            $element = Element::findOrFail($element_id);
            $old_order_number = $element->order;
            $element->order = $new_order_number;
            $element->save();
    
            //! UPDATE OTHERS ELEMENT IN THE SAME GROUP AND SAME PART WITH OLD ORDER NUMBER
            $other_element = Element::findOrFail($other_element_id);
            $other_element->order = $old_order_number;
            $other_element->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }

        return response()->json(['success' => true, 'message' => 'Element order has successfuly updated'], 200);

    }

    public function delete($element_id)
    {
        try {
            $element = Element::findOrFail($element_id);
            $element->delete();
        } catch (Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 400);
        }

        return response()->json(['success' => true, 'message' => 'Element has successfuly deleted'], 200);
    }

    public function getDetailElementById($element_id)
    {
        $element = Element::with('elementdetails')->findOrFail($element_id);
        return compact('element');
    }

    public function list($part_id)
    {
        $raw = Element::where('part_id', $part_id)->orderBy('order', 'asc')->get();
        $element = array();
        // return compact('element');
        foreach ($raw as $data) {
            $group = $data['group'];

            $element[$group][] = array(
                'id' => $data['id'],
                'part_id' => $data['part_id'],
                'category_element' => $data['category_element'],
                'description' => $data['description'],
                'video_link' => $data['video_link'],
                'image_path' => $data['image_path'],
                'file_path' => $data['file_path'],
                'question' => $data['question'],
                'order' => $data['order'],
                'group' => $data['group']
            );
        }

        return compact('element');
    }

    public function store(Request $request)
    {
        $element_id = "";
        if(isset($request->element_id)) {
            $element_id = $request->element_id;
        }

        $validator = Validator::make($request->all(), [
            'part_id' => 'required|numeric|exists:parts,id',
            'module_id' => 'required|numeric|exists:modules,id',
            'data'    => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->errors()], 401);
        }

        //! GET MAX NUMBER GROUP
        $group = Element::where('part_id', $request->part_id)->max('group');
        $group += 1;

        $order = null;
        if (isset($request->group)) {
            $group = $request->group;

            //! GET MAX ORDER ELEMENT
            $order = Element::where('part_id', $request->part_id)->max('order');
            $order += 1;
        }
       
        DB::beginTransaction();

        try 
        {
            $i = 1;
            if ($order != null) {
                $i = $order;
            }
            
            $requestData = $request->data;
            foreach ($requestData as $data)
            {

                $category = $data['category'];
                $postData = array(
                    'element_id'       => $element_id,
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
                        if ($element_id == '') { //! IF ELEMENT ID IS NULL
                            $this->storeImage($postData);
                        } else { //! IF ELEMENT ID EXIST
                            $this->updateImage($postData);
                        }
                        break;

                    case "video":

                        $postData['video_link'] = $data['video_link'];
                        if ($element_id == '') { //! IF ELEMENT ID IS NULL
                            $this->storeVideo($postData);
                        } else { //! IF ELEMENT ID EXIST
                            $this->updateVideo($postData);
                        }
                        break;

                    case "text":

                        $postData['description'] = $data['description'];
                        if ($element_id == '') { //! IF ELEMENT ID IS NULL
                            $this->storeText($postData);
                        } else { //! IF ELEMENT ID EXIST
                            $this->updateText($postData);
                        }
                        break;

                    case "file":

                        $postData['question'] = $data['question'];
                        $postData['file'] = $data['file'];
                        if ($element_id == '') { //! IF ELEMENT ID IS NULL
                            $this->storeFile($postData);
                        } else { //! IF ELEMENT ID EXIST
                            $this->updateFile($postData);
                        }
                        break;

                    case "multiple":

                        $postData['question'] = $data['question'];
                        $postData['details_data'] = array(
                            'answer_in_array' => $data['choices']
                        );
                        if ($element_id == '') { //! IF ELEMENT ID IS NULL
                            $this->storeMultipleChoice($postData);
                        } else { //! IF ELEMENT ID EXIST
                            $this->updateMultipleChoice($postData);
                        }
                        break;

                    case "blank":

                        $postData['question'] = $data['question'];
                        $postData['type_blank'] = $data['type_blank'];
                        $postData['answer'] = $data['answer'];
                        if ($element_id == '') { //! IF ELEMENT ID IS NULL
                            $this->storeFillInTheBlank($postData);
                        } else { //! IF ELEMENT ID EXIST
                            $this->updateFillInTheBlank($postData);
                        }
                        break;
                }

                //! CHECKING PROGRESS STATUS
                $module = Module::findOrFail($request->module_id);
                $module_progress = $module->progress;

                if ($module_progress < 5) {
                    $module->progress = $module_progress = 4;
                    $module->save();
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

        $message = 'Element has successfully stored';
        if ($element_id != '') {
            $message = 'Element has successfully updated';
        }
        return response()->json(['success' => true, 'message' => $message], 201);
    }

    private function updateImage($postData)
    {
        if (!$postData['file']) {
            throw new Exception('Image not found');
        }

        $element_id = $postData['element_id'];
        $element = Element::findOrFail($element_id);
        $old_image_path = $element->image_path;

        $module_id = $postData['module_id'];
        $file = $postData['file'];
        $extension = $file->getClientOriginalExtension();
        $fileName = 'uploaded_file/module/'.$module_id.'/'.date('dmYHis').".".$extension ;
        $destinationPath = public_path().'/uploaded_file/module/'.$module_id.'/';

        //! CHECKING IF THERE'S A FILE INI THE DIRECTORY WITH $fileName
        if (file_exists(public_path($fileName))) {
            throw new Exception('Can\'t use same name. Filename already exists');
        }

        //! CHECKING IF OLD FILE WAS THERE ON THE DIRECTORY AND NEED TO BE DELETED
        if (file_exists(public_path($old_image_path))) {
            File::delete($old_image_path);
        }
        
        $file->move($destinationPath,$fileName);

        $element->image_path = $fileName;
        $element->save();
    }

    private function updateVideo($postData)
    {
        $element_id = $postData['element_id'];
        try {
            $element = Element::findOrFail($element_id);
            $element->video_link = $postData['video_link'];
            $element->save();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    private function updateText($postData)
    {
        $element_id = $postData['element_id'];
        try {
            $element = Element::findOrFail($element_id);
            $element->description = $postData['description'];
            $element->save();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    private function updateFile($postData)
    {
        $element_id = $postData['element_id'];
        $element = Element::findOrFail($element_id);
        if ($postData['file'] != "null") {
            $old_file_path = $element->file_path;
    
            $module_id = $postData['module_id'];
            $file = $postData['file'];
            $extension = $file->getClientOriginalExtension();
            $fileName = 'uploaded_file/module/'.$module_id.'/'.date('dmYHis').".".$extension ;
            $destinationPath = public_path().'/uploaded_file/module/'.$module_id.'/';
    
            //! CHECKING IF THERE'S A FILE INI THE DIRECTORY WITH $fileName
            if (file_exists(public_path($fileName))) {
                throw new Exception('Can\'t use same name. Filename already exists');
            }
    
            //! CHECKING IF OLD FILE WAS THERE ON THE DIRECTORY AND NEED TO BE DELETED
            if (file_exists(public_path($old_file_path))) {
                File::delete($old_file_path);
            }
            
            $file->move($destinationPath,$fileName);
    
            $element->file_path = $fileName;
        }

        
        $element->question = $postData['question'];
        $element->save();
    }

    private function updateMultipleChoice($postData)
    {
        $element_id = $postData['element_id'];
        try {

            $element = Element::findOrFail($element_id);
            $element->question = $postData['question'];
            $element->save();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

        //! IF ELEMENT MASTER HAS SUCCESSFULY INSERTED THEN GET THE ID AND INSERT ELEMENT DETAIL
        try {
            $answerInArray = $postData['details_data']['answer_in_array'];
            // $correctAnswer = $postData['details_data']['correct_answer'];
            if (!is_array($answerInArray)) {
                throw new Exception('Undefined multiple choice answer');
            }

            $element_detail_data = ElementDetail::where('element_id', $element_id)->get();
            if (count($element_detail_data) == 0) {
                throw new Exception('Cannot found element detail with element id : '.$element_id);
            }

            $index = 0;
            foreach ($element_detail_data as $data) {
                $element_detail_id = $data->id;
                $element_detail = ElementDetail::findOrFail($element_detail_id);
                $element_detail->answer = $answerInArray[$index]['option'];
                $element_detail->value = strtoupper($answerInArray[$index]['value']) == 'TRUE' ? 1 : 0;
                $element_detail->save();
                $index++;
            }
            
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    private function updateFillInTheBlank($postData)
    {
        $element_id = $postData['element_id'];

        try {

            $element = Element::findOrFail($element_id);
            $element->question = $postData['question'];
            $element->save();

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

        //! IF ELEMENT MASTER HAS SUCCESSFULY INSERTED THEN GET THE ID AND INSERT ELEMENT DETAIL
        try {

            $element_detail = ElementDetail::where('element_id', $element_id)->firstOrFail();
            $element_detail->answer = $postData['answer'];
            $element_detail->type_blank = $postData['type_blank'];
            $element_detail->save();
            
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    
    }

    //////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////

    private function storeImage($postData)
    {

        if (!$postData['file']) {
            throw new Exception('Image not found');
        }

        $module_id = $postData['module_id'];
        $file            = $postData['file'];
        $extension       = $file->getClientOriginalExtension();
        $size            = $file->getSize();
        $fileName        = 'uploaded_file/module/'.$module_id.'/'.date('dmYHis').".".$extension ;
        $destinationPath = public_path().'/uploaded_file/module/'.$module_id.'/';

        if (file_exists(public_path($fileName))) {
            throw new Exception('Can\'t use same name. Filename already exists');
        }

        $allowed_extension = ['jpg', 'jpeg', 'png'];

        if ( !in_array(strtolower($extension), $allowed_extension) ) { 
            throw new Exception('Only jpeg, jpg, and png files should be uploaded.');
        }

        if ($size > $this->maxSizeOfUploadedImage) {
            throw new Exception('Image size must be less than 1 Mb');   
        }

        $file->move($destinationPath,$fileName);
        
        try {

            //! INSERT INTO ELEMENT MASTER
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

            $element_id = $element->id;

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

        //! IF ELEMENT MASTER HAS SUCCESSFULY INSERTED THEN GET THE ID AND INSERT ELEMENT DETAIL
        try {
            $answerInArray = $postData['details_data']['answer_in_array'];
            // $correctAnswer = $postData['details_data']['correct_answer'];
            if (!is_array($answerInArray)) {
                throw new Exception('Undefined multiple choice answer');
            }

            for ($i = 0 ; $i < count($answerInArray) ; $i++)
            {
                $the_answer[] = ElementDetail::create([
                    'element_id' => $element_id,
                    'answer'     => $answerInArray[$i]['option'],
                    'value'      => strtoupper($answerInArray[$i]['value']) == 'TRUE' ? 1 : 0,
                    // 'value'      => $correctAnswer == $i ? 1 : 0,
                    'point'      => 0
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

    private function storeFillInTheBlank($postData)
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

            $element_id = $element->id;

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

        //! IF ELEMENT MASTER HAS SUCCESSFULY INSERTED THEN GET THE ID AND INSERT ELEMENT DETAIL
        try {

            ElementDetail::create([
                'element_id' => $element_id,
                'answer'     => $postData['answer'],
                'value'      => 1,
                // 'value'      => $correctAnswer == $i ? 1 : 0,
                'type_blank' => $postData['type_blank'],
                'point'      => 0
            ]);
            
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
