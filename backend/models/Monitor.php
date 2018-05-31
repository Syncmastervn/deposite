<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace backend\models;

use yii\base\Model;

class Monitor extends Model
{
    public $date_search;
    
    public function rules()
    {
        return [
            [['date_search'],'required']
        ];
    }
    
    public function attributeLabels() {
        return [
            'date_search' => 'Ngày xem'
        ];
    }
}