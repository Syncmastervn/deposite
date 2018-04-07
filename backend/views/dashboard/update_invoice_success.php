<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Update';
$this->params['breadcrumbs'][] = $this->title;

//$this->registerJsFile(Yii::getAlias('@web').'/js/jquery.dataTables.min.js',['depends' => 'yii\web\JqueryAsset']);
//
//$this->registerJsFile(Yii::getAlias('@web').'/js/table.searchSite.js',['depends' => 'yii\web\JqueryAsset']);
//
//$this->registerCssFile(Yii::getAlias('@web').'/css/jqueryDataTables.css');
?>
<style>
    .row-odd{
      background-color: #efefef;
    }
    .row-even {
      background-color: #dddddd;
    }
</style>

<div class="update-success-site">
<h2>Cập nhật thông tin thành công</h2>
    <dir class="row row-odd">
        <div class="col-md-6 col-lg-2">Mã hoá đơn</div>
        <div class="col-md-6 col-lg-2"><?= $model['billCode'] ?></div>
    </dir>
    <dir class="row row-even">
        <div class="col-md-6 col-lg-2">Tên khách hàng</div>
        <div class="col-md-6 col-lg-2"><?= $model['customerName'] ?></div>
    </dir>
    <dir class="row row-odd">
        <div class="col-md-6 col-lg-2">Địa chỉ</div>
        <div class="col-md-6 col-lg-2"><?= $model['cusAddress'] ?></div>
    </dir>
    <dir class="row row-even">
        <div class="col-md-6 col-lg-2">Điện thoại</div>
        <div class="col-md-6 col-lg-2"><?= $model['cusMobile'] ?></div>
    </dir>
    <dir class="row row-odd">
        <div class="col-md-6 col-lg-2">Số tiền cầm</div>
        <div class="col-md-6 col-lg-2"><?= $model['deposite_price'] ?></div>
    </dir>
    <dir class="row row-even">
        <div class="col-md-6 col-lg-2">Giá trị sản phẩm</div>
        <div class="col-md-6 col-lg-2"><?= $model['selling_price'] ?></div>
    </dir>
    <dir class="row row-odd">
        <div class="col-md-6 col-lg-2">Cân nặng vàng</div>
        <div class="col-md-6 col-lg-2"><?= $model['weight_gold'] ?></div>
    </dir>
    <dir class="row row-even">
        <div class="col-md-6 col-lg-2">Tổng cân nặng</div>
        <div class="col-md-6 col-lg-2"><?= $model['weight_total'] ?></div>
    </dir>
    <dir class="row row-odd">
        <div class="col-md-6 col-lg-2">Mô tả sản phẩm</div>
        <div class="col-md-6 col-lg-2"><?= $model['description'] ?></div>
    </dir>

    
</div>


