<?php

$redirect = $_SERVER['REQUEST_URI']; // You can also use $_SERVER['REDIRECT_URL'];


switch ($redirect) {

    case '/'  :

    case ''   :

        require __DIR__ . '/Sites/Home/index.php';

        new Home();

        break;


    case '/examble' :

        require __DIR__ . '/Sites/siteexamble/index.php';

        new Examble();

        break;

    case '/upload':

        require __DIR__ . '/Sites/upload/index.php';

        new Upload();

        break;

    default:

        require __DIR__ . '/404.php';

        break;

}

