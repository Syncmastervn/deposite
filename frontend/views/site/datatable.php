<?php
    $this->registerJsFile(Yii::getAlias('@web').'/js/jquery.dataTables.min.js',['depends' => 'yii\web\JqueryAsset']);
$this->registerJsFile(Yii::getAlias('@web').'/js/datatable.js',['depends' => 'yii\web\JqueryAsset']);
    $this->registerCssFile(Yii::getAlias('@web').'/css/jqueryDataTables.css');
?>


<table id="datatable" class="display compact">
    <thead>
        <tr>
            <th>ID</th>
            <th>City</th>
            <th>Country</th>
            <th>Phone</th>
            <th>Edit</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th>1</th>
            <th>Ho Chi Minh</th>
            <th>Vietnam</th>
            <th>091</th>
            <th><a href="https://www.w3schools.com">edit</a></th>
        </tr>
        <tr>
            <th>2</th>
            <th>Da Nang</th>
            <th>Vietnam</th>
            <th>099</th>
            <th><a href="https://www.w3schools.com">edit</a></th>
        </tr>
        <tr>
            <th>3</th>
            <th>Phuket</th>
            <th>Thailand</th>
            <th>880</th>
            <th><a href="https://www.w3schools.com">edit</a></th>
        </tr>
        <tr>
            <th>4</th>
            <th>Sysney</th>
            <th>Australia</th>
            <th>33</th>
            <th><a href="https://www.w3schools.com">edit</a></th>
        </tr>
        <tr>
            <th>5</th>
            <th>Tokyo</th>
            <th>Japan</th>
            <th>13</th>
            <th><a href="https://www.w3schools.com">edit</a></th>
        </tr>
        <tr>
            <th>1</th>
            <th>Ho Chi Minh</th>
            <th>Vietnam</th>
            <th>091</th>
            <th><a href="https://www.w3schools.com">edit</a></th>
        </tr>
        <tr>
            <th>2</th>
            <th>Da Nang</th>
            <th>Vietnam</th>
            <th>099</th>
            <th><a href="https://www.w3schools.com">edit</a></th>
        </tr>
        <tr>
            <th>3</th>
            <th>Phuket</th>
            <th>Thailand</th>
            <th>880</th>
            <th><a href="https://www.w3schools.com">edit</a></th>
        </tr>
        <tr>
            <th>4</th>
            <th>Sysney</th>
            <th>Australia</th>
            <th>33</th>
            <th><a href="https://www.w3schools.com">edit</a></th>
        </tr>
        <tr>
            <th>5</th>
            <th>Tokyo</th>
            <th>Japan</th>
            <th>13</th>
            <th><a href="https://www.w3schools.com">edit</a></th>
        </tr>
    </tbody>
</table>