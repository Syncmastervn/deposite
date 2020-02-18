<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace backend\models;

use yii\base\Model;

class ReportInvoiceCreated extends Model
{
    public $begin_date;
    public $end_date;
    
    public function rules(){
        return [
            [['begin_date','end_date'],'required'],
            ['begin_date','date','format'=>'yyyy-M-d'],
            ['end_date','date','format'=>'yyyy-M-d']
        ];
    }
    
}