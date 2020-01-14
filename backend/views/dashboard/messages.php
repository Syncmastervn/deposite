<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

    use yii\helpers\Html;
    use yii\bootstrap\ActiveForm;

    $this->title = 'Messages';
    $this->params['breadcrumbs'][] = $this->title;

    $this->registerJsFile(Yii::getAlias('@web').'/js/jquery-ui.js',['depends' => 'yii\web\JqueryAsset']);  //date Picker - JqueryUi
    
    $this->registerJsFile(Yii::getAlias('@web').'/js/main.js',['depends' => 'yii\web\JqueryAsset']);
    $this->registerJsFile(Yii::getAlias('@web').'/js/messages-page.js',['depends' => 'yii\web\JqueryAsset']);
    $this->registerJsFile(Yii::getAlias('@web').'/js/modernizr.js',['depends' => 'yii\web\JqueryAsset']);
    //$this->registerJsFile(Yii::getAlias('@web').'/js/monitor-page.js',['depends' => 'yii\web\JqueryAsset']);
    $this->registerCssFile(Yii::getAlias('@web').'/css/jquery-ui.css');
    $this->registerCssFile(Yii::getAlias('@web').'/css/reset.css');
    $this->registerCssFile(Yii::getAlias('@web').'/css/style.css');
    
    
?>
<style>
    .toggler { width: 500px; height: 200px; position: relative; }
    #effect { width: 240px; height: 100px; padding: 0.4em; position: relative; background: #fff; }
    #effect h3 { margin: 0; padding: 0.4em; text-align: center; }
    #ui-widget-header { background-color: yellow;}
  </style>
<div class="container">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <h4><?= $title ?></h4>
            <b>Messages: </b>
            <div class="alert alert-success" role="alert">
              <h3><?= $message ?></h>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
    <br/><br/><br/><br/><br/><br/>
    
    
  <?php if($status == 1): ?>
    
    <a href="#1" class="btn btn-sm btn-primary">View Pop-up </a>

    <div class="cd-popup" role="alert">
            <div class="cd-popup-container">
                    <p>Are you sure you want to delete this element?</p>
                    <ul class="cd-buttons">
                            <li><a href="#2">Yes</a></li>
                            <li><a href="#3">No</a></li>
                    </ul>
                    <a href="#0" class="cd-popup-close img-replace">Close</a>
            </div> <!-- cd-popup-container -->
    </div> <!-- cd-popup -->
    
  <div class="toggler">
  <div id="effect" class="ui-widget-content ui-corner-all">
    <h3 class="ui-widget-header ui-corner-all">Cảnh báo</h3>
    <p>
      Hoá đơn đã được khách hàng báo mất giấy, xin vui lòng xem kỹ lại thông tin trước khi kết thúc hoá đơn
    </p>
  </div>
</div>
  <?php endif; ?>
    
    <!-- <a href="#1" class="btn btn-sm btn-danger" value="this is value">View Pop-up b</a> -->

    
</div>


