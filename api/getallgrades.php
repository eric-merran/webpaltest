<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8"); 
 
// include database and object files 

include_once("./dal/grades.php");
 
// get chekid param 
$data = json_decode(file_get_contents("php://input"));

$tgrade= new Grade();
$result = $tgrade->getUserGrades($data->user_id);

echo json_encode($result);
?>
