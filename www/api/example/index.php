<?php

require __DIR__."/../api.php";

class Example extends Api {

    private $conn;

    function __construct() {

        parent::__construct();

    }

    function _GET() 
    {
        $this->conn = $this->getDbConn();
        $stmt = $this->conn->prepare("SELECT * FROM posts");
        $stmt->execute();

        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);


        echo json_encode($stmt->fetchAll());

    }


    function getPost()
    {
        $this->conn = $this->getDbConn();
        $stmt = $this->conn->prepare("SELECT * FROM posts");
        $stmt->execute();

        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);


        echo json_encode($stmt->fetchAll());
        
    }


    function gemme() {
        echo "gemme gem \n";
    }

}