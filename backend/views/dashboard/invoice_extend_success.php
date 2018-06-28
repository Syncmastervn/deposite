<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    $this->title = 'Extended';
    $this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile(Yii::getAlias('@web').'/js/jquery.dataTables.min.js',['depends' => 'yii\web\JqueryAsset']);

$this->registerJsFile(Yii::getAlias('@web').'/js/table.invoiceLimitSite.js',['depends' => 'yii\web\JqueryAsset']);

$this->registerCssFile(Yii::getAlias('@web').'/css/jqueryDataTables.css');
?>
<div class="invoice-limit-site">
   <h2>Hoá đơn đã được gia hạn</h2>
    <table id="datatable-invoice" class="display compact">
        <thead>
            <tr>
                <th>Billcode</th>
                <th>Tên khách hàng</th>
                <th>Số tiền cầm</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th><?= $invoice['billCode']; ?></th>
                <th><?= $invoice['customerName']; ?></th>
                <th class="currency-converter"><?= $invoice['deposite_price']; ?></th>
            </tr>
        </tbody>
    </table>
    
    <h2>Số lần gia hạn</h2>
    <table id="datatable-invoice-limit" class="table table-striped">
        <thead>
            <tr class="success">
                <th>Date Expanded</th>
                <th>Date Off</th>
                <th>User</th>
                <th>Fee</th>
            </tr>
        </thead>
        <tbody>
            <? foreach($invoiceLimit as $row): ?>
            <tr>
                <th><?= $row['date_expands'] ?></th>
                <th><?= $row['date_off'] ?></th>
                <th><?= $row['userName'] ?></th>
                <th class="currency-converter"><?= $row['renew_fee'] ?></th>
            </tr>
            <? endforeach; ?>
        </tbody>
    </table>
</div>