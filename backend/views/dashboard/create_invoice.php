<?php
    use yii\helpers\Html;
    use yii\helpers\ArrayHelper;
    use yii\widgets\ActiveForm;
    use backend\models\ProductType;
    $this->title = 'CreateInvoice';
    $this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile(Yii::getAlias('@web').'/js/jquery.dataTables.min.js',['depends' => 'yii\web\JqueryAsset']);
$this->registerJsFile(Yii::getAlias('@web').'/js/invoice-create.js',['depends' => 'yii\web\JqueryAsset']);
$this->registerCssFile(Yii::getAlias('@web').'/css/jqueryDataTables.css');
$this->registerCssFile(Yii::getAlias('@web').'/css/invoice-create.css');

$this->registerJsFile(Yii::getAlias('@web').'/js/jquery-ui.js',['depends' => 'yii\web\JqueryAsset']);
$this->registerCssFile(Yii::getAlias('@web').'/css/jquery-ui.css');

?>



<?php $form = ActiveForm::begin(['id'=>'CreateInvoiceForm']); ?>

    <?= $form->field($model,'billcode')->textInput(['autofocus'=>true,'type'=>'number'])->hint('Số thứ tự trên hoá đơn'); ?>
    <?= $form->field($model,'type')->dropDownList(
                                ArrayHelper::map(ProductType::find()->all(),'typeID','name'),
                                [
                                    'prompt'=>'Chọn loại vàng'
                                ]
                            ); ?>
    <?= $form->field($model,'date_on'); ?>
    <?= $form->field($model,'cus_name')->hint('Tên khách hàng'); ?>
    <?= $form->field($model,'cus_mobile')->textInput(['type'=>'number'])->hint('Nhập số'); ?>
    <?= $form->field($model,'cus_address')->hint('vd: An Lộc - Bình Long');?>
    <?= $form->field($model,'deposite')->textInput(['type'=>'number']); ?>
    <?= $form->field($model,'selling')->textInput(['type'=>'number']); ?>
    <?= $form->field($model,'weight')->textInput(['type'=>'number'])->hint('Chỉ tính cân nặng của vàng'); ?>
    <?= $form->field($model,'weight_total')->textInput(['type'=>'number']); ?>
    <?= $form->field($model,'description')->textArea(['rows'=>4]); ?>
    <?= Html::submitButton('Xuất hoá đơn', ['class' => 'btn btn-success']) ?>
<?php $form = ActiveForm::end(); ?>

<!-- Trigger/Open The Modal -->
<button id="modalButton">Open Modal</button>

<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
  <div class="modal-header">
      <span class="close"><font size="25" color="red">&times;</font></span>
    <h3 class="message-title">Thông Báo</h2>
  </div>
  <div class="modal-body">
      <p class="message-header"><b>Mã hoá đơn không hợp lệ</b></p>
    <p class="message-content">Trùng mã hoá đơn</p>
  </div>
  <div class="modal-footer">
    
  </div>
</div>
  
<script>

</script>