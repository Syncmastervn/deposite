$(document).ready(function(){
    console.log("Running");
    $('#datatable').dataTable();
    
    //Search at collum 2
    $('#column2_search').on( 'keyup', function () {
    table
        .columns( 2 )
        .search( this.value )
        .draw();
    });
});