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
        "js" => array(
            "/sites/user/js/user.js"
        )
    );

    function __construct() {
        
        $var = null;
        
        if (isset($_GET['id'])) $var['id'] = $_GET['id'];

        parent::__construct($this->includeFiles, $var);
    }

}