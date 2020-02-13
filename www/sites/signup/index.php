<?php

require __DIR__ . '/../sites.php';

class Signup Extends Sites {

    public $includeFiles = array(
        "js" => array(
            "/sites/signup/js/signup.js"
        ),
        "css" => array(
            "/sites/signup/css/signup.css"
        ),
        "html" => array(
            "signup/html/signup.html"
        )
    );

    function __construct() {

        parent::__construct($this->includeFiles);
    }

}