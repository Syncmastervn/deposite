$(document).ready(function(){
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
});