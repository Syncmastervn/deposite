/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function(){
    
    $('#created-table').dataTable({
        "searching":false
    });
    
    $('#updated-table').dataTable({
        "searching":false
    });
    
    $('#deleted-table').dataTable({
        "searching":false
    });
    
    $("#monitor-date_search").datepicker({
        dateFormat: "yy-mm-dd"
    });
});

