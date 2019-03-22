/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function(){
   $("#invoiceupdate-price").keyup(function (e){
       var num = $(this).val();
       var n = num.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
       $("label[for='invoiceupdate-price']").text("Tiền lãi kết thúc: " + n );
   })
});

