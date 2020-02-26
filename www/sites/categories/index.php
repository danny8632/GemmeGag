<?php

require __DIR__ . '/../sites.php';

class Categories Extends Sites {

    public $includeFiles = array(
        "css" => array(
            "/sites/categories/css/index.css"
        ),
        "js" => array(
            "/sites/categories/js/index.js"
        ),
        "html" => array(
            "categories/html/index.phtml"
        )
    );

    function __construct() {

        parent::__construct($this->includeFiles);
    }

}