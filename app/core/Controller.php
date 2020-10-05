<?php


namespace app\core;
use app\core\View;

abstract class Controller
{
    public $route;
    public $view;
    public $acl;

    public function __construct($route)
    {
        $this->route = $route;
        if(!$this->checkAcl()){
            View::errorCode(403);
        }
        $this->view = new View($route);
        $this->model = $this->loadModel($route['controller']);
    }

    public function loadModel($name)
    {
        $path = 'app\models\\'.ucfirst($name);
        if(class_exists($path)){
            return new $path;
        }
    }
    public function checkAcl(){
        $this->acl = require 'app/acl/'.$this->route['controller'].'.php';
        if( $this->isAcl('all') ){
            return true;
        }
        else if( $_SESSION['auth']['id'] && $this->isAcl('auth') ){
            return true;
        }
        else if( !$_SESSION['auth']['id'] && $this->isAcl('guest') ){
            return true;
        }
        else if( $_SESSION['admin'] && $this->isAcl('admin') ){
            return true;
        }
    }

    public function isAcl($key)
    {
        return in_array($this->route['action'], $this->acl[$key]);
    }
}