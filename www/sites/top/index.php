<?php

require __DIR__ . '/../sites.php';

class Top Extends Sites {

    public $includeFiles = array(
        "css" => array(
            "/sites/top/css/post.css"
        ),
        "js" => array(
            "/sites/top/js/top.js"
        ),
        "html" => array(
            "top/html/top.html"
        )
    );

    function __construct() {

        parent::__construct($this->includeFiles);
    }

}