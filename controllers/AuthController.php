<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\Models\RegisterModel;

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
        $registerModel = new RegisterModel();
        if($request->isPost()){
            $registerModel->loadData($request->getBody());


            if($registerModel->validate() && $registerModel->register()){
                return  "Success";
            }
            echo '<pre>';
            var_dump($registerModel->errors);
            echo '</pre>';

            return $this->render("register",[
                    'model'=>$registerModel
                ]);
            //return "handle register data submitted";
        }
        return $this->render("register",[
            'model'=>$registerModel
        ]);

    }
}