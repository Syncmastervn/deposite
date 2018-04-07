<?php
namespace backend\models;

use yii\base\Model;
use app\components\MyBehavior;

class BehaviModel extends Model
{
    public $name = "Model Name";
    
    public function behaviors(){
        return[
            [
                'class' => MyBehavior::className()
            ]
        ];
    }
    
    public function uploadFolder(){
        $hosting = $_SERVER['SERVER_NAME'] . ":8888" . '/deposite/uploads/';
        return $hosting;
    }
}