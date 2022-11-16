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
    public  function  getMethod(){
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

}