<?php
   use yii\widgets\ActiveForm;
?>
<br>
<br>
<br>
<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']])?>
<?= $form->field($model,'id')->textInput(['readOnly'=>true]) ?>

<?= $form->field($model, 'image')->fileInput() ?>
<br>
<br>
<br>
   <button class="btn btn-primary btn-lrg">Lưu hình</button>
<?php ActiveForm::end() ?>
