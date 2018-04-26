$(document).ready(function(){
    console.log("Ready Andie");
    var getDate = new Date();
    //var today = getDate.getMonth() + '-' + getDate.getDate() + '-' +  getDate.getFullYear();
    var today = getDate.getFullYear() + '-' + getDate.getMonth() + '-' + getDate.getDate();
    
    
    $(".date-db").each(function(){
            var content = $(this).html();
            var date = new Date(content);
            var today = new Date();
            var diff = new Date(today - date);
            var days = diff/1000/60/60/24;
            $(this).html(Math.round(days));
    });
    
    $(".currency-converter").each(function(){
        var num = $(this).html();
        var number = num.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
        $(this).html(number);
    });
    
    console.log("Running");
    $('#datatable').dataTable();
    
    //Search at collum 2
    $('#column2_search').on( 'keyup', function () {
    table
        .columns( 2 )
        .search( this.value )
        .draw();
    });
    
    $(".date-converter").each(function(){
        var get_date = new Date($(this).html());
        var set_date = getDate.getDate() + '-'  + getDate.getMonth() + '-'  + getDate.getFullYear() ;
        $(this).html(set_date);
    });
    
    $("a.fancy").fancybox();
});