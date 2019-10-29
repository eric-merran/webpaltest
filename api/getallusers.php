<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8"); 
 
// include database and object files 

include_once("./dal/users.php");
 
// get chekid param 

$usertb= new User();
  
$data = $usertb->getAllUsers();

echo json_encode($data);
?>
