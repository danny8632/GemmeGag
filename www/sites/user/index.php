<?php

require __DIR__ . '/../sites.php';

class User Extends Sites {

    public $includeFiles = array(
        "css" => array(
            "/sites/user/css/user.css"
        ),
        "html" => array(
            "user/html/user.html"
        ),
    );

    function __construct() {

        parent::__construct($this->includeFiles);
    }

}