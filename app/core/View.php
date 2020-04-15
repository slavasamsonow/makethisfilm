<?php

namespace app\core;

class View{

    public $layout = 'default';
    public $route;
    public $path;

    public function __construct($route)
    {
        $this->route = $route;
        $this->path = $route['controller'].'/'.$route['action'];
    }

    public function render($vars = []){
        if(is_array($vars)){
            extract($vars);
        }

        if(isset($seo['title'])){
            $seo['title'] .= ' | Make This Film';
        }else{
            $seo['title'] .= 'Make This Film';
        }

        ob_start();
        require 'app/views/'.$this->path.'.php';
        $content = ob_get_clean();
        require 'app/views/layouts/'.$this->layout.'.php';
    }

}