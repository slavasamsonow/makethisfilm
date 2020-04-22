<?php

namespace app\controllers;

use app\core\Controller;

class MainController extends Controller{
    public function indexAction(){
        $this->view->render();
    }

    public function aboutAction(){
        $this->view->render();
    }

    public function loginAction(){
        $this->view->render();
    }
}