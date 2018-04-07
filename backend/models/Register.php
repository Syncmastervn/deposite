<?php
namespace backend\models;

use yii\base\Model;

class Register extends Model
{
    public $username;
    public $password;
    public $password_repeat;

    public function rules(){
        return[
            [['username','password','password_repeat'],'required'],
            //['username','integer'],
            ['password','string','min'=>6],
            ['password_repeat','compare','compareAttribute'=>'password','message'=>'Password do not match']
        ];
    }
}