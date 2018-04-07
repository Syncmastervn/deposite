<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Search';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile(Yii::getAlias('@web').'/js/search-site.js',['depends' => 'yii\web\JqueryAsset']);

$this->registerJsFile(Yii::getAlias('@web').'/js/jquery.dataTables.min.js',['depends' => 'yii\web\JqueryAsset']);

$this->registerJsFile(Yii::getAlias('@web').'/js/table.searchSite.js',['depends' => 'yii\web\JqueryAsset']);

$this->registerCssFile(Yii::getAlias('@web').'/css/jqueryDataTables.css');
?>



<center>
    <h2>Đã tìm thấy hoá đơn</h2>
</center>
<table id="datatable" class="display compact">
    <thead>
        <tr>
            <th>Mã hoá đơn</th>
            <th>Tên khách hàng</th>
            <th>Số tiền cầm</th>
            <th>Lần Gia Hạn</th>
            <th>Nội dung</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($data as $row): ?>
        <tr>
            <th><?= $row['billCode'] ?></th>
            <th><?= $row['customerName'] ?></th>
            <th><?= $row['deposite_price'] ?></th>
            <th><?= $row['extended'] ?></th>
            <th class="descript"><?= $row['description'] ?></th>
            <th>
            <?php echo Html::a('Gia hạn', ['dashboard/invoice-extend', 'id' => $row['invoiceID'], 'extend' => $row['extended']], ['class' => 'btn btn-primary btn-sm extend']); ?>
            <?php echo Html::a('Chỉnh sửa', ['dashboard/invoice-update', 'id' => $row['invoiceID'], 'extend' => $row['extended']], ['class' => 'btn btn-warning btn-lrg']); ?>
            <?php echo Html::a('Kết thúc', ['dashboard/invoice-close', 'id' => $row['invoiceID'], 'extend' => $row['extended']], ['class' => 'btn btn-danger btn-sm']); ?>
            </th>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>