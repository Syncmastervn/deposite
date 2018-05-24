<?php
namespace backend\models;

use yii\base\Model;

class ChangePassword extends Model
{
    public $username;
    public $old_password;
    public $password;
    public $password_repeat;
    

    public function rules(){
        return[
            [['username','password','password_repeat',],'required','message'=>'Vui lòng nhập thông tin'],
            //['username','integer'],
            ['password','string','min'=>6],
            ['password_repeat','compare','compareAttribute'=>'password','message'=>'Password mới không trùng khớp']
        ];
    }
}