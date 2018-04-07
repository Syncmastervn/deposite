<?php

/* @var $this yii\web\View */  

    $this->title = 'My Yii Application';

    $this->registerJsFile(Yii::getAlias('@web').'/js/jquery.fancybox.min.js',['depends' => 'yii\web\JqueryAsset']);

    $this->registerJsFile(Yii::getAlias('@web').'/js/jquery.mousewheel-3.0.4.pack.js',['depends' => 'yii\web\JqueryAsset']);

    $this->registerCssFile(Yii::getAlias('@web').'/css/jquery.fancybox.min.css',['depends' => 'yii\web\JqueryAsset']);
?>


<h1>hello</h1>
<a id="example1" href="http://localhost:8888/deposite/uploads/46_282.jpg" title="Lorem ipsum dolor sit amet, consectetur adipiscing elit.">fancybox click</a>

<a data-fancybox="gallery" href="http://localhost:8888/deposite/uploads/46_282.jpg">
    img click me
</a>
