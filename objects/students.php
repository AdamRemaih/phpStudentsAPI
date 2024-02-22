<?php
//include_once '../config/credentials.php';


// Student class that contains the methods to read and create records on the database
class Students{
    // conection to the table
    private $conn;
    private $table_name = 'student';
    //Instances attributes
    public $id;
    public $student_name;
    public $student_number;
    public $student_age;

    public function __construct($db){
        $this ->conn = $db;
    }

    function read(){

        $query = "SELECT id, student_name, student_number, student_age FROM student";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

}
?>