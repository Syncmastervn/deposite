<?php
    use yii\helpers\Html;
    use yii\helpers\ArrayHelper;
    use yii\widgets\ActiveForm;
    use backend\models\ProductType;
    $this->title = 'Change password';
    $this->params['breadcrumbs'][] = $this->title;

//$this->registerJsFile(Yii::getAlias('@web').'/js/jquery.dataTables.min.js',['depends' => 'yii\web\JqueryAsset']);
//$this->registerJsFile(Yii::getAlias('@web').'/js/invoice-create.js',['depends' => 'yii\web\JqueryAsset']);
//$this->registerCssFile(Yii::getAlias('@web').'/css/jqueryDataTables.css');
//$this->registerCssFile(Yii::getAlias('@web').'/css/invoice-create.css');
//
//$this->registerJsFile(Yii::getAlias('@web').'/js/jquery-ui.js',['depends' => 'yii\web\JqueryAsset']);
//$this->registerCssFile(Yii::getAlias('@web').'/css/jquery-ui.css');

?>
<?php if($signal === -1): ?>
<div class="alert alert-danger">
  <strong>Lỗi: </strong> USERNAME hoặc MẬT KHẨU không đúng, xin vui lòng nhập lại
</div>
<?php elseif($signal === 1): ?>
<div class="alert alert-success">
  <strong>Thông báo: </strong> Đã thay đổi mật khẩu thành công
</div>
<?php endif; ?>

<?php $form = ActiveForm::begin(['id'=>'RegisterUser']); ?>

    <?= $form->field($model,'username')->textInput(['autofocus'=>true])->hint('Tên đăng nhập'); ?>
    <?= $form->field($model,'old_password')->passwordInput(); ?>
    <?= $form->field($model,'password')->passwordInput(); ?>
    <?= $form->field($model,'password_repeat')->passwordInput(); ?>
   
    <?= Html::submitButton('Đăng ký', ['class' => 'btn btn-success']) ?>
<?php $form = ActiveForm::end(); ?>