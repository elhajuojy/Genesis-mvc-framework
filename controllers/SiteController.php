<?php

namespace  app\controllers;


use app\core\Application;
use app\core\Controller;


class  SiteController extends  Controller {
    public  function home(){
        $params =[
            'name'=>'Elhjuojy home',
            "lastname"=>'elhjuojy'
        ];
        return $this->rander("home",$params);
        //return "show contact form ";
    }
    public  function contact(){

        return $this->rander("contact",[]);
    }
    public static function handleContent(){
        return "handling submitted data";
    }
}