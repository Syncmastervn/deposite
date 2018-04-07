<?php
    use yii\helpers\Html;
    use yii\helpers\ArrayHelper;
    use yii\widgets\ActiveForm;
    use backend\models\ProductType;
    $this->title = 'CreateInvoice';
    $this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile(Yii::getAlias('@web').'/js/jquery-ui.js',['depends' => 'yii\web\JqueryAsset']);
$this->registerCssFile(Yii::getAlias('@web').'/css/jquery-ui.css');

$this->registerJsFile(Yii::getAlias('@web').'/js/jqueryui.js',['depends'=>'yii\web\JqueryAsset']);
?>


<p>Date: <input type="text" id="datepicker"></p>
 

