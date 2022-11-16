<?php

namespace app\core;

class Request
{
    public function getPath(){
        $path= $_SERVER['REQUEST_URI']??'/';

        $position=strpos($path,"?");
        if(!$position){
            return $path;
        }
        return $path= substr($path,0,$position);

    }
    public  function  mathod(){
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public  function isGet(){
        return $this->mathod() === 'get';
    }


    public  function isPost(){
        return $this->mathod() === 'post';
    }

    public  function getBody(){

        $body=[];
        if($this->isGet()){
            foreach ($_GET as $key => $value){
                $body[$key] = filter_input(INPUT_GET,$key , FILTER_SANITIZE_SPECIAL_CHARS);

            }
        }
        if($this->isPost()){
            foreach ($_POST as $key => $value){
                $body[$key] = filter_input(INPUT_POST, $key , FILTER_SANITIZE_SPECIAL_CHARS);

            }
        }
        return $body;
    }



}