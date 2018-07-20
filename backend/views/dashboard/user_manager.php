<?php
    use yii\helpers\Html;
    use yii\helpers\ArrayHelper;
    use yii\widgets\ActiveForm;
    $this->title = 'User Manager';
    $this->params['breadcrumbs'][] = $this->title;
    
    $hosting = $_SERVER['SERVER_NAME'] . ":80" . '/deposite/uploads/';
?>
<style>
/*    tr:nth-child(even) {background: #EFEFEF}
    tr:nth-child(odd) {background: #FFFFFF}*/
</style>
<table class=" table table-striped">
    <thead>
        <tr class="success">
            <th> Thẩm quyền </th>
            <th> Tên đăng nhập </th>
            <th> Chức danh </th>
            <th> Tên đầy đủ </th>
            <th> Trạng thái </th>
            <th> Tuỳ chọn </th>
        </tr>
    </thead>
    <tbody>
<?php foreach($user as $row): ?>
    
        <tr>
            <th><?= $row['authName'] ?></th>
            <th><?= $row['userName'] ?> </th>
            <th><?= $row['authName'] ?></th>
            <th><?= $row['fullName'] ?></th>
            <th><?= $row['status'] ?></th>
            <th>
                <a href="index.php?r=dashboard/user-manager-edit&id=<?= $row['userID'] ?> ?>" ><?= Html::img('http://'.$hosting.'lock_icon.png', ['alt' => 'My logo','height'=>25,'width'=>25]) ?></a>
                <a href="index.php?r=dashboard/user-manager-edit&id=<?= $row['userID'] ?> ?>" ><?= Html::img('http://'.$hosting.'edit_icon.ico', ['alt' => 'My logo','height'=>25,'width'=>25]) ?></a>
            </th>
        </tr>
    

<?php endforeach; ?>
    </tbody>
</table>

