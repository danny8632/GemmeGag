<?php

//$request = $_SERVER['REQUEST_URI'];
echo "<pre>";
print_r(explode('/', ltrim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/')));
echo "</pre>";


echo "<pre>";
print_r($_SERVER);
echo "</pre>";


//var_dump($request);
?>