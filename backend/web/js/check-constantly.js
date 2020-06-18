/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function(){
    console.log("Javascript is running...");
    var obj = [];
    var objSize = 0;
    
    $(".input").on('keyup',function(e){
       if(e.keyCode === 13 ){
           //console.log("entered...");
           var input = $(this).val();
           console.log(input + ",");
           
           $.ajax({
            url: "index.php",
            data: {
                r: "dashboard/api",
                data: "invoiceInfo",
                billcode:  $("#input-code").val()  //$("#invoicecreate-billcode").val()
            },
            method: "GET",
            dataType: "JSON"
            }).done(function(dataResponse) {
                console.log(dataResponse);
                if(dataResponse === false)
                {
                    notFound(input);
                } else
                {
                    // cusName = dataResponse.map(item => item.customerName);
                    // invId = dataResponse.map(item => item.invoiceID);
                    if(dataResponse.status === "0")
                    {
//                        console.log(obj[objSize].description);
                        obj[objSize] = {
                            cusName: dataResponse.customerName,
                            invoiceId: dataResponse.invoiceID,
                            billcode: dataResponse.billCode,
                            description: dataResponse.description,
                            date: dataResponse.date_on,
                            date_off: dataResponse.date_off,
                            weightTotal: dataResponse.weight_total,
                            status: dataResponse.status
                        };
                        var str = "<tr><td>"+(objSize + 1) +"</td><td>"+obj[objSize].billcode+"</td><td>"+obj[objSize].cusName+"</td><td>"+obj[objSize].description+"</td><td>"+(obj[objSize].date).slice(0,10)+"</td><td>"+(obj[objSize].date_off).slice(0,10)+"</td></tr>";
                        $("#table-db").append(str);
                        objSize++;
                    }
                    if(dataResponse.status === "1")
                    {
                        $(".barcode").html("Hoá đơn mã số: <b>" + dataResponse.billCode + "</b> chưa được thanh lý");
                    }
                   
                   
                   $(".invoice-deleted").html("Hoá đơn đã thanh lý: <b>" + objSize + "</b>");
                }
            });
            
//            var str = "<tr><td>"+objSize+"</td><td>"++"</td><td>"+obj[0].date+"</td></tr>";
//            $("#table-db").append(str);
        
           $(this).val(null);
           //store();
       }
    });
    
    function notFound(input){
        $(".modal-title").html("Thông Báo");
        $(".inner-content").html("Không tìm thấy hoá đơn mã số : <b>" + input + "</b>");
        $("#button").click();
        
    }
});

