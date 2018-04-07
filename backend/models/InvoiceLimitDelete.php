<?php
namespace backend\models;

use yii\base\Model;

class InvoiceLimitDelete extends Model
{
    public $billcode;
    
    public function rules(){
        return [
            [['billcode'],'required'],
            ['billcode','integer']
        ];
    }
    
    public function attributeLabels(){
        return [
            'billcode' => 'Mã hoá đơn'
        ];
    }
}



