<?php
    use yii\helpers\Html;
    use yii\helpers\ArrayHelper;
    use yii\widgets\ActiveForm;
    use backend\models\ProductType;
    $this->title = 'CreateInvoice';
    $this->params['breadcrumbs'][] = $this->title;
?>


<?php //$this->registerJsFile(Yii::getAlias('@web').'/js/register.js',['depends' => 'yii\web\JqueryAsset']); ?>
<style>
.row-odd{
  background-color: #efefef;
}
.row-even {
  background-color: #dddddd;
}
</style>

<h2>Xuất hoá đơn thành công !</h2>
<h3>Thông báo: <?= $id ?></h3>
<div class="container">
    <div class="row row-odd">
        <div class="col-md-2">Mã hoá đơn</div>
        <div class="col-md-10"><b><?= $billcode ?></b></div>
    </div>
    <div class="row row-even">
        <div class="col-md-2">Tên khách hàng: </div>
        <div class="col-md-10"><b><?= $cus_name ?></b></div>
    </div>
    <div class="row row-odd">
        <div class="col-md-2">Địa chỉ:</div>
        <div class="col-md-10"><b><?= $cus_address ?></b></div>
    </div>
    <div class="row row-even">
        <div class="col-md-2">Điện thoại</div>
        <div class="col-md-10"><b><?= $cus_mobile ?></b></div>
    </div>
    <div class="row row-odd">
        <div class="col-md-2">Số tiền cầm </div>
        <div class="col-md-10"><b><?= $deposite ?></b></div>
    </div>
    <div class="row row-even">
        <div class="col-md-2">Giá trị sản phẩm</div>
        <div class="col-md-10"><b><?= $selling ?></b></div>
    </div>
    <div class="row row-odd">
        <div class="col-md-2">Cân nặng vàng</div>
        <div class="col-md-10"><b><?= $weight ?></b></div>
    </div>
    <div class="row row-even">
        <div class="col-md-2">Tổng cân nặng luôn hột</div>
        <div class="col-md-10"><b><?= $weight_total ?></b></div>
    </div>
    <div class="row row-odd">
        <div class="col-md-2">Mô tả chi tiết </div>
        <div class="col-md-10"><b><?= $description ?></b></div>
    </div>
    <div class="row">
        <div class="col-md-2"><a href="<?= Yii::getAlias('@web') ?>/index.php?r=dashboard/upload-image&id=<?= $id ?>" class="btn btn-info" role="button">Chụp hình sản phẩm</a>
</div>
        <div class="col-md-10"></div>
    </div>
</div>