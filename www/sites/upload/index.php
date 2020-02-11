<?php

require __DIR__ . '/../sites.php';

class Upload Extends Sites {

    public $includeFiles = array(
        "css" => array(
            "/sites/upload/css/main.css"
        ),
        "js" => array(
            "/sites/upload/js/main.js"
        ),
        "html" => array(
            "upload/html/upload.html"
        )
    );

    function __construct() {

        parent::__construct($this->includeFiles);
    }

}