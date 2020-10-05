<?php

namespace app\controllers;
use app\core\Controller;

class AccountController extends Controller
{

    public function loginAction(){

        if (!empty($_POST)){
            $this->view->message('success', 'Message popup');
        }

        $this->view->render('Login page!');
    }
    public function registerAction(){
        $this->view->render('Register page!');
    }
}