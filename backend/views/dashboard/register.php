<?php
    use yii\helpers\Html;
    use yii\helpers\ArrayHelper;
    use yii\widgets\ActiveForm;
    use backend\models\ProductType;
    $this->title = 'Register User';
    $this->params['breadcrumbs'][] = $this->title;

//$this->registerJsFile(Yii::getAlias('@web').'/js/jquery.dataTables.min.js',['depends' => 'yii\web\JqueryAsset']);
//$this->registerJsFile(Yii::getAlias('@web').'/js/invoice-create.js',['depends' => 'yii\web\JqueryAsset']);
//$this->registerCssFile(Yii::getAlias('@web').'/css/jqueryDataTables.css');
//$this->registerCssFile(Yii::getAlias('@web').'/css/invoice-create.css');

//$this->registerJsFile(Yii::getAlias('@web').'/js/jquery-ui.js',['depends' => 'yii\web\JqueryAsset']);
//$this->registerCssFile(Yii::getAlias('@web').'/css/jquery-ui.css');

?>
<?php if($data === 1): ?>
    <div class="alert alert-danger">
        <strong>Lỗi: </strong> Tên user <b><?= $username ?></b> đã tồn tại, xin vui lòng chọn tên user khác
    </div>
<?php elseif($data === 2): ?>
    <div class="alert alert-success">
      <strong>Thông báo: </strong> Tạo user <b><?= $username ?></b> thành công
    </div>
<?php elseif($data === 0): ?>
    <div class="alert alert-info">
      <strong>Hướng dẫn: </strong> Vui lòng điền đầy đủ thông tin
    </div>
<?php endif; ?>
<?php $form = ActiveForm::begin(['id'=>'RegisterUser']); ?>

    <?= $form->field($model,'username')->textInput(['autofocus'=>true])->hint('Tên đăng nhập'); ?>
    <?= $form->field($model,'fullname')->hint('Tên người dùng'); ?>
    <?= $form->field($model,'password')->passwordInput(); ?>
    <?= $form->field($model,'password_repeat')->passwordInput()->hint('Nhập lại password');?>
   
    <?= Html::submitButton('Đăng ký', ['class' => 'btn btn-success']) ?>
<?php $form = ActiveForm::end(); ?>

