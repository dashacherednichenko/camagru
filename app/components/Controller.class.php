<?php

require_once 'app/components/View.class.php';

abstract class Controller {

    public $route;
    public $view;

    public function __construct($route)
    {
        $this->route = $route;
        $this->view = new View($route);
    }

}