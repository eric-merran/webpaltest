<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8"); 
 
// include database and object files 

include_once("./dal/exams.php");
 
// get chekid param 

$examtb= new Exam();
  
$data = $examtb->getAllExams();

echo json_encode($data);
?>