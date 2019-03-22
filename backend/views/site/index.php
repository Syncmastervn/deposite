
<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
$this->registerCssFile(Yii::getAlias('@web').'/css/index-backend.css');
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Chào quản trị viên !</h1>

        <p class="lead">Các thao tác dùng để tinh chỉnh hệ thống</p>
        <p> 
            
        </p> 
        
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4 bg-primary text-white border-line">
                <h2>Tạo hoá đơn mới </h2>

                <p>
                    Khu vực nhập thông tin sản phẩm và khách hàng để tạo hoá đơn mới trong hệ thống
                </p>
                <p>
                    **Lưu ý: Khi tạo hoá đơn mới luôn xem xét kỹ cân nặng và số tiền cầm của khác hàng, sau khi chọn tạo hoá đơn mới thành công phải xem lại kết quả cho thật chính xác
                </p><br>

                <p><a class="btn btn-default" href="http://localhost/deposite/backend/web/index.php?r=dashboard/invoice-create">Tạo hoá đơn</a></p>
            </div>
            <div class="col-lg-4 bg-success text-dark border-line">
                <h2>Tìm hoá đơn</h2>

                <p>Khu vực nhập thông tin để tìm kiếm hoá đơn của khách hàng để thực hiện các thao tác xoá, chỉnh sửa và bổ sung thông tin</p>
                <p>Người dùng được cấp quyền mới có thể xoá hoá đơn hoặc chỉnh sửa</p>
                <br>
                <p><a class="btn btn-default" href="http://localhost/deposite/backend/web/index.php?r=dashboard/search">Tìm hoá đơn</a></p>
            </div>
            <div class="col-lg-4 bg-info text-white border-line">
                <h2>Kiểm tra giao dịch</h2>

                <p>Khu vực hiển thị các thao tác tạo mới, gia hạn và kết thúc các hoá đơn theo ngày được chọn lựa để kiểm tra cuối ngày và kiểm tra tổng thể các hoạt động trong ngày</p>
                <p>Khi kiểm tra nếu có vấn đề xảy ra phải thông báo ngay </p>
                <br><br>
                <p><a class="btn btn-default" href="http://localhost/deposite/backend/web/index.php?r=dashboard/monitor">Kiểm tra</a></p>
            </div>
        </div>

    </div>
</div>
