<?php

namespace app\core;

class Router
{

    public $routes = [
        "controller" => "Main",
        "action" => "index"
    ];

    public function run()
    {
        // Убираем с конца слэш, убираем переменные и делим адрес слэшами
        $url = trim($_SERVER['REQUEST_URI'], '/');
        $url = explode('?', $url)[0];
        $routes = explode("/", $url);

        // Имя контроллера
        if(!empty($routes[0]))
        {
            $this->routes['controller'] = $routes[0];
        }

        // Имя действия
        if(!empty($routes[1]))
        {
            $this->routes['action'] = $routes[1];
        }

        if($url == "about"){
            $this->routes = [
              'controller' => 'Main',
              'action' => 'about'
            ];
        }

        // Добавление префиксов
//        $model_name = $controller_name;
        $controller_path = 'app\controllers\\'.ucfirst($this->routes['controller'])."Controller";
        if(class_exists($controller_path)){
            $action = $this->routes['action'].'Action';
            if(method_exists($controller_path, $action)){
                // Включаем контроллер
                $controller = new $controller_path($this->routes);
                // Вызываем метод контроллера
                $controller->$action();
            }else{
                Router::ErrorPage404();
            }
        }else{
            Router::ErrorPage404();
    }
    }

    static function ErrorPage404(){
        //$host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        //header('HTTP/1.1 404 Not Found');
        //header("Status: 404 Not Found");
        //header('Location:'.$host.'404');
        echo "Страница не найдена";
    }

}