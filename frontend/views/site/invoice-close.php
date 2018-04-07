<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';

$this->registerJsFile(Yii::getAlias('@web').'/js/index-site.js',['depends' => 'yii\web\JqueryAsset']);
$this->registerJsFile(Yii::getAlias('@web').'/js/jquery.dataTables.min.js',['depends' => 'yii\web\JqueryAsset']);
$this->registerJsFile(Yii::getAlias('@web').'/js/datatable.js',['depends' => 'yii\web\JqueryAsset']);
$this->registerCssFile(Yii::getAlias('@web').'/css/jqueryDataTables.css');
?>
<div class="site-index">

    <h1>DANH SÁCH HOÁ ĐƠN</h1>
    <h3><div class="currency-converter"><?= $depositeSum ?></div></h3>
    <div class="body-content">
<table id="datatable" class="display compact">
    <thead>
        <tr>
            <th>Mã số </th>
            <th>Tên khách hàng</th>
            <th>Số điện thoại</th>
            <th>Số tiền cầm</th>
            <th>Ngày cầm</th>
            <th>Gia hạn</th>
        </tr>
    </thead>
    <tbody>
    <? foreach($data as $row): ?>
        <tr>
            <th><?= $row['billCode'] ?></th>
            <th><?= $row['customerName'] ?></th>
            <th><?= $row['cusMobile'] ?></th>
            <th class="currency-converter"><?= $row['deposite_price'] ?></th>
            <th><?= $row['date_off'] ?></th>
            <th><?= $row['extended'] ?></th>
        </tr>
    <? endforeach; ?>
    </tbody>
</table>

    </div>
</div>
