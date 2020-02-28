<?php
    use yii\helpers\Html;
    use yii\helpers\ArrayHelper;
    use yii\widgets\ActiveForm;
    //use backend\models\ProductType;
    use backend\models\ReportInvoiceCreate;
    
    $this->registerJsFile(Yii::getAlias('@web').'/js/datepicker.js',['depends' => 'yii\web\JqueryAsset']);
    $this->registerJsFile(Yii::getAlias('@web').'/js/jquery-ui.js',['depends' => 'yii\web\JqueryAsset']);  //date Picker - JqueryUi
    $this->registerJsFile(Yii::getAlias('@web').'/js/currency_converter.js',['depends' => 'yii\web\JqueryAsset']);
    $this->registerCssFile(Yii::getAlias('@web').'/css/jquery-ui.css');
    $this->registerCssFile(Yii::getAlias('@web').'/css/report-blocks.css');
    $this->registerCssFile(Yii::getAlias('@web').'/css/my_table.css');
    $this->title = 'Báo cáo doanh thu';
    $this->params['breadcrumbs'][] = $this->title;
?>
<center>
    <div class="my-table">
        <table class="table">
        <?php $form = ActiveForm::begin(['id'=>'ReportInvoiceCreated']); ?>
            <tr>
                <td colspan="2"><center><h4>Chọn ngày cần báo cáo</h4></center></td>
            </tr>
            <tr>
                <td>Ngày bắt đầu</td>
                <td><?= $form->field($model,'begin_date',['inputOptions' => ['autoComplete'=>'off']])->label(false) ?></td>
            </tr>
            <tr>
                <td>ngày kết thúc</td>
                <td><?= $form->field($model,'end_date', ['inputOptions' => ['autoComplete'=>'off']])->label(false) ?></td>
            </tr>
            <tr>
                <td><?= Html::submitButton('Tìm thông tin', ['class' => 'btn btn-success']) ?></td>
                <td></td>
            </tr>
        <?php $form = ActiveForm::end(); ?>
        </table>
    </div>  
</center>
<?php if($sum_records == null): ?>
    <p> Đang chờ nhập dữ liệu 
<?php elseif($sum_records != null): ?>
        </br>
    <center><h4> Báo cáo kết quả từ ngày <?= $begin_date; ?> đến ngày <?= $end_date; ?> </h4></center>
<div class="container">
    <div class="col-md-3">
        <div class="report-block">
        <b><span class="font-large"><?= $sum_records['count_invoice']; ?></span></b>
        <br>Tổng số hoá đơn tạo mới
        </div>
    </div>
    <div class="col-md-3">
        <div class="report-block">
        <b><span class="font-large currency-converter"><?= $sum_extend['sum_limitID']; ?> </span></b>
        <br>Tổng số lần gia hạn
        </div>
    </div>
    <div class="col-md-3">
        <div class="report-block">
        <b><span class="font-large"><?= $sum_records['sum_closed']; ?> </span></b>
        <br>Tổng số hoá đơn kết thúc
        </div>
    </div>
    <div class="col-md-3">
        <div class="report-block">
        <b><span class="font-large currency-converter"><?= $sum_records['sum_selling_price']; ?> đ</span></b>
        <br>Tổng giá trị sản phẩm cầm
        </div>
    </div>
    <div class="col-md-3">
        <div class="report-block">
        <b><span class="font-large currency-converter"><?= $sum_records['sum_deposite_price']; ?> đ</span></b>
        <br>Tổng gía trị tiền cầm
        </div>
    </div>
    <div class="col-md-3">
        <div class="report-block">
        <b><span class="font-large currency-converter"><?= $sum_records['sum_price']; ?> đ</span></b>
        <br>Tổng doanh thu kết thúc
        </div>
    </div>
    <div class="col-md-3">
        <div class="report-block">
        <b><span class="font-large currency-converter"><?= $sum_extend['sum_renew_fee']; ?> đ</span></b>
        <br>Tổng doanh thu gia hạn
        </div>
    </div>
    <div class="col-md-3">
        <div class="report-block">
        <b><span class="font-large currency-converter"><?= $sum_records['max_deposite_price']; ?> đ</span></b>
        <br>Giá trị cầm đồ lớn nhất
        </div>
    </div>
    <div class="col-md-3">
        <div class="report-block">
        <b><span class="font-large currency-converter"><?= $sum_records['max_price']; ?> đ</span></b>
        <br>Giá trị kết thúc lớn nhất
        </div>
    </div>
    <div class="col-md-3">
        <div class="report-block">
        <b><span class="font-large currency-converter"><?= $sum_records['min_deposite_price']; ?> đ</span></b>
        <br>Giá trị cầm đồ nhỏ nhất
        </div>
    </div>
</div>
<?php endif; ?>


