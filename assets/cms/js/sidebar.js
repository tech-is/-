$(window).bind("load", function () {
    $("li").removeClass("active");
    if (document.URL.match("magazine")) {
        $("#magazine").toggleClass("active");
    }
    if (document.URL.match("reserve")) {
        $("#reserve").toggleClass("active");
    }
    if (document.URL.match("staff")) {
        $("#staff").toggleClass("active");
    }
});