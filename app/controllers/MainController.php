<?php

namespace app\controllers;

use app\core\Controller;

class MainController extends Controller
{

    public $model;

    public function indexAction()
    {
        $this->view->render();
    }

    public function aboutAction()
    {
        $this->view->render();
    }

    public function loginAction()
    {
        if (!empty($_POST)) {
            if (!$this->model->checkUser($_POST['username'], $_POST['password'])) {
                $this->view->toConsole('Пользователь не найден');
            }

            if (isset($_POST['remember'])) {
                $remember = $_POST['remember'];
            } else {
                $remember = '';
            }

            $this->model->login($_POST['username'], $remember);

            if($_POST['request_url']){
                //$this->view->location($_POST['request_url']);
            }
            //$this->view->location('account');

        } else {
            $this->view->render();
        }

    }
}