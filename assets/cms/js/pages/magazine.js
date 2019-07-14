$(window).bind("load", function() {
    $("li").removeClass("active");
    if(document.URL.match("/magazine")) {
        $("#magazine").toggleClass("active");
    }
});