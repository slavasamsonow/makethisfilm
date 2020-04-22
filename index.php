<?php

// Подгружаем роутер
use app\core\Router;

// Функция, подгружающая классы
spl_autoload_register(function($class){
    $path = str_replace('\\','/', $class.'.php');
    if(file_exists($path)){
        require $path;
    }
});

function debug($str){
    echo '<pre>';
    var_dump($str);
    echo '</pre>';
//    exit();
}



setcookie('a', 'asd', 10000);

// Открываем сессию
session_start();

$router = new Router;
$router->run();
?>