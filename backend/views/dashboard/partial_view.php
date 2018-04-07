<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Invoice Extend Delete';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile(Yii::getAlias('@web').'/js/search-site.js',['depends' => 'yii\web\JqueryAsset']);

$this->registerJsFile(Yii::getAlias('@web').'/js/jquery.dataTables.min.js',['depends' => 'yii\web\JqueryAsset']);

$this->registerJsFile(Yii::getAlias('@web').'/js/table.searchSite.js',['depends' => 'yii\web\JqueryAsset']);

$this->registerCssFile(Yii::getAlias('@web').'/css/jqueryDataTables.css');
?>