<?php

/* @var $this yii\web\View */

    $this->title = 'My Yii Application';

    $this->registerJsFile(Yii::getAlias('@web').'/js/index-site.js',['depends' => 'yii\web\JqueryAsset']);
    $this->registerJsFile(Yii::getAlias('@web').'/js/jquery.dataTables.min.js',['depends' => 'yii\web\JqueryAsset']);
    $this->registerJsFile(Yii::getAlias('@web').'/js/datatable.js',['depends' => 'yii\web\JqueryAsset']);
    $this->registerCssFile(Yii::getAlias('@web').'/css/jqueryDataTables.css');
    $this->registerCssFile(Yii::getAlias('@web').'/css/index-site.css');

    $this->registerJsFile(Yii::getAlias('@web').'/js/jquery.fancybox.min.js',['depends' => 'yii\web\JqueryAsset']);
    $this->registerJsFile(Yii::getAlias('@web').'/js/jquery.mousewheel-3.0.4.pack.js',['depends' => 'yii\web\JqueryAsset']);
    $this->registerCssFile(Yii::getAlias('@web').'/css/jquery.fancybox.min.css',['depends' => 'yii\web\JqueryAsset']);
?>
<div class="site-index">

    
    <p class="pull-left">
        <?php 
            $sessGet = Yii::$app->session->get('userId');
            $authority = Yii::$app->session->get('authority');
            if($sessGet === null): ?>
        <div class="alert alert-warning">
            <strong>Chưa đăng nhập</strong> 
        </div>
        <?php else: ?>
        
        <div class="alert alert-success">
            <strong><div  style="font-size:135%;" class="currency-converter"><?= $depositeSum ?></div></strong>
        </div>
        <?php endif; ?>
    </p>
    <?php if(count($invoiceLose)>0): ?>
    <div class="bg-table-gray">
        <p><h2>Hoá đơn báo mất</h2></p>
        <table class="table table-striped">
            <thead >
                <tr class="table-header">
                    <th class="col-md-1">Mã số HĐ</th>
                    <th class="col-md-1">Khách hàng</th>
                    <th class="col-md-2">Nội dung</th>
                    <th class="col-md-2">Số tiền cầm</th>
                    <th class="col-md-1">Ngày sử dụng</th>
                    <th class="col-md-2">Ngày báo mất</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($invoiceLose as $row): ?>
                <tr>
                    <th><?= $row['billCode'] ?></th>
                    <th><?= $row['customerName'] ?></th>
                    <th><?= $row['description'] ?></th>
                    <th class="currency-converter"><?= $row['deposite_price'] ?>
                    <th class="date-db"><?= $row['date_on'] ?></th>
                    <th><?= $row['date_lose'] ?></th>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>
    
    <?php if($invoiceOutDate >0): ?>
    <div class="invoiceOutDate-table bg-table-cyan">
        <p><h2>Hoá đơn quá hạn</h2></p>
    <table class="table table-striped">
        <thead>
            <tr class="table-header">
                <th>Stt</th>
                <th>Mã số HĐ</th>
                <th>Khách hàng</th>
                <th>Giá trị sp</th>
                <th>Ngày quá hạn</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $stt = 1;
            $sum = 0;
            foreach($invoiceOutDate as $row): 
              
                    $on = (($row['date_iff'] - ($row['extended'] * 30)) > 60) ? true : false;
                    if($on):
                    $sum += $row['selling_price']
            ?>
            <tr>
                <th><?= $stt++; ?></th>
                <th><?= $row['billCode'] ?></th>
                <th><?= $row['customerName'] ?></th>
                <th class="currency-converter"><?= $row['selling_price'] ?></th>
                <th><?= $row['date_iff'] - ($row['extended'] * 30) ?> ngày</th>
            </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        Tổng tiền: <span class="font-red-bold currency-converter"><?= $sum ?></span>
        </tbody>
    </table>
    </div>
    <?php endif; ?>
    
    <h2>DANH SÁCH HOÁ ĐƠN</h2>
    <div class="body-content">
<table id="datatable" class="display compact">
    <thead>
        <tr>
            <th>Mã số </th>
            <th>Tên khách hàng</th>
            <th>Số điện thoại</th>
            <th>Số tiền cầm</th>
            <th>Ngày sử dụng</th>
            <th>Gia hạn</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($data as $row): ?>
        <tr>
        <?php if($row['image']===null): ?>
            <th><?= $row['billCode'] ?></th>
        <?php else: ?>
            <th>
                <a data-fancybox="gallery" class="fancy" href="<?= $imageFolder ?><?= $row['image'] ?>">
                    <?= $row['billCode'] ?>    
                </a>
            </th>
        <?php endif; ?>
            <th><?= $row['customerName'] ?></th>
            <th><?= $row['cusMobile'] ?></th>
            <th class="currency-converter"><?= $row['deposite_price'] ?></th>
            <th class="date-db"><?= $row['date'] ?></th>
            <th><?= $row['extended'] ?></th>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

    </div>
</div>
