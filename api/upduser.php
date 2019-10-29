<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8"); 
 
// include database and object files 

include_once("./dal/users.php");

    $data = json_decode(file_get_contents("php://input"),true);

    $out = array('error' => false);

    $tuser =new User();
    $tuser->user_id= $data->user_id;
    $tuser->last_name = $data->last_name;
    $tuser->first_name = $data->first_name;
    $tuser->role_id = $data->role_id;

    $result = $tuser->updateUser();

   	if($result){
   		$out['message'] = 'User updated Successfully';
   	}
   	else{
   		$out['error'] = true;
   		$out['message'] = 'Cannot update user';
   	}

    echo json_encode($out);
