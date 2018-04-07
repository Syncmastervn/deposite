<?php
namespace backend\models;

use yii\base\Model;

class Login extends Model
{
    public $username;
    public $password;
    
    public function rules(){
        return [
            [['username','password'],'required'],
            ['username','string','min' => 4],
            ['password','string','min' => 6]
        ];
    }
}