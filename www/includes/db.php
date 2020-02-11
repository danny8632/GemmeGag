<?php

class DB {
    private $connection;
    private static $_instance;

    private $dbhost = "db"; // Ip Address of database if external connection.
    private $dbuser = "root"; // Username for DB
    private $dbpass = "root"; // Password for DB
    private $dbname = "gemmegag"; // DB Name



    public static function getInstance(){
    if(!self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    private function __construct() {
        try{


            $this->connection = new PDO('mysql:host='.$this->dbhost.';dbname='.$this->dbname, $this->dbuser, $this->dbpass);
            // set the PDO error mode to exception
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected successfully";
   

            //$this->connection = new PDO('mysql:host='.$this->dbhost.';dbname='.$this->dbname, $this->dbuser, $this->dbpass);
            //$this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        }catch(PDOException $e){
            die("Failed to connect to DB: ". $e->getMessage());
        }
    }

    private function __clone(){}

    public function getConnection(){
        return $this->connection;
    }
}



?>