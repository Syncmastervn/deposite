<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;



//include for using SubMenu
use yii\widgets\Menu;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <!-- <meta charset="<Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <style>
    .my-navbar {
        background: rgba(95,111,128,1);
        background: -moz-linear-gradient(top, rgba(95,111,128,1) 0%, rgba(55,66,77,1) 100%);
        background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(95,111,128,1)), color-stop(100%, rgba(55,66,77,1)));
        background: -webkit-linear-gradient(top, rgba(95,111,128,1) 0%, rgba(55,66,77,1) 100%);
        background: -o-linear-gradient(top, rgba(95,111,128,1) 0%, rgba(55,66,77,1) 100%);
        background: -ms-linear-gradient(top, rgba(95,111,128,1) 0%, rgba(55,66,77,1) 100%);
        background: linear-gradient(to bottom, rgba(95,111,128,1) 0%, rgba(55,66,77,1) 100%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#5f6f80', endColorstr='#37424d', GradientType=0 );
        
    }
    .navbar {
        color: red;
    }
    </style>    
</head>
<body>
<?php $this->beginBody() ?>
<!-- THIS FOR RENDER PARTIAL 
     load _partial.php at views/folder, can use '/site/_partial' for more load
     </?= Yii::$app->controller->renderPartial('//_partial'); ?>
-->


<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => '',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => 'http://localhost/deposite/frontend/web/index.php?r=site/index'],
        ['label' => 'Login', 'url' => ['/site/login']],
        ['label' => 'Thao tác',
                'url' => ['#'],
                'template' => '<a href="{url}">{label}<i class="fa fa-angle-left pull-right"></i></a>',
            'items' => [
                    ['label' => 'Tạo hoá đơn', 'url' => Yii::getAlias('@web').'/index.php?r=dashboard/invoice-create'],
                    ['label' => 'Tìm hoá đơn', 'url' => Yii::getAlias('@web').'/index.php?r=dashboard/search'],
                    ['label' => 'Xoá gia hạn', 'url' => Yii::getAlias('@web').'/index.php?r=dashboard/invoice-extend-delete'],
                    ['label' => 'Quản lý người dùng', 'url' => Yii::getAlias('@web').'/index.php?r=dashboard/user-manager'],
                    ['label' => 'Đăng ký', 'url' => Yii::getAlias('@web').'/index.php?r=dashboard/register'],
                    ['label' => 'Đổi mật khẩu', 'url' => Yii::getAlias('@web').'/index.php?r=dashboard/changepassword'],
                    ['label' => 'Kiểm tra giao dịch', 'url' => Yii::getAlias('@web').'/index.php?r=dashboard/monitor'],
                    ['label' => 'Hoá đơn đã tạo', 'url' => Yii::getAlias('@web').'/index.php?r=dashboard/invoice-created'],
                    ['label' => 'Truy xuất hoá đơn đóng', 'url' => Yii::getAlias('@web').'/index.php?r=dashboard/invoice-close-from-date'],
                    ['label' => 'Logout', 'url' => Yii::getAlias('@web').'/index.php?r=dashboard/logout']
                ]
        //['label' => 'Logout', 'url' => ['/site/logout']]
        ]];
    

    
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">
            <?php 
                $sessGet = Yii::$app->session->get('userId');
                $authority = Yii::$app->session->get('authority');
                if($sessGet === null): ?>
            <b>Chưa đăng nhập</b>
            <?php else: ?>
            <b>User: </b> 
            <?php 
                    if($sessGet === 1) 
                        echo "Quản lý cấp cao";
                    else if($sessGet === 2)
                        echo "Nhân viên";
            ?>
            <?php endif; ?>
        </p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
