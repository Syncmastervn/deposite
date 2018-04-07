<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Search';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="search-invoice">

   
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Nhập những thông số cần tìm</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'search-form']); ?>

                <?= $form->field($model, 'billcode')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'cus_name') ?>
                
                <?= $form->field($model, 'mobile') ?>

                <div class="form-group">
                    <?= Html::submitButton('Tìm kiếm', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
