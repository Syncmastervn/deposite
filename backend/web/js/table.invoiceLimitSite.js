$(document).ready(function(){
    $('#datatable-invoice').dataTable({"searching": false
});
    
    
    $(".descript").each(function(){
        var content = $(this).html();
        var str = content.slice(0,15);
        $(this).html(str + "...");
    });
    
    $(".currency-converter").each(function(){
        var num = $(this).html();
        var number = num.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
        $(this).html(number);
    });
});