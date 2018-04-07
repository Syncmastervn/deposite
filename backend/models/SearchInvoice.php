<?php
namespace backend\models;

use yii\base\Model;

class SearchInvoice extends Model
{
    public $billcode;
    public $cus_name;
    public $mobile;
    
    public function rules(){
        return [
            ['billcode','integer'],
            ['cus_name','string'],
            ['mobile','integer']
        ];
    }
}