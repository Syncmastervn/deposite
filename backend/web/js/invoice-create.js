
$(document).ready(function(){
    console.log("Ready");
    $("#invoicecreate-deposite").keyup(function (e){ 
        //alert("Press");
        var num = $(this).val();
        var n = num.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
        $("label[for='invoicecreate-deposite']").text("Số tiền cầm: " + n);
    });
    
    $("#invoicecreate-selling").keyup(function (e){ 
        //alert("Press");
        var num = $(this).val();
        var n = num.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
        $("label[for='invoicecreate-selling']").text("Giá trị sản phẩm: " + n);
    });
    
    //Check billcode exists 
    $("#invoicecreate-type").focus(function(){
        console.log("ajax on");
        districtName = null;
        districtId = null;
        $.ajax({
            url: "index.php",
            data: {
                r: "dashboard/api",
                data: "chkBillCode",
                billcode: $("#invoicecreate-billcode").val()
            },
            method: "GET",
            dataType: "JSON"
        }).done(function(dataResponse) {
            console.log(dataResponse);
            if(dataResponse === false)
            {
                console.log('Nothing..');
            } else
            {
                // cusName = dataResponse.map(item => item.customerName);
                cusName = dataResponse.customerName;
                invoiceId = dataResponse.invoiceID;
                billcode = dataResponse.billCode;
                description = dataResponse.description;
                date = dataResponse.date_on;
                weightTotal = dataResponse.weight_total;
                // invId = dataResponse.map(item => item.invoiceID);
                console.log(cusName);
                console.log(invoiceId);
                content = "<b>Mã hoá đơn:</b> " + billcode + "<br><b>Tên khách hàng:</b> " + cusName + "<br><b>Tô tả chi tiết:</b> " + description + 
                            "<br><b>Ngày tạo hoá đơn:</b> " + date + "<br><b>Tổng cân nặng:</b> " + weightTotal;
                $(".message-title").html("<font color='red'>Thông báo: Trùng Mã Hoá Đơn</font>");
                $(".message-header").html("<b>Đã tồn tại hoá đơn có mã hoá đơn như sau</b>");
                $(".message-content").html(content);
                
                $("#modalButton").click();
                //updateDistrict();
            }
            
        });
    });
 
          
    //Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("modalButton");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
};

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
};

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target === modal) {
        modal.style.display = "none";
    }
};

    
    
    
});

