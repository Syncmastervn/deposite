<?php
namespace backend\models;

use yii\base\Model;

class CloseInvoiceDate extends Model
{
    public $from_date;
    public $to_date;
    
    public function rules(){
        return [
            [['from_date','to_date'],'required'],
            ['from_date','date','format'=>'yyyy-M-d'],
            ['to_date','date','format'=>'yyyy-M-d']
        ];
    }
}



