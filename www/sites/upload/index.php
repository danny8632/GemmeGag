<?php

require __DIR__ . '/../sites.php';

class Upload Extends Sites {

    public $includeFiles = array(
        "css" => array(
            "http://localhost:8001/sites/upload/css/main.css"
        ),
        "js" => array(
            "http://localhost:8001/sites/upload/js/main.js"
        ),
        "html" => array(
            "upload/html/upload.html"
        )
    );

    function __construct() {

        parent::__construct($this->includeFiles);
    }

}