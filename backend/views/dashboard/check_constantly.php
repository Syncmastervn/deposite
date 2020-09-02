<?php
    use yii\helpers\Html;
    use yii\helpers\ArrayHelper;
    use yii\widgets\ActiveForm;
    use backend\models\ProductType;
    $this->title = 'Check Constantly';
    $this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile(Yii::getAlias('@web').'/js/jquery.dataTables.min.js',['depends' => 'yii\web\JqueryAsset']);
$this->registerJsFile(Yii::getAlias('@web').'/js/check-constantly.js',['depends' => 'yii\web\JqueryAsset']);
$this->registerCssFile(Yii::getAlias('@web').'/css/jqueryDataTables.css');
$this->registerCssFile(Yii::getAlias('@web').'/css/check-constantly.css');

$this->registerJsFile(Yii::getAlias('@web').'/js/jquery-ui.js',['depends' => 'yii\web\JqueryAsset']);
$this->registerCssFile(Yii::getAlias('@web').'/css/jquery-ui.css');

?>

<input type="text" class="input" id="input-code" size="50"></input>
<p></p>
<div class="show-content">
      <div class="col-md-3 col-lg-3 invoice-deleted">Hoá đơn kết thúc: 0</div>
      <p>
      <div class="barcode">Hoá đơn chưa thanh lý: 0</div>
      <div class="tbl-header"><h3>Hoá đơn kết thúc</h3></div>
  </div>
<div style="overflow-y:auto;" class="scroll">
  
  <br>
  <div>  
      <table class="table" id="table-db">
          <thead>
              <th width = 2% >Stt</th>
              <th width = 4%>Mã hoá đơn</th>
              <th width = 7%>Tên khách hàng</th>
              <th width = 15%>Nội dung hoá đơn</th>
              <th width = 5%>Ngày tạo</th>
              <th width = 5%>Ngày kết thúc</th>
          </thead>
          <tbody>
          </tbody>
      </table>
  </div>
</div>
<br>
<!-- Trigger the modal with a button -->
<button type="button" id="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <p class="inner-content">Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>