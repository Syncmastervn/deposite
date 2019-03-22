<?php
    use yii\helpers\Html;
    use yii\helpers\ArrayHelper;
    use yii\widgets\ActiveForm;
    $this->title = 'User Manager';
    $this->params['breadcrumbs'][] = $this->title;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    $listData = array(1 => 'Administrator', 2 => 'Genneral Manager', 3 => 'Manager');
    $cityName = 'cityID';
 
?>
<h2>User Manager</h2>
<hr>
<div class="row">
    <div class="col-md-6">
    <?php $form = ActiveForm::begin(['id'=>'UserManager']); ?>
        <?= $form->field($model,'userID')->textInput(['readOnly'=>true]); ?>
        <?= $form->field($model,'userName'); ?>
        <?= $form->field($model,'password')->passwordInput(); ?>
        <?= $form->field($model,'fullName'); ?>
        <?= $form->field($model,'authName')->dropDownList($listData,['prompt'=>$model['authName']]); ?>
        <?= Html::submitButton('Update',['class'=>'btn btn-success']); ?>
    <?php $form = ActiveForm::end(); ?>
    </div>
    <div class="col-md-6"></div>
</div>
