<?php

require __DIR__."/../api.php";

class Example extends Api {

    function __construct() {

        parent::__construct();

        print_r($this->getRequest());

    }


    function gemme() {
        echo "gemme gem";
    }

}