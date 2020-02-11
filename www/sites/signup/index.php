<?php

require __DIR__ . '/../sites.php';

class Signup Extends Sites {

    public $includeFiles = array(
        "css" => array(
            "http://localhost:8001/sites/signup/css/signup.css"
        ),
        "html" => array(
            "signup/html/signup.html"
        )
    );

    function __construct() {

        parent::__construct($this->includeFiles);
    }

}