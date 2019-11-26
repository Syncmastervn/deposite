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

    $hosting = $_SERVER['SERVER_NAME'] . ":80" . '/deposite/uploads/';
?>
<center>
    <h2>Đã tìm thấy hoá đơn</h2>
</center>
<table class="table table-striped">
    <thead>
        <tr>
            <th class="col-md-1">Mã số</th>
            <th class="col-md-2">Tên khách hàng</th>
            <th class="col-md-2">Số tiền cầm</th>
            <th class="col-md-1">Gia Hạn</th>
            <th class="col-md-3">Nội dung</th>
            <th class="col-md-3">Thao tác</th>
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
            <!-- <img src="http://delete_icon.png"> -->
                <a href="index.php?r=dashboard/invoice-close&id=<?= $row['invoiceID'] ?>&extend=<?= $row['extended'] ?>" ><?= Html::img('http://'.$hosting.'delete_icon.png', ['alt' => 'My logo','height'=>25,'width'=>25]) ?></a>
                <a href="index.php?r=dashboard/invoice-update&id=<?= $row['invoiceID'] ?>&extend=<?= $row['extended'] ?>" ><?= Html::img('http://'.$hosting.'edit_icon.ico', ['alt' => 'My logo','height'=>25,'width'=>25]) ?></a>
                <?php if(Yii::$app->session->get('userId') == 1): ?>
                    <a href="index.php?r=dashboard/limit-reducer&invoiceid=<?= $row['invoiceID'] ?>&extend=<?= $row['extended'] ?>" class="reducer" ><?= Html::img('http://'.$hosting.'minus_icon.png', ['alt' => 'My logo','height'=>25,'width'=>25]) ?></a>
                    <a href="index.php?r=dashboard/limit-reducer&invoiceid=<?= $row['invoiceID'] ?>&extend=<?= $row['extended'] ?>" class="reducer" ><?= Html::img('http://'.$hosting.'unlock_icon.png', ['alt' => 'My logo','height'=>30,'width'=>30]) ?></a>
                <?php endif; ?>
                <a href="index.php?r=dashboard/invoice-lose&id=<?= $row['invoiceID'] ?>&extend=<?= $row['extended'] ?>" ><?= Html::img('http://'.$hosting.'warning_icon.png', ['alt' => 'My logo','height'=>28,'width'=>28]) ?></a>
                <?php echo Html::a('Gia hạn', ['dashboard/invoice-extend', 'id' => $row['invoiceID'], 'extend' => $row['extended']], ['class' => 'btn btn-primary btn-sm extend']); ?>
            </th>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<center><h3>Các Lần Đã Gia Hạn</h3></center>
<table class="table table-striped">
    <thead>
        <tr>
            <th class="col-md-2">Tên khách hàng</th>
            <th class="col-md-2">Điện thoại</th>
            <th class="col-md-2">Date expands</th>
            <th class="col-md-2">Date Off</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($invoiceLimit as $row): ?>
        <tr>
            <th><?= $row['customerName'] ?></th>
            <th><?= $row['cusMobile'] ?></th>
            <th class="date-db"><?= $row['date_expands'] ?></th>
            <th class="date-db"><?= $row['date_off'] ?></th>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

