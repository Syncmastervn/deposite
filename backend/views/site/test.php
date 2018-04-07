<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;


$this->title = 'Test';
$this->params['breadcrumbs'][] = $this->title;
?>
<center>
    <h2><?= $data ?></h2>
</center>

<div class="test-page">
    <? echo Html::a('Gia hạn', ['site/test', 'id' => '3', 'extend' => '2'], ['class' => 'btn btn-primary btn-sm']) ?>
    <? echo Html::a('Kết thúc', ['site/test', 'id' => '1', 'extend' => '3'], ['class' => 'btn btn-danger btn-sm']) ?>
</div>