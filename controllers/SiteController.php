<?php

namespace  app\controllers;


use app\core\Application;
use app\core\Controller;
use app\core\func;
use app\core\Request;


class  SiteController extends  Controller {
    public  function home(){
        $params =[
            'name'=>'Elhjuojy home',
            "lastname"=>'elhjuojy'
        ];
        return $this->render("home",$params);
    }
    public  function contact(){

        return $this->render("contact",[]);
    }
    public static function handleContent(Request $request){
        $body = $request->getBody();
      //  func::dd($body);

        return "handling submitted data";
    }
}