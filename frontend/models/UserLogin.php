<?php
namespace frontend\models;
    
use yii\base\Model;

class UserLogin extends Model
{
    public $name;
    public $email;
    public $image;
    public function rules()
    {
        return [
            [['name','email'],'required'],
            ['email','email']
        ];
    }
}



    


