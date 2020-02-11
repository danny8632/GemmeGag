<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" type="text/css" href="/sites/templates/header.css">
    
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

        <?php

            foreach ($this->includeArr as $type => $val) {
                if($type == 'css')
                    echo '<link rel="stylesheet" type="text/css" href="'.$val[0].'">';
                else if($type == 'js')
                    echo '<script type="text/javascript" src="'.$val[0].'"></script>';
            }
        ?>

        <title>GemmeGag</title>
    </head>

    <body>
        <div class="header">
            <div class="logo">
                <a class="logotext" href="" >GemGag</a>
            </div>
            <div class="search">
                <form>
                    <input placeholder="Søg..." type="text">
                </form>
            </div>
            <div class="login">
                <a href="/login" class="loginButton">Login</a>
            </div>
        </div>
