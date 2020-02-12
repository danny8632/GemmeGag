<?php

require __DIR__ . '/../sites.php';

class Post Extends Sites {

    public $includeFiles = array(
        "css" => array(
            "/sites/post/css/post.css"
        ),
        "html" => array(
            "post/html/post.html"
        )
    );

    function __construct() {

        parent::__construct($this->includeFiles);
    }

}