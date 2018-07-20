<?php
namespace backend\models;

use yii\base\Model;

class UserManager extends Model 
{
    public $userID;
    public $userName;
    public $authName;
    public $fullName;
    public $password;
    public $status;
    public $authID;
    
    public function rules()
    {
        return [
            [['userName'],'required','message'=>'Vui long nhap thong tin']
        ];
    }
    
    public function attributeLabels() {
        
    }
}

