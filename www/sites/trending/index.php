<?php

require __DIR__ . '/../sites.php';

class Trending Extends Sites {

    public $includeFiles = array(
        "css" => array(
            "/sites/trending/css/post.css",
            "/sites/trending/css/navbar.css"
        ),
        "js" => array(
            "/sites/trending/js/trending.js"
        ),
        "html" => array(
            "trending/html/trending.html"
        )
    );

    function __construct() {

        parent::__construct($this->includeFiles);
    }

}