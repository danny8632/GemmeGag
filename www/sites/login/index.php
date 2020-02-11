<?php

require __DIR__ . '/../sites.php';

class Login Extends Sites {

    public $includeFiles = array(
        "css" => array(
            "/sites/login/css/login.css"
        ),
        "html" => array(
            "login/html/login.html"
        )
    );

    function __construct() {

        parent::__construct($this->includeFiles);
    }

}