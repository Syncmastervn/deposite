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
    /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#7d7e7d+0,0e0e0e+100;Black+3D */
    background: #7d7e7d; /* Old browsers */
    background: -moz-linear-gradient(top, #7d7e7d 0%, #0e0e0e 100%); /* FF3.6-15 */
    background: -webkit-linear-gradient(top, #7d7e7d 0%,#0e0e0e 100%); /* Chrome10-25,Safari5.1-6 */
    background: linear-gradient(to bottom, #7d7e7d 0%,#0e0e0e 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#7d7e7d', endColorstr='#0e0e0e',GradientType=0 ); /* IE6-9 */
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
            'class' => 'navbar-inverse my-navbar navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => 'http://localhost/deposite/frontend/web/index.php?r=site/index'],
        ['label' => 'Login', 'url' => ['/site/login']],
        ['label' => 'Register', 'url' => ['/site/register']],
        ['label' => 'Thao tác',
                'url' => ['#'],
                'template' => '<a href="{url}" >{label}<i class="fa fa-angle-left pull-right"></i></a>',
            'items' => [
                    ['label' => 'Tạo hoá đơn', 'url' => Yii::getAlias('@web').'/index.php?r=dashboard/invoice-create'],
                    ['label' => 'Tìm hoá đơn', 'url' => Yii::getAlias('@web').'/index.php?r=dashboard/search'],
                    ['label' => 'Xoá gia hạn', 'url' => Yii::getAlias('@web').'/index.php?r=dashboard/invoice-extend-delete'],
                    ['label' => 'Hoá đơn đã tạo', 'url' => Yii::getAlias('@web').'/index.php?r=dashboard/invoice-created'],
                    ['label' => 'Truy xuất hoá đơn đóng', 'url' => Yii::getAlias('@web').'/index.php?r=dashboard/invoice-close-from-date'],
                    ['label' => 'Logout', 'url' => Yii::getAlias('@web').'/index.php?r=dashboard/logout']
                ]
        //['label' => 'Logout', 'url' => ['/site/logout']]
        ]];
    
//    $menuItems[] = '<li>'
//        . Html::beginForm(['/site/logout'], 'post')
//        . Html::submitButton(
//            'Logout',
//            ['class' => 'btn btn-success logout']
//        )
//        . Html::endForm()
//        . '</li>';
    
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
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
