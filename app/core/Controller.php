<?php

namespace app\core;

class Controller{
    public $route;
    public $view;
    public $model;


    function __construct($route)
    {
        $this->route = $route;
        $this->view = new View($route);
        $this->model = $this->loadModel($this->route['controller']);
    }

    public function loadModel($name){
        $path = 'app\models\\'.ucfirst($name);
        if(class_exists($path)){
            return new $path;
        }
    }
}