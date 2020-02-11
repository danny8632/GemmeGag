<?php

require __DIR__ . '/../sites.php';

class Examble Extends Sites {

    public $includeFiles = array(
        "css" => array(
            "http://localhost:8001/Sites/siteexamble/css/main.css"
        ),
        "js" => array(
            "http://localhost:8001/Sites/siteexamble/js/main.js"
        ),
        "html" => array(
            "siteexamble/html/front.html"
        )
    );

    function __construct() {

        parent::__construct($this->includeFiles);
    }

}