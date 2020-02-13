

<?php

require __DIR__ . '/../sites.php';

class Home Extends Sites {

    public $includeFiles = array(
        "css" => array(
            "/sites/home/css/home.css",
            "/sites/home/css/post.css"
        ),
        "html" => array(
            "home/html/home.html"
        ),
        "js" => array(
            "/sites/home/js/home.js"
        )
    );

    function __construct() {

        parent::__construct($this->includeFiles);
    }

}