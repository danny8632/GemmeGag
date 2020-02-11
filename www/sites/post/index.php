<?php

require __DIR__ . '/../sites.php';

class Post Extends Sites {

    public $includeFiles = array(
        "css" => array(
            "http://localhost:8001/sites/post/css/post.css"
        ),
        "html" => array(
            "post/html/post.html"
        )
    );

    function __construct() {

        parent::__construct($this->includeFiles);
    }

}