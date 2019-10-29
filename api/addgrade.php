<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8"); 
 
// include database and object files 

include_once("./dal/grades.php");

$data = json_decode(file_get_contents("php://input"));

    $out = array('error' => false,'message'=>'');

    $tgr =new Grade();
    $tgr->user_id =$data->user_id;
    $tgr->exam_id = $data->exam_id;
    $tgr->grade = $data->grade;

      
    if (!$out['error']){
     
        $result = $tgr->addGrade();
        
        if($result){
            $out['message'] = 'grade added ';
        }
        else{
            $out['error'] = true;
            $out['message'] = 'Error';
        }
        
    }
        
    echo json_encode($out);
  ?>