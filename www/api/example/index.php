<?php

require __DIR__."/../api.php";

class Example extends Api {

    private $conn;

    function __construct() {

        parent::__construct();
    
        $this->conn = $this->getDbConn();

        $stmt = $this->conn->prepare("SELECT * FROM posts");
        $stmt->execute();

        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        foreach($stmt->fetchAll() as $k=>$v) {
            print_r($v);
        }

    }


    function gemme() {
        echo "gemme gem \n";
    }

}