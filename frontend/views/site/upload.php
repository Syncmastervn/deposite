<?php
   use yii\widgets\ActiveForm;
?>
<br>
<br>
<br>
<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']])?>
<?= $form->field($model, 'image')->fileInput() ?>
   <button>Submit</button>
<?php ActiveForm::end() ?>
