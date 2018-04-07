$(document).ready(function(){
    $('#datatable-invoice').dataTable({"searching": false
});
    $('#datatable-invoice-limit').dataTable({"searching": false
});
    
    $(".descript").each(function(){
        var content = $(this).html();
        var str = content.slice(0,15);
        $(this).html(str + "...");
    });
});