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
    


    $("#invoicecreate-date_on").datepicker({
        dateFormat: "yy-mm-dd"
    });
    
});

