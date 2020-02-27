<?php

require __DIR__ . '/../sites.php';

class Categories Extends Sites {

    public $includeFiles = array(
        "css" => array(
            "/sites/categories/css/index.css",
            "/sites/categories/css/post.css"
        ),
        "js" => array(
            "/sites/categories/js/index.js"
        ),
        "html" => array(
            "categories/html/index.phtml"
        )
    );

    function __construct($category = null) {

        $extra_data = null;

        if($category != null) $extra_data['categori'] = $category;

        parent::__construct($this->includeFiles, $extra_data);
        
    }

}