$(document).ready(function(){
    $(".extend").click(function(){
        if(!confirm("Đồng ý gia hạn xxx!"))
        {
            return false;
        }
    });
    console.log("Script is running now");
});