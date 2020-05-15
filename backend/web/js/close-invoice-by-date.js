$(document).ready(function(){
    console.log("Close invoice by date . RUNNING .");
    
    $("#closeinvoicedate-from_date").datepicker({
        dateFormat: "yy-mm-dd"
    });
    
    $("#closeinvoicedate-to_date").datepicker({
        dateFormat: "yy-mm-dd"
    });
    
    $('#datatable').dataTable();
    
 
});

