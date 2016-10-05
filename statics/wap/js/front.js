/**
 * My module:
 *  前端公共js
 */
X.sub("init", function() {
    //检查是否登录
    var user = {};
    X.sub('userLoaded', function(evt, respText) {
        user = respText;
        $(".uicon").attr("src", (user.headurl || "/images/m/header.png"));
    });
    var url = document.location.href;
    var path = window.location.pathname;
    if (path.indexOf("/m/news") !== -1) {
        path = "/m";
    }
    if (path.indexOf("/m/policy") !== -1) {
        path = "/m/policy";
    }
    var am = $("#south .menu li a");
    var cls = 'on';
    am.removeClass(cls);
    for (var i = 0; i < am.size(); i++) {
        var m = am.eq(i);
        var mas = m.attr("href");
        if (path == mas.split("?")[0]) {
            m.addClass(cls);
            break;
        }
    }
});