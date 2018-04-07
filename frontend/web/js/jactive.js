$("document").ready(function() {
    $("#myButton").click(function() {
         $("#content").load("site/myAction");
        alert("alert");
    });
});

