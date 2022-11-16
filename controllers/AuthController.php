<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;

class AuthController extends  Controller
{
    public  function login(Request $request){
        $this->setLayout("auth");
        if($request->isPost()){
            return "handle submitted data";
        }

            return $this->render('login');

    }
    public  function register(Request $request){
        $this->setLayout("auth");
        if($request->isPost()){
            return "handle register data submitted";
        }
        return $this->render("register");
    }
}