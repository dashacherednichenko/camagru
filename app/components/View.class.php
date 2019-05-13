<?php
class View
{
    public $route;
    public $layout = 'shablonDefault';

    public function __construct($route)
    {
        $this->route = $route;
//        echo $this->route;
    }
}