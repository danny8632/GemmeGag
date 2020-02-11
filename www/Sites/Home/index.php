

<?php

require __DIR__ . '/../sites.php';

class Home Extends Sites {

    public $includeFiles = array(
        "css" => array(
            "http://localhost:8001/Sites/Home/CSS/Home.css"
        ),
        "html" => array(
            "Home/html/Home.html"
        )
    );

    function __construct() {

        parent::__construct($this->includeFiles);
    }

}