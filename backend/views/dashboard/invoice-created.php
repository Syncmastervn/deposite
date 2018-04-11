<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Invoice Created';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile(Yii::getAlias('@web').'/js/jquery-ui.js',['depends' => 'yii\web\JqueryAsset']);  //date Picker - JqueryUi
$this->registerJsFile(Yii::getAlias('@web').'/js/invoice-create-by-date.js',['depends' => 'yii\web\JqueryAsset']);
$this->registerJsFile(Yii::getAlias('@web').'/js/jquery.dataTables.min.js',['depends' => 'yii\web\JqueryAsset']);
$this->registerCssFile(Yii::getAlias('@web').'/css/jqueryDataTables.css');
$this->registerCssFile(Yii::getAlias('@web').'/css/jquery-ui.css');
?>
<div class="site-login">
 
   
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div>
            <?php $form=ActiveForm::begin(['id'=>'InvoiceCreateByDate_Form']); ?>
                <?= $form->field($model,'date_begin'); ?>
                <?= $form->field($model,'date_end'); ?>
            <?= Html::submitButton('Tìm thông tin', ['class' => 'btn btn-success']) ?>
            <?php $form=ActiveForm::end(); ?>
        </div>
        <hr>
        <div>
            <table id="datatable">
                <thead>
                    <tr>
                        <th>Mã HĐ</th>
                        <th>Tên khách hàng</th>
                        <th>Số tiền cầm</th>
                        <th>Nội dung</th>
                        <th>Tổng cân nặng</th>
                    </tr>
                </thead>
                <tbody>
                <?php if($invoice != null): ?>
                 <?php foreach($invoice as $row): ?>
                    <tr>
                        <th><?= $row['billCode']; ?></th>
                        <th><?= $row['customerName'] ?></th>
                        <th class="currency-converter"><?= $row['deposite_price'] ?></th>
                        <th><?= $row['description'] ?></th>
                        <th><?= $row['weight_total'] ?></th>
                    </tr>
                 <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
