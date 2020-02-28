<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    $this->title = 'Close Invoice';
    $this->params['breadcrumbs'][] = $this->title;
    $this->registerJsFile(Yii::getAlias('@web').'/js/currency_converter.js',['depends' => 'yii\web\JqueryAsset']);
    $this->registerCssFile(Yii::getAlias('@web').'/css/close-invoice.css');
?>

<center>
    <h1>Hoàn thành đóng hoá đơn</h1>
    <h3 class="bg-primary"> Mã số hoá đơn : <?= $invoice->billCode; ?> </h3>
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <table class="table font-large">
            <col width="30%">
            <col width="70%">
            <tr width="40" >
                <td><b>Tên khách hàng:</b></td><td><?= $invoice->customerName; ?></td>
            </tr>
            <tr>
                <td><b>Nội dung hoá đơn: </b></td><td><?= $invoice->description; ?></td>
            </tr>
            <tr>
                <td><b>Số tiền cầm: </b></td><td class="currency-converter"><?= $invoice->deposite_price; ?></td>
            </tr>
            <tr>
                <td><b>Số tiền kết thúc: </b></td><td class="currency-converter"><?= $invoice->price; ?></td>
            </tr>
        </table>
    </div>
    <div class="col-md-2"></div>
</center>