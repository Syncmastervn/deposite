<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Invoice Extend Delete';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile(Yii::getAlias('@web').'/js/search-site.js',['depends' => 'yii\web\JqueryAsset']);

$this->registerJsFile(Yii::getAlias('@web').'/js/jquery.dataTables.min.js',['depends' => 'yii\web\JqueryAsset']);

$this->registerJsFile(Yii::getAlias('@web').'/js/table.searchSite.js',['depends' => 'yii\web\JqueryAsset']);

$this->registerCssFile(Yii::getAlias('@web').'/css/jqueryDataTables.css');
?>
<div class="invoice-limit-delete">
    
<?php $form = ActiveForm::begin(['id'=>'InvoiceLimitDelete']); ?>
  
   <?= $form->field($model,'billcode')->textInput(['autofoucus'=>true, 'type'=>'number'])->hint('Nhập số'); ?>
   <?= Html::submitButton('Tìm mã hoá đơn',['class'=>'btn btn-success']); ?>
    
<?php $form = ActiveForm::end(); ?>
    
    <hr>
    <?php if($invoice !== null && $invoice !== 0): ?>
        <table id="datatable" class="display compact">
            <thead>
                <tr>
                    <th>Mã hoá đơn</th>
                    <th>Tên khách hàng</th>
                    <th>Giá trị cầm</th>
                    <th>Số lần gia hạn</th>
                    <th>Thao tác</th>
                </tr>
            </thead>0
            <tbody>
                <tr>
                    <th><?= $invoice->billCode ?></th>
                    <th><?= $invoice->customerName ?></th>
                    <th><?= $invoice->deposite_price ?></th>
                    <th><?= $invoice->extended ?></th>
                    <!-- <th><a href="<?= Yii::getAlias('@web') ?>/index.php?r=dashboard/invoice-extend-delete&id=<?= $invoice->invoiceID ?>">
                            <img src="http://<?php echo $_SERVER['SERVER_NAME'] . '/deposite/uploads/delete_icon.png'; ?>" width="20px" height="20px">
                        </a> 
                    </th> -->
                    <th>
                        <?php if($invoice->extended == 0): ?>
                            <img src="http://<?php echo $_SERVER['SERVER_NAME'] . '/deposite/uploads/alert_icon.png'; ?>" width="20px" height="20px">
                        <?php else: ?>
                            <a href="<?= Yii::getAlias('@web') ?>/index.php?r=dashboard/invoice-extend-delete&id=<?= $invoice->invoiceID ?>">
                            <img src="http://<?php echo $_SERVER['SERVER_NAME'] . '/deposite/uploads/delete_icon.png'; ?>" width="20px" height="20px">
                        </a>
                        <?php endif; ?>
                    </th>
                    
                </tr>
                
            </tbody>
        </table>
    <?php elseif($invoice == 0): ?>
    <b>Chờ nhập mã hoá đơn để tìm kiếm !</b>
    <?php elseif($invoice == -1): ?>
    <b>Không tìm thấy hoá đơn</b>
    <?php endif; ?>
</div>