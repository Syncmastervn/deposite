<?php
    use yii\helpers\Html;
    use yii\helpers\ArrayHelper;
    use yii\widgets\ActiveForm;
    //use backend\models\ProductType;
    use backend\models\ReportInvoiceCreate;
    
    $this->registerJsFile(Yii::getAlias('@web').'/js/datepicker.js',['depends' => 'yii\web\JqueryAsset']);
    $this->registerJsFile(Yii::getAlias('@web').'/js/jquery-ui.js',['depends' => 'yii\web\JqueryAsset']);  //date Picker - JqueryUi
    $this->registerCssFile(Yii::getAlias('@web').'/css/jquery-ui.css');
    $this->title = 'Invoice close';
    $this->params['breadcrumbs'][] = $this->title;
?>

<h1>This is Report</h1>

<?php $form = ActiveForm::begin(['id'=>'ReportInvoiceCreated']); ?>

    <?= $form->field($model,'begin_date',['inputOptions' => ['autoComplete'=>'off']])->label(false) ?>
    <?= $form->field($model,'end_date', ['inputOptions' => ['autoComplete'=>'off']])->label(false) ?>
    <?= Html::submitButton('Tìm thông tin', ['class' => 'btn btn-success']) ?>
    
<?php $form = ActiveForm::end(); ?>