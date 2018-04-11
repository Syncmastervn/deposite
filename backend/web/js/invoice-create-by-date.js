$(document).ready(function(){
    $("#invoicecreatebydate-date_begin").datepicker({
        dateFormat: "yy-mm-dd"
    });
    
    $("#invoicecreatebydate-date_end").datepicker({
        dateFormat: "yy-mm-dd"
    });
    
    $('#datatable').dataTable();
     
    console.log("Invoice create by date");
});