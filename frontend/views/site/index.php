<?php

/* @var $this yii\web\View */

    $this->title = 'My Yii Application';

    $this->registerJsFile(Yii::getAlias('@web').'/js/index-site.js',['depends' => 'yii\web\JqueryAsset']);
    $this->registerJsFile(Yii::getAlias('@web').'/js/jquery.dataTables.min.js',['depends' => 'yii\web\JqueryAsset']);
    $this->registerJsFile(Yii::getAlias('@web').'/js/datatable.js',['depends' => 'yii\web\JqueryAsset']);
    $this->registerCssFile(Yii::getAlias('@web').'/css/jqueryDataTables.css');

    $this->registerJsFile(Yii::getAlias('@web').'/js/jquery.fancybox.min.js',['depends' => 'yii\web\JqueryAsset']);
    $this->registerJsFile(Yii::getAlias('@web').'/js/jquery.mousewheel-3.0.4.pack.js',['depends' => 'yii\web\JqueryAsset']);
    $this->registerCssFile(Yii::getAlias('@web').'/css/jquery.fancybox.min.css',['depends' => 'yii\web\JqueryAsset']);
?>
<div class="site-index">

    <h1>DANH SÁCH HOÁ ĐƠN</h1>
    <p class="pull-left">
        <?php 
            $sessGet = Yii::$app->session->get('userId');
            $authority = Yii::$app->session->get('authority');
            if($sessGet === null): ?>
        <?php var_dump($sessGet); ?>
        <b>Chưa đăng nhập</b>
        <?php else: ?>
        <h3><div class="currency-converter"><?= $depositeSum ?></div></h3>
        <?php endif; ?>
    </p>
    
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
