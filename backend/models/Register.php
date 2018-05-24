<?php
namespace backend\models;

use yii\base\Model;

class Register extends Model
{
    public $username;
    public $fullname;
    public $password;
    public $password_repeat;

    public function rules(){
        return[
            [['username','password','password_repeat','fullname'],'required','message'=>'Vui lòng nhập thông tin'],
            //['username','integer'],
            ['password','string','min'=>6],
            ['password_repeat','compare','compareAttribute'=>'password','message'=>'Password không trùng khớp']
        ];
    }
}