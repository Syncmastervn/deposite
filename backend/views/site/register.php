<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title = 'Register';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $this->registerJsFile(Yii::getAlias('@web').'/js/register.js',['depends' => 'yii\web\JqueryAsset']); ?>

<?php echo "<h2>".$login."</h2>"; ?>
<h1>Register</h1>
<?php $form = ActiveForm::begin(['id' => 'register-form']); ?>

    <?= $form->field($model,'username')->textInput(['autofocus' => true])->hint('Tên đăng nhập'); ?>
    <?= $form->field($model,'password')->passwordInput(); ?>
    <?= $form->field($model,'password_repeat')->passwordInput(); ?>
    <?= Html::submitButton('Đăng ký',['class' => 'btn btn-success']); ?>
    
<?php $form = ActiveForm::end() ?>

<?php //Yii::$app->controller->renderPartial('//_partial'); ?>