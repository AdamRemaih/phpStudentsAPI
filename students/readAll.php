<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/students.php';

//Creating database instance to connect
$database = new Database();
$db = $database->getConnection();

//Creating instance of student
$student = new Students($db);



$stmt = $student->read();
$num = $stmt->rowCount();


if($num>0){
    $students_array = array();
    $students_array['records'] = array();

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $student_record=array(
                "id" => $id,
                "student_name" => $student_name,
                "student_number" => $student_number,
                "student_age" => $student_age
        );

        array_push($students_array['records'], $student_record);
    }
    http_response_code(200);
    echo json_encode($students_array);
}
else{
    http_response_code(404);
    echo json_encode(array("message" => "No projects found."));
}

?>

