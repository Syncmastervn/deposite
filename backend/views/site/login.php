<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
//$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .bgcolor-green {
        background: rgba(161,208,252,1);
        background: -moz-linear-gradient(-45deg, rgba(161,208,252,1) 0%, rgba(51,137,230,1) 100%);
        background: -webkit-gradient(left top, right bottom, color-stop(0%, rgba(161,208,252,1)), color-stop(100%, rgba(51,137,230,1)));
        background: -webkit-linear-gradient(-45deg, rgba(161,208,252,1) 0%, rgba(51,137,230,1) 100%);
        background: -o-linear-gradient(-45deg, rgba(161,208,252,1) 0%, rgba(51,137,230,1) 100%);
        background: -ms-linear-gradient(-45deg, rgba(161,208,252,1) 0%, rgba(51,137,230,1) 100%);
        background: linear-gradient(135deg, rgba(161,208,252,1) 0%, rgba(51,137,230,1) 100%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#a1d0fc', endColorstr='#3389e6', GradientType=1 );
        border-radius: 5px;
        color: #ffffff;
    }
</style>
<div class="site-login">
    <p></p>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4 bgcolor-green">
            <h1><?= Html::encode($this->title) ?></h1>
             <?php if($username !== null ): ?>
            <div class="alert alert-danger">
                <strong>Lỗi: </strong> Tên đăng nhập và mật khẩu không đúng, xin vui lòng nhập lại
            </div>
            <?php endif; ?>
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
        <div class="col-md-4"></div>
    </div>
</div>
