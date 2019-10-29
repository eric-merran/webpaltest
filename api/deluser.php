<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8"); 
 
// include database and object files 

include_once("./dal/users.php");

$data = json_decode(file_get_contents("php://input"));

    $out = array('error' => false);

  $tuser =new User();
        
    $result = $tuser->deleteUser($data->user_id);

   	if($result){
   		$out['message'] = 'user deleted Successfully';
   	}
   	else{
   		$out['error'] = true;
   		$out['message'] = "error";
   	}

	echo json_encode($out);

?>
	
	