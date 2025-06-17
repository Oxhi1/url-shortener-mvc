<?php
class App {
    protected $controller = 'HomeController';
    protected $method = 'index';

    public function __construct() {
        $this->controller = new $this->controller;
        call_user_func_array([$this->controller, $this->method], []);
    }
}
