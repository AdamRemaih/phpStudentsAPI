<?php
include_once '../config/credentials.php';
include_once '../config/database.php';


// Student class that contains the methods to read and create records on the database
class Students{
    // conection to the table
    private $conn;
    private $table_name = DB_TABLE;
    private $db_name = DB_NAME;
    //Instances attributes
    public $id;
    public $student_name;
    public $student_number;
    public $student_age;

    public function __construct($db){
        $this ->conn = $db;
    }

    function readAll(){
        

        $query = "SELECT * FROM  ". $this->db_name.".". $this->table_name;
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
        

    }
    function create(){

    $query = "INSERT INTO ". $this->table_name . " SET student_name=:student_name, 
            student_age=:student_age, 
            student_number=:student_number";

    $stmt = $this->conn->prepare($query);

    $this->student_name=htmlspecialchars(strip_tags($this->student_name));
    $this->student_age=htmlspecialchars(strip_tags($this->student_age));
    $this->student_number=htmlspecialchars(strip_tags($this->student_number));

    $stmt->bindParam(":student_name", $this->student_name);
    $stmt->bindParam(":student_age", $this->student_age);
    $stmt->bindParam(":student_number", $this->student_number);

    if($stmt->execute()){
        return true;
    }
  
    return false;
    }
}
?>
