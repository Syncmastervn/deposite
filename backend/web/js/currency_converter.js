$(".currency-converter").each(function(){
        var num = $(this).html();
        var number = num.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
        $(this).html(number);
    });
    