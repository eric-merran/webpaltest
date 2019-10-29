<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8"); 
 
// include database and object files 

include_once("./dal/exams.php");

$data = json_decode(file_get_contents("php://input"));

    $out = array('error' => false,'message'=>'');

    $texam =new Exam();
    $texam->exam_name = $data->exam_name;
    
    

    if(empty($texam->exam_name)){
        $out['error'] = true;
        $out['message'] = "exam name requiered"; 
    }
    
      
      
    if (!$out['error']){
     
        $result = $texam->addExam();
        
        if( $result){
            $out['message'] = 'Exam added ';
        }
        else{
            $out['error'] = true;
            $out['message'] = 'Error';
        }
        
    }
        
    echo json_encode($out);
  ?>
