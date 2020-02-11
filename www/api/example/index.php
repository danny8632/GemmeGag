<?php

require __DIR__."/../api.php";

class Example extends Api {

    private $conn;

    function __construct() {

        parent::__construct();

        echo '<pre>';
        print_r($this->getRequest());
        echo '</pre>';

        
        $servername = "db";
        $username = "root";
        $password = "root";
        
        try {
            $conn = new PDO("mysql:host=$servername;dbname=myDB", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected successfully";
            }
        catch(PDOException $e)
            {
            echo "Connection failed: " . $e->getMessage();
            }
        

    }


    function gemme() {
        echo "gemme gem \n";
    }

}