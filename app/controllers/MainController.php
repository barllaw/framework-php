<?php

namespace app\controllers;
use app\core\Controller;

class MainController extends Controller
{
    public function indexAction(){
        $this->view->render('Main page!');
    }
    public function contactAction(){
        echo "Contact page";
    }

}