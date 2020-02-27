<?php

require __DIR__ . '/../sites.php';

class UserSettings Extends Sites {

    public $includeFiles = array(
        "css" => array(
            "/sites/usersettings/css/index.css"
        ),
        "html" => array(
            "usersettings/html/index.phtml"
        ),
        "js" => array(
            "/sites/usersettings/js/index.js"
        )
    );

    function __construct() {

        parent::__construct($this->includeFiles);

        if(!isset($_SESSION['user_id']))
            header("location: /home");
    }

}