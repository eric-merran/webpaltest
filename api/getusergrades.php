<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8"); 
 
// include database and object files 

include_once("./dal/grades.php");

$data = json_decode(file_get_contents("php://input"));


$tgrades =new Grade();
        
$result = $tgrades->getUserGrades($data->user_id);

echo json_encode($result);