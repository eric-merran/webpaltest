<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8"); 
 
// include database and object files 

include_once("./dal/grades.php");

    $data = json_decode(file_get_contents("php://input"));

    $out = array('error' => false);

    $tgr =new Grade(); 

    $result = $tgr->deleteGrade($data->user_id,$data->exam_id);

   	if($result){
   		$out['message'] = 'Grade deleted Successfully:'. $data->exam_id;
   	}
   	else{
   		$out['error'] = true;
   		$out['message'] = 'Cannot delete grade';
   	}

    echo json_encode($out);

?>