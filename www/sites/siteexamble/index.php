<?php

require __DIR__ . '/../sites.php';

class Examble Extends Sites {

    public $includeFiles = array(
        "css" => array(
            "/sites/siteexamble/css/main.css"
        ),
        "js" => array(
            "/sites/siteexamble/js/main.js"
        ),
        "html" => array(
            "siteexamble/html/front.html"
        )
    );

    function __construct() {

        parent::__construct($this->includeFiles);
    }

}