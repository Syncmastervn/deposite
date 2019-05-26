$(document).ready(function(){
    new Date().toLocaleString("VN", {timeZone: "Asia/Ho_Chi_Minh"});
    
    $(".extend").click(function(){
        if(!confirm("Đồng ý gia hạn ?"))
        {
            return false;
        }
    });
    
    $(".reducer").click(function(){
        if(!confirm("Đồng ý xoá gia hạn ?"))
        {
            return false;
        }
    });
    
    $(".date-db").each(function(){
            var content = $(this).html();
            var dateTime = new Date(content);
            var date = dateTime.getDate();
            var month = dateTime.getMonth();
            var monthConverted = (month == 12) ? month : month + 1;
            var year = dateTime.getFullYear();
            var result = date + '-' + monthConverted + '-' + year;
            $(this).html(result);
    });
    
    $(".currency-converter").each(function(){
        var num = $(this).html();
        var number = num.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
        $(this).html(number);
    });
});