<?php
namespace backend\models;

use yii\base\Model;

class InvoiceCreateByDate extends \yii\base\Model
{
    public $date_begin;
    public $date_end;
    
    public function rules(){
        return [
            [['date_begin','date_end'],'required']
        ];
    }
    
    public function attributeLabels(){
        return[
            'date_begin'    => 'Từ ngày',
            'date_end'      => 'Đến ngày'
        ];
    }
    
}
