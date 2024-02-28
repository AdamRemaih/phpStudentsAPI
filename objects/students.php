<?php
include_once '../config/credentials.php';


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

    function readById(){

        $query = "SELECT * FROM  ". $this->db_name.".". $this->table_name. " WHERE id = ? LIMIT 0,1";

        $stmt = $this->conn->prepare($query);
        // get id of the student
        $stmt->bindParam(1, $this->id);

        //execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->student_name = $row['student_name'];
        $this->student_number = $row['student_number'];
        $this->student_age = $row['student_age'];
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

        function delete_student(){

            $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
  
            // prepare query
            $stmt = $this->conn->prepare($query);
          
            // sanitize
            $this->id=htmlspecialchars(strip_tags($this->id));
          
            // bind id of record to delete
            $stmt->bindParam(1, $this->id);
          
            // execute query
            if($stmt->execute()){
                return true;
            }
          
            return false;
        }
        function update_student(){
            $query = "UPDATE " . $this->table_name . "
                      SET
                        student_name = :student_name,
                        student_age = :student_age,
                        student_number = :student_number
                      WHERE
                        id = :id";
        
            // prepare query statement
            $stmt = $this->conn->prepare($query);
        
            // sanitize input
            $this->id=htmlspecialchars(strip_tags($this->id));
            $this->student_name=htmlspecialchars(strip_tags($this->student_name));
            $this->student_age=htmlspecialchars(strip_tags($this->student_age));
            $this->student_number=htmlspecialchars(strip_tags($this->student_number));
        
            // bind new values
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':student_name', $this->student_name);
            $stmt->bindParam(':student_age', $this->student_age);
            $stmt->bindParam(':student_number', $this->student_number);
        
            // execute the query
            if($stmt->execute()){
                return true;
            }
        
            return false;
        }
}
?>
