$(document).ready(function(){
    $("#invoicecreatebydate-date_begin").datepicker({
        dateFormat: "yy-mm-dd"
    });
    
    $("#invoicecreatebydate-date_end").datepicker({
        dateFormat: "yy-mm-dd"
    });
    
    $('#datatable').dataTable();
    
    $(".currency-converter").each(function(){
        var num = $(this).html();
        var number = num.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
        $(this).html(number);
    });
     
    console.log("Invoice create by date");
});