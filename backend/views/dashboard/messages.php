<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

    use yii\helpers\Html;
    use yii\bootstrap\ActiveForm;

    $this->title = 'Messages';
    $this->params['breadcrumbs'][] = $this->title;

    $this->registerJsFile(Yii::getAlias('@web').'/js/jquery-ui.js',['depends' => 'yii\web\JqueryAsset']);  //date Picker - JqueryUi
    //$this->registerJsFile(Yii::getAlias('@web').'/js/monitor-page.js',['depends' => 'yii\web\JqueryAsset']);
    $this->registerCssFile(Yii::getAlias('@web').'/css/jquery-ui.css');
?>
<div class="container">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <h4><?= $title ?></h4>
            <b>Messages: </b>
            <div class="alert alert-success" role="alert">
              <h3><?= $message ?></h>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>


