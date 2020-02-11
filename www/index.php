<?php

$redirect = $_SERVER['REQUEST_URI']; // You can also use $_SERVER['REDIRECT_URL'];


switch ($redirect) {

    case '/'  :

    case ''   :

        require __DIR__ . '/sites/home/index.php';

        new Home();

        break;


    case '/examble' :

        require __DIR__ . '/sites/siteexamble/index.php';

        new Examble();

        break;

    case '/upload':

        require __DIR__ . '/sites/upload/index.php';

        new Upload();

        break;

    case '/login':

        require __DIR__ . '/sites/login/index.php';

        new Login();

        break;
    default:

        require __DIR__ . '/404.php';

        break;

}

