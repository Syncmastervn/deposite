<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use yii\helpers\Url;


?>

<h1>Hello</h1>
<?php echo $link; ?>
<?= Html::img($link);?>
<img src="http://<?= $link ?>" alt="Smiley face" height="200" width="350">
<?= Html::img('http://'.$link, ['alt' => 'My logo','height'=>250,'width'=>400]) ?>

