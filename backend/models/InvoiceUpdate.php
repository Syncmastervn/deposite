<?php
namespace backend\models;

use yii\base\Model;

class InvoiceUpdate extends Model
{
    public $billcode;
    public $cus_name;
    public $image;
    public $cus_mobile;
    public $cus_address;
    public $description;
    public $deposite;
    public $selling;
    public $weight;
    public $weight_total;
    public $extend;
    public $price;
    public $classify;
    public $id;
    
    
    public function rules(){
        return [
            [['billcode','cus_name','cus_address','description','deposite','selling','weight','weight_total'],'required'],
                ['price','required' , 'message' => 'Vui lòng nhập số tiền lãi'],
                ['price','integer','min'=>10000,'tooShort'=>Yii::t("translation", "{attribute} is too short.")],
                ['billcode','integer'],
                ['cus_name','string'],
                ['cus_mobile','integer'],
                ['selling','integer'],
                ['weight','integer'],
                ['weight_total','integer'],
                ['cus_address','string'],
                ['classify','integer'],
                ['description','string']
        ];
    }
    
    public function attributeLabels() {
        return [
            'price' => 'Tiền lãi kết thúc hoá đơn'
        ];
    }
}