$(document).ready(function(){
    $('#datatable').dataTable();
    
    //Search at collum 2
//    $('#column2_search').on( 'keyup', function () {
//    table
//        .columns( 2 )
//        .search( this.value )
//        .draw();
//    });
    
    $(".descript").each(function(){
        var content = $(this).html();
        var str = content.slice(0,45);
        $(this).html(str + "...");
    });
    
});