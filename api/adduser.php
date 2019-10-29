<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8"); 
 
// include database and object files 

include_once("./dal/users.php");

    $data = json_decode(file_get_contents("php://input"));

    $out = array('error' => false,'message'=>'');

    $tuser =new User();
    $tuser->last_name = $data->last_name;
    $tuser->first_name = $data->first_name;
    $tuser->role_id = 1;
    

    if(empty($tuser->last_name)){
        $out['error'] = true;
        $out['message'] = "last name requiered"; 
    }
    
    if(empty($tuser->first_name)){
        $out['error'] = true;
        $out['message'] =$out['message'].'first name requiered'; 
    }
	
     
      
    if (!$out['error']){
     
        $result = $tuser->addUser();
        
        if($result){
            $out['message'] = 'User added ';
        }
        else{
            $out['error'] = true;
            $out['message'] = 'Error  ';
        }
        
    }
        
    echo json_encode($out);
  ?>
