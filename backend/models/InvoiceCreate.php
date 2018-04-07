<?php
namespace backend\models;

use yii\base\Model;

class InvoiceCreate extends Model
{
    public $billcode;
    public $cus_name;
    public $cus_mobile;
    public $cus_address;
    public $deposite;
    public $selling;
    public $weight;
    public $weight_total;
    public $description;
    public $date_on;
    public $type;
    //public $image;
    
    public function rules(){
        return [
            [['billcode','cus_name','cus_address','deposite','selling','weight','weight_total','description'],'required'],
            ['billcode','integer'],
            //['cus_mobile','integer','min'=>8],
            ['cus_address','string','min'=>5],
            ['deposite','integer','min'=>5],
            ['selling','integer','min'=>5],
            ['weight','integer','min'=>2],
            ['weight_total','integer','min'=>2],
            ['description','string','min'=>6],
            ['type','integer']
            //[['image'],'file','extentions'=> 'jpg','png']
        ];
    }
    
    public function attributeLabels(){
        return [
            'billcode'      =>'Mã hoá đơn',
            'cus_name'      =>'Họ tên khách hàng',
            'cus_addresss'  =>'Địa chỉ khách hàng',
            'cus_mobile'    =>'Điện thoại khách hàng',
            'deposite'      =>'Số tiền cầm',
            'selling'       =>'Gía trị sản phẩm',
            'weight'        =>'Cân nặng vàng',
            'weight_total'  =>'Tổng cân nặng luôn hột',
            'description'   =>'Mô tả chi tiết sản phẩm',
            'type'          =>'Loại vàng'
        ];
    }
    
}