<?php

$redirect = $_SERVER['REQUEST_URI']; // You can also use $_SERVER['REDIRECT_URL'];


switch ($redirect) {

    case '/'  :

    case ''   :

        require __DIR__ . '/Sites/Home/index.php';

        break;


    case '/examble' :

        require __DIR__ . '/Sites/siteexamble/index.php';

        new Examble();

        break;

    default:

        require __DIR__ . '/404.php';

        break;

}

