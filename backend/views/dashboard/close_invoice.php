<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    $this->title = 'Close Invoice';
    $this->params['breadcrumbs'][] = $this->title;
?>
<div class="close-invoice-site">
   <h2>Hoá đơn cần kết thúc</h2>
    <?php $form = ActiveForm::begin(['id'=>'CreateInvoiceForm']); ?>
    <?= $form->field($invoice,'id')->textInput(['readOnly'=>true]); ?>
    <?= $form->field($invoice,'billcode') ?>
    <?= $form->field($invoice,'cus_name') ?>
    <?= $form->field($invoice,'cus_mobile') ?>
    <?= $form->field($invoice,'deposite') ?>
    <?= $form->field($invoice,'description')->textArea(['rows'=>4]); ?>
    <?= Html::submitButton('Kết thúc hoá đơn', ['class' => 'btn btn-success']) ?>
    
    <?php $form = ActiveForm::end(); ?>
    <h2>Số lần gia hạn</h2>
    <table id="datatable-invoice-extend">
        <thead>
            <tr>
                <th>Ngày gia hạn</th>
                <th>Ngày hoá đơn hết hạn</th>
                <th>Mô Tả</th>
            </tr>
        </thead>
        <tbody>
        <? foreach($invoiceLimit as $row): ?>
            <tr>
                <th><?= $row['date_expands'] ?></th>
                <th><?= $row['date_off'] ?></th>
                <th><?= $row['descriptions'] ?></th>
            </tr>
        <? endforeach; ?>
        </tbody>
    </table>
</div>