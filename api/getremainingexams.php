<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8"); 
 
// include database and object files 

include_once("./dal/exams.php");

$data = json_decode(file_get_contents("php://input"));

$texam= new Exam();

$result = $texam->getRemainingExams($data->user_id);

echo json_encode($result);
?>