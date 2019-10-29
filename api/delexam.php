<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8"); 
 
// include database and object files 

include_once("./dal/exams.php");

$data = json_decode(file_get_contents("php://input"));

    $out = array('error' => false);

  $texam =new Exam();
        
    $result = $texam->deleteExam($data->exam_id);

   	if($result){
   		$out['message'] = 'exam deleted Successfully';
   	}
   	else{
   		$out['error'] = true;
   		$out['message'] = "error";
   	}

    echo json_encode($out);
