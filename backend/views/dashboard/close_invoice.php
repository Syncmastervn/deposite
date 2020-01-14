<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    $this->title = 'Close Invoice';
    $this->params['breadcrumbs'][] = $this->title;
    $this->registerJsFile(Yii::getAlias('@web').'/js/close-invoice.js',['depends' => 'yii\web\JqueryAsset']);
    $this->registerCssFile(Yii::getAlias('@web').'/css/close-invoice.css');
?>
<div class="close-invoice-site">
   <h2>Hoá đơn cần kết thúc</h2>
    <?php $form = ActiveForm::begin(['id'=>'CreateInvoiceForm']); ?>
    <?php if($invoice['classify'] == 1)
          {
    ?>  
        <div class="deposite-danger">
            Lưu ý: Hoá đơn đã được báo mất, vui lòng thông báo với quản lý cấp cao trước khi hoàn thành kết thúc hoá đơn này !
        </div>
    <?php
          }
    
    ?>
    <?= $form->field($invoice,'id')->textInput(['readOnly'=>true]); ?>
    <?= $form->field($invoice,'billcode') ?>
    <?= $form->field($invoice,'cus_name') ?>
    <?= $form->field($invoice,'cus_mobile') ?>
    <?= $form->field($invoice,'deposite') ?>
    <?= $form->field($invoice,'description')->textArea(['rows'=>4]); ?>
    <?= $form->field($invoice,'price') ?>
    <?= Html::submitButton('Kết thúc hoá đơn', ['class' => 'btn btn-success']) ?>
    
    <?php $form = ActiveForm::end(); ?>
    <h2>Số lần gia hạn</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Ngày gia hạn</th>
                <th>Ngày hoá đơn hết hạn</th>
                <th>Mô Tả</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($invoiceLimit as $row): ?>
            <tr>
                <th><?= $row['date_expands'] ?></th>
                <th><?= $row['date_off'] ?></th>
                <th><?= $row['descriptions'] ?></th>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>