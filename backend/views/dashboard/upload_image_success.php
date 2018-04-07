<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    $this->title = 'Upload image';
    $this->params['breadcrumbs'][] = $this->title;

//$this->registerJsFile(Yii::getAlias('@web').'/js/jquery.dataTables.min.js',['depends' => 'yii\web\JqueryAsset']);
//
//$this->registerJsFile(Yii::getAlias('@web').'/js/table.invoiceLimitSite.js',['depends' => 'yii\web\JqueryAsset']);
//
//$this->registerCssFile(Yii::getAlias('@web').'/css/jqueryDataTables.css');
?>

<h1>Lưu hình ảnh thành công</h1>


<?= Html::img('http://'.$link, ['alt' => 'My logo','height'=>250,'width'=>400]) ?>




