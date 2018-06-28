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
    
    $(".date-db").each(function(){
            var content = $(this).html();
            var date = new Date(content);
            var today = new Date();
            var diff = new Date(today - date);
            var days = diff/1000/60/60/24;
            $(this).html(Math.round(days) + " ngày");
    });
    
    $(".currency-converter").each(function(){
        var num = $(this).html();
        var number = num.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
        $(this).html(number);
    });
});

