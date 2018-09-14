<?php
namespace backend\models;

use yii\base\Model;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class LimitReducer extends Model 
{
    public $billcode;
    
    public function rules(){
        return [
            [['billcode'],'required']
        ];
    }
}
