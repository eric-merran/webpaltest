<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8"); 
 
// include database and object files 

include_once("./dal/exams.php");

    $data = json_decode(file_get_contents("php://input"));

    $out = array('error' => false);

    $texam =new Exam();
    $texam->exam_id= $data->exam_id;
    $texam->exam_name = $data->exam_name;
    
    $result = $texam->updateExam();

   	if($result){
   		$out['message'] = 'Exam updated Successfully';
   	}
   	else{
   		$out['error'] = true;
   		$out['message'] = 'Cannot update exam';
   	}

    echo json_encode($out);
