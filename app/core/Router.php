<?php

namespace app\core;

use app\core\View;

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

        if($url == 'main' || $url == 'main/index'){
            header('Location: /');
            exit();
        }

        if($url == "about"){
            $this->routes = [
              'controller' => 'Main',
              'action' => 'about'
            ];
        }

        if($url == "login"){
            $this->routes = [
                'controller' => 'Main',
                'action' => 'login'
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
                View::errorCode(404);
            }
        }else{
            View::errorCode(404);
        }
    }

}