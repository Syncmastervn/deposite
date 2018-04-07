<?php
    use yii\helpers\Html;
    use yii\helpers\ArrayHelper;
    use yii\widgets\ActiveForm;
    use backend\models\ProductType;
    $this->title = 'Invoice Update';
    $this->params['breadcrumbs'][] = $this->title;

    $this->registerJsFile(Yii::getAlias('@web').'/js/invoice-update.js',['depends' => 'yii\web\JqueryAsset']); 
?>
<?php if($model->image === null): ?>
<div>
    <a href="<?= Yii::getAlias('@web') ?>/index.php?r=dashboard/upload-image&id=<?= $model->id ?>" class="btn btn-primary" role="button">Chụp hình sản phẩm</a>
</div>
<?php endif; ?>
<p></p>
<?php $form = ActiveForm::begin(['id'=>'CreateInvoiceForm']); ?>
    <?= $form->field($model,'id')->textInput(['readOnly'=>true]);?>
    <?= $form->field($model,'billcode'); ?>
    <?= $form->field($model,'cus_name'); ?>
    <?= $form->field($model,'cus_mobile'); ?>
    <?= $form->field($model,'cus_address'); ?>
    <?= $form->field($model,'deposite'); ?>
    <?= $form->field($model,'selling'); ?>
    <?= $form->field($model,'weight'); ?>
    <?= $form->field($model,'weight_total'); ?>
    <?= $form->field($model,'extend')->textInput(['readOnly'=>true]); ?>
    <?= $form->field($model,'description')->textArea(['rows'=>4]); ?>
    <?= Html::submitButton('Cập nhật chỉnh sửa', ['class' => 'btn btn-success']) ?>
<?php $form = ActiveForm::end(); ?>