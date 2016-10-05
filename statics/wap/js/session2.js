// The signon app determines the current status of the user, if the user already
// logs in, a welcome message is displayed
X.sub("init", function() {
    var profile = {};

    function onGetSession(respText) {
        var resp = JSON.parse(respText);
        if (!resp.profile) {
            return;
        }
        X.get('/json/user/profile?username=' + resp.username, function(respText) {
            var u = JSON.parse(respText);
            profile = u || {};
            profile.uid = resp.id;
            X.pub('userLoaded', profile);
            $("#layout").css('visibility', "visible");
        });
    }

    function checkSession() {
        if (X.cookie.get('xsid')) {
            X.get("/user/session?xsid=" + X.cookie.get('xsid'), onGetSession);
        }
    }
    checkSession();
});

var _hmt = _hmt || [];
(function() {
    var hm = document.createElement("script");
    hm.src = "//hm.baidu.com/hm.js?af85468cb95ac65cb89d69e63589680d";
    var s = document.getElementsByTagName("script")[0];
    s.parentNode.insertBefore(hm, s);
})();