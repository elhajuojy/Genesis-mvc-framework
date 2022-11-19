<?php

namespace app\Models;

use app\core\Model;

class RegisterModel extends  Model
{
    public  string $firstname ;
    public  string $lastname ;
    public  string $password ;
    public  string $email ;
    public  string $confirmpassword;


    public function register(){
        echo  "creating new user";
    }

    public function rules(): array
    {
        // TODO: Implement rules() method.
        return  [
            'firstname'=>[self::RULE_REQUIRED,],
            'lastname'=>[self::RULE_REQUIRED,],
            'email'=>[self::RULE_REQUIRED,self::RULE_EMAIL],
            'password'=>[self::RULE_REQUIRED,[self::RULE_MIN , 'min'=>8],[self::RULE_MAX,'max'=>24]],
            'confirmpassword'=>[self::RULE_REQUIRED,[self::RULE_MATCH,'match'=>'password']],
        ];
    }
}
