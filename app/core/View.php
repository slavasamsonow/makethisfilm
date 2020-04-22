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

    public static function errorCode($code)
    {
        if($code == 403 || $code == 404){
            http_response_code($code);
        }
        $seo = [
            'title' => 'Ошибка '.$code.' Make This Film',
        ];
        ob_start();
        require 'app/views/errors/'.$code.'.php';
        $content = ob_get_clean();
        require 'app/views/layouts/default.php';

        exit();
    }

    public function toConsole($data){
        exit(json_encode(['console' => $data]));
    }

    public function location($url){
        exit(json_encode(['url' => $url]));
    }

    public function locationOut($url){
        exit(json_encode(['urlo' => $url]));
    }

    public function data($data){
        exit(json_encode(['data' => $data]));
    }

}