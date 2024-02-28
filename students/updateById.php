<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type: application/json,
Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../objects/students.php';

$database = new Database();
$db = $database->getConnection();

$student = new Students($db);

$data = json_decode(file_get_contents("php://input"));

$student->id = $data->id;

$student->student_name = $data->student_name;
$student->student_age = $data->student_age;
$student->student_number= $data->student_number;


if($student->update_student()){
    http_response_code(200);
    echo json_encode(array("message" => "Student was updated"));
}
else{
    http_response_code(503);
    echo json_encode(array("message" => "Unable to create the student due to service unavailable"));
    }

?>