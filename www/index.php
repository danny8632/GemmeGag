<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//$redirect = $_SERVER['REQUEST_URI']; // You can also use $_SERVER['REDIRECT_URL'];
$redirect = explode('?',$_SERVER['REQUEST_URI']); // You can also use $_SERVER['REDIRECT_URL'];


$redirect_exploded = explode("/", $redirect[0]);


if($redirect_exploded[1] != "" && $redirect_exploded[1] == "api_v1")
{
    switch ($redirect_exploded[2]) {

        case 'example':

            require __DIR__ . '/api/example/index.php';
            
            new Example();
            break;

        case 'user':
            
            require __DIR__ . '/api/user/index.php';

            new User();

            break;

        case 'post':
        
            require __DIR__ . '/api/post/index.php';

            new Post();

            break;

        case 'comment':
    
            require __DIR__ . '/api/comment/index.php';

            new Comment();

            break;

        case 'vote':

            require __DIR__ . '/api/vote/index.php';

            new Vote();

            break;

        case 'categories':

            require __DIR__ . '/api/categories/index.php';

            new Categories();

            break;

        
        default:
            echo "Api call dosen't exist";
            break;
    }


}
else if($redirect_exploded[1] != "" && $redirect_exploded[1] == "c")
{
    if(empty($redirect_exploded[2]) || !isset($redirect_exploded[2]))
    {
        require __DIR__ . '/sites/categories/index.php';

        new Categories();

        return true;
    }


    switch ($redirect_exploded[2]) {

        case 'list' :
    
            require __DIR__ . '/sites/categories/index.php';

            new Categories();

            break;

        default:
    
            require __DIR__ . '/sites/categories/index.php';

            new Categories($redirect_exploded[2]);
    
            break;
    }
}
else
{
    switch ($redirect_exploded[1]) {
    
        case ''   :

        case 'home' :
    
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

        case 'info':

            phpinfo();

            break;
    
        case 'post' :

            require __DIR__ . '/sites/post/index.php';
    
            new Post();
    
            break;

        case 'comment' :

            require __DIR__ . '/sites/comment/index.php';

            new Comment();

            break;

        case 'user' :

            require __DIR__ . '/sites/user/index.php';

            new User();

            break;

        case 'trending' :

            require __DIR__ . '/sites/trending/index.php';

            new Trending();

            break;

        case 'top':

            require __DIR__ . '/sites/top/index.php';

            new Top();

            break;

        case 'usersettings':

            require __DIR__ . '/sites/usersettings/index.php';

            new UserSettings();

            break;

        case 'categories':

            require __DIR__ . '/sites/categories/index.php';

            new Categories();

            break;

        default:
    
            require __DIR__ . '/404.php';
    
            break;
    
    }
}


