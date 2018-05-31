<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

    use yii\helpers\Html;
    use yii\bootstrap\ActiveForm;

    $this->title = 'Monitor';
    $this->params['breadcrumbs'][] = $this->title;

    $this->registerJsFile(Yii::getAlias('@web').'/js/jquery-ui.js',['depends' => 'yii\web\JqueryAsset']);  //date Picker - JqueryUi
    $this->registerJsFile(Yii::getAlias('@web').'/js/monitor-page.js',['depends' => 'yii\web\JqueryAsset']);
    $this->registerJsFile(Yii::getAlias('@web').'/js/jquery.dataTables.min.js',['depends' => 'yii\web\JqueryAsset']);
    $this->registerCssFile(Yii::getAlias('@web').'/css/jqueryDataTables.css');
    $this->registerCssFile(Yii::getAlias('@web').'/css/jquery-ui.css');
?>
<div class="site-login">
 
   
    <h1><?= Html::encode($this->title) ?></h1>
    
    <?php $form = ActiveForm::begin(['id'=>'MonitorPage']); ?>
        <?= $form->field($model,'date_search'); ?>
        <?= Html::submitButton('Push',['class'=>'btn btn-success']); ?>
    <?php $form = ActiveForm::end(); ?>
    
    <?php if(!empty($invoiceUpdate)): ?>
    <div class="row"> 
        <hr>
        <h3> Gia hạn thêm </h3>
        <div>
            <table id="table" class="table table-striped">
                <thead>
                    <tr class="warning">
                        <th>Mã HĐ</th>
                        <th>Tên khách hàng</th>
                        <th>Số tiền cầm</th>
                        <th>Nội dung</th>
                        <th>Tổng cân nặng</th>
                    </tr>
                </thead>
                <tbody>
                <?php if($invoiceUpdate != null): ?>
                 <?php foreach($invoiceUpdate as $row): ?>
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
    <?php endif; ?>
    
    
    <?php if(!empty($invoiceDelete)): ?>
    <div class="row"> 
        <hr>
        <h3> Hoá đơn xoá </h3>
        <div>
            <table id="table" class="table table-striped">
                <thead>
                    <tr class="info">
                        <th>Mã HĐ</th>
                        <th>Tên khách hàng</th>
                        <th>Số tiền cầm</th>
                        <th>Nội dung</th>
                        <th>Tổng cân nặng</th>
                    </tr>
                </thead>
                <tbody>
                <?php if($invoiceDelete != null): ?>
                 <?php foreach($invoiceDelete as $row): ?>
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
    <?php endif; ?>
    
    <?php if(!empty($invoiceCreate)): ?>
    <div class="row"> 
        <hr>
        <h3> Hoá đơn tạo mới </h3>
        <div>
            <table id="table" class="table table-striped">
                <thead>
                    <tr class="success">
                        <th>Mã HĐ</th>
                        <th>Tên khách hàng</th>
                        <th>Số tiền cầm</th>
                        <th>Nội dung</th>
                        <th>Tổng cân nặng</th>
                    </tr>
                </thead>
                <tbody>
                <?php if($invoiceCreate != null): ?>
                 <?php foreach($invoiceCreate as $row): ?>
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
    <?php endif; ?>
    
</div>
