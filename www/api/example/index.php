<?php

require __DIR__."/../api.php";

class Example extends Api {

    private $conn;

    function __construct() {

        parent::__construct();

        echo '<pre>';
        print_r($this->getRequest());
        echo '</pre>';

        $this->conn = parent::getDbConn();

        print_r($this->conn);

    }


    function gemme() {
        echo "gemme gem \n";
    }

}