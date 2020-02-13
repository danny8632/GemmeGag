<?php

require __DIR__ . '/../sites.php';

class Comment Extends Sites {

    public $includeFiles = array(
        "css" => array(
            "/sites/comment/css/comment.css"
        ),
        "html" => array(
            "comment/html/comment.html"
        )
    );

    function __construct() {

        parent::__construct($this->includeFiles);
    }

}