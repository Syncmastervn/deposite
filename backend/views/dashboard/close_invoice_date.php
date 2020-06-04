<?php
    use yii\helpers\Html;
    use yii\helpers\ArrayHelper;
    use yii\widgets\ActiveForm;
    use backend\models\ProductType;
    $this->title = 'Invoice close';
    $this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile(Yii::getAlias('@web').'/js/jquery.dataTables.min.js',['depends' => 'yii\web\JqueryAsset']);
$this->registerJsFile(Yii::getAlias('@web').'/js/close-invoice-by-date.js',['depends' => 'yii\web\JqueryAsset']);
$this->registerCssFile(Yii::getAlias('@web').'/css/jqueryDataTables.css');

$this->registerJsFile(Yii::getAlias('@web').'/js/jquery-ui.js',['depends' => 'yii\web\JqueryAsset']);  //date Picker - JqueryUi
$this->registerJsFile(Yii::getAlias('@web').'/js/currency_converter.js',['depends' => 'yii\web\JqueryAsset']);
$this->registerCssFile(Yii::getAlias('@web').'/css/jquery-ui.css');
$this->registerCssFile(Yii::getAlias('@web').'/css/monitor-page.css');
?>

<?php $form = ActiveForm::begin(['id'=>'CloseInvoiceFromDate']); ?>

    <?= $form->field($model,'from_date',['inputOptions' => ['autoComplete'=>'off']]) ?>
    <?= $form->field($model,'to_date', ['inputOptions' => ['autoComplete'=>'off']]) ?>
    <?= Html::submitButton('Tìm thông tin', ['class' => 'btn btn-success']) ?>
    
<?php $form = ActiveForm::end(); ?>


<?php if($invoiceLimit == null): ?>
<h3>Xin chọn thời gian hiển thị</h3>
<?php else: ?>
   <table id="datatable">
       <thead>
           <tr>
               <th width="5%">Mã HĐ</th>
               <th width="10%">Tên khách hàng</th>
               <th width="10%">Số tiền cầm</th>
               <th width="35%">Nội dung</th>
               <th width="10%">Điện thoại</th>
               <th width="20%">Ngày kết thúc</th>
           </tr>
       </thead>
       <tbody>
        <?php foreach($invoiceLimit as $row): ?>
           <tr>
               <th><?= $row['billCode'] ?></th>
               <th><?= $row['customerName'] ?></th>
               <th><span class="currency-converter"> <?= $row['deposite_price'] ?> </span></th>
               <th>
                    <?php if($row['classify'] == 1):?> 
                        <span class="monitor-alert">Mất giấy tờ</span>
                    <?php endif; ?>
                    <?php if($row['classify'] == 2): ?>
                        <span class="monitor-alert">Thanh Lý</span>
                    <?php endif; ?>
                    <?= $row['description'] ?>
               </th>
               <th><?= $row['cusMobile'] ?></th>
               <th><?= $row['date_off'] ?></th>
           </tr>
        <?php endforeach; ?>
       </tbody>
   </table>
<?php endif; ?>




