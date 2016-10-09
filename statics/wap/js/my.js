/**
 * My module:
 *  个人中心
 */
X.sub("init", function() {
    var h = $(window).height();
    $("#center").css({
        "min-height": (h - 80)
    });

    $(".signoff").click(function() {
        window.location.href="/index.php?&a=logout";
    });


});