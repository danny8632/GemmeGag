

<?php

require __DIR__ . '/../sites.php';

class Home Extends Sites {

    public $includeFiles = array(
        "css" => array(
            "http://localhost:8001/sites/home/css/home.css"
        ),
        "html" => array(
            "home/html/home.html"
        )
    );

    function __construct() {

        parent::__construct($this->includeFiles);
    }

}