<?php

namespace  app\controllers;


use app\core\Application;




class  SiteController{
    public  static function home(){
        $parms =[
            'name'=>'Elhjuojy home',
            "lastname"=>'elhjuojy'
        ];
        return Application::$app->router->randerView("home",$parms);
        //return "show contact form ";
    }
    public static function contact(){

        return Application::$app->router->randerView("contact",[]);
    }
    public static function handleContent(){
        return "handling submitted data";
    }
}