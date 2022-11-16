<?php

namespace app\core;


class Controller
{
    public function rander($view,$params=[] ){
       return Application::$app->router->randerView($view,$params);
    }
}