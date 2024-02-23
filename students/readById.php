<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  

include_once '../config/database.php';
include_once '../objects/students.php';
  
//database instance and connection
$database = new Database();
$db = $database->getConnection();
  
// Student instance
$student = new Students($db);
  
// set ID property of record to read
$student->id = isset($_GET['id']) ? $_GET['id'] : die();
  
// read the details of product to be edited
$student->readById();

if($student->student_name != null){

    $student_record=array(
        "id" => $student->id,
        "student_name" => $student->student_name,
        "student_number" => $student->student_number,
        "student_age" => $student->student_age
    );
    //Succesfull response code
    http_response_code(200);
    //json format
    echo json_encode($student_record);

}
else{
    //Not found response code
    http_response_code(404);
    echo "Id not found";
}