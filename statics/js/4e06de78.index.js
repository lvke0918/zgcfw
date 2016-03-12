$(function() {
    function a() {
        var a = navigator.userAgent.toLowerCase();
        "iphone os" == a.match(/iphone os/i) ? "safari" == a.match(/safari/i) && "crios" != a.match(/crios/i) && ($("#addDesktop").show(), $("#addDesktopClose").click(function() {
            $("#addDesktop").hide(),
                GM.utils.cookie("_ip_sf_close", "true", {
                    expires: 7
                })
        })) : $("#addDesktop").hide()
    }

    GM.vars.GA_TYPE = "home",
    ukey && $("#navBtn").trigger("click"),
    null === GM.utils.cookie("_ip_sf_close") && a();
    var b = $(window).width();
    $(".titles li").width(b - 16),
        $(window).resize(function() {
            b = $(window).width(),
                $(".titles li").width(b - 16)
        }),
        GM.init.swipeChangeFocus($("#focus li"), !0),
        GM.init.swipeChangeFocus($("#askBlock2 .titles-list ul"), !1, GM.utils.tabChange),
        GM.init.swipeChangeFocus($("#askBlock3 .titles-list ul"), !1, GM.utils.tabChange),
        GM.init.swipeChangeFocus($("#askBlock7 .titles-list ul"), !1, GM.utils.tabChange),
        GM.init.swipeChangeFocus($("#askBlock12 .titles-list ul"), !1, GM.utils.tabChange),
        GM.init.swipeChangeFocus($("#askBlock13 .titles-list ul"), !1, GM.utils.tabChange),
        GM.init.swipeChangeFocus($("#askBlock14 .titles-list ul"), !1, GM.utils.tabChange),
        GM.init.swipeChangeFocus($("#askBlock15 .titles-list ul"), !1, GM.utils.tabChange),
        GM.init.swipeChangeFocus($("#askBlock16 .titles-list ul"), !1, GM.utils.tabChange),
        GM.init.clickChangeTab($("#askBlock2 .tab li")),
        GM.init.clickChangeTab($("#askBlock3 .tab li")),
        GM.init.clickChangeTab($("#askBlock7 .tab li")),
        GM.init.clickChangeTab($("#askBlock12 .tab li")),
        GM.init.clickChangeTab($("#askBlock13 .tab li")),
        GM.init.clickChangeTab($("#askBlock14 .tab li")),
        GM.init.clickChangeTab($("#askBlock15 .tab li")),
        GM.init.clickChangeTab($("#askBlock16 .tab li")),
        GM.init.initSpecial()
});