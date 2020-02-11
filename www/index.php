<?php

//$redirect = $_SERVER['REQUEST_URI']; // You can also use $_SERVER['REDIRECT_URL'];
$redirect = explode('?',$_SERVER['REQUEST_URI']); // You can also use $_SERVER['REDIRECT_URL'];

$redirect_exploded = explode("/", $redirect[0]);


if($redirect_exploded[1] != "" && $redirect_exploded[1] == "api")
{

    switch ($redirect_exploded[2]) {
        case 'test':
            print_r($_REQUEST);
            print_r($_SERVER['REQUEST_METHOD']);
            break;
        
        default:
            echo "Api call dosen't exist";
            break;
    }


}
else
{
    switch ($redirect_exploded[1]) {
    
        case ''   :
    
            require __DIR__ . '/sites/home/index.php';
    
            new Home();
    
            break;
    
    
        case 'examble' :
    
            require __DIR__ . '/sites/siteexamble/index.php';
    
            new Examble();
    
            break;
    
        case 'upload':
    
            require __DIR__ . '/sites/upload/index.php';
    
            new Upload();
    
            break;

        case 'login':

            require __DIR__ . '/sites/login/index.php';
    
            new Login();
    
            break;

        case 'signup':

            require __DIR__ . '/sites/signup/index.php';
    
            new Signup();
    
            break;
    
        default:
    
            require __DIR__ . '/404.php';
    
            break;
    
    }
}


