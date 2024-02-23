<?php
//include_once '../config/credentials.php';
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

}
?>
