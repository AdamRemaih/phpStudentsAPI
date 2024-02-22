<?php

//credentials file
require_once 'credentials.php'

// Class for connecting database
class Database{
    private $host = DB_HOST;
    private $db_name = DB_NAME;
    private $username = DB_USERNAME;
    private $password = DB_PASSWORD;
    private $conn;

    // get connection to DB
    public function getConnection(){
        $this ->conn = null;
        try{
            $this-> conn = new PDO(
                "mysql:host=".$this->host. 
                ";dbname".$this-> db_name,
                $this -> username,
                $this -> password
            );
            $this -> conn -> exec("set names utf8");
            echo "Connection succesfull";
        }
        catch(PDOException $exception){
            echo "Connection error: ". $exception-> getMessage();
        }

        return $this -> conn;
    }
}