$(document).ready(function(){
    console.log("Close invoice by date . RUNNING .");
    
    $("#closeinvoicedate-from_date").datepicker({
        dateFormat: "yy-mm-dd"
    });
    
    $("#closeinvoicedate-to_date").datepicker({
        dateFormat: "yy-mm-dd"
    });
    
    $('#datatable').dataTable();
    
    $(".currency-converter").each(function(){
        var num = $(this).html();
        var number = num.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
        $(this).html(number);
    });
});

