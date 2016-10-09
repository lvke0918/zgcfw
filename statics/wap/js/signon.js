/**
 * My module:
 *  登录
 */
X.sub("init", function() {
    var h = $(window).height();
    $(".content").css({
        "min-height": (h - 100)
    });
    
    window.addEventListener('popstate', function(e){
        checkSession();
    }, false);

    //判断是否已登录

    function onGetSession(respText) {
        var resp = JSON.parse(respText);
        if (resp.id) {
            if (X.qs.ref) {
                window.location = decodeURIComponent(X.qs.ref);
            } else {
                window.location = '/m/my';
            }
        }
    }

    function checkSession() {
        if (X.cookie.get('xsid')) {
            X.get("/user/session?xsid=" + X.cookie.get('xsid'), onGetSession);
        }
    }
    checkSession();
    //登录

    function onError(error) {
        alert("Network:" + error);
    }

    var f = X('loginForm', true);
    var logBut = X('loginBtn', true);
    logBut.addEventListener("click", function(e) {
        e.preventDefault();
        loginFun();
    }, false);

    $("input").keyup(function(e) {
        if (e.keyCode == 13) {
            loginFun();
        }
    });

    function loginFun() {
        var cred = {};
        cred.username = f.username.value;
        cred.password = f.password.value;
        cred.onLoginResponse = onLoginResponse;
        logBut.innerHTML = '<img src="/css/default/images/loaderBgWhite.gif" />';
        X.pub('login', cred);
    }

    f.username.focus();

    function onLoginResponse(respText) {
        logBut.innerHTML = '登录';
        var resp = JSON.parse(respText);
        if (resp.code != '0') {
            var obj = {};
            obj.title = "Error";
            resp.msg = '用户名或密码错误';
            obj.msg = '<p>' + resp.msg + '</p>';
            obj.noCancel = true;
            X.pub('showDialog', obj);
            return;
        }
        
        var sid = X.cookie.get('xsid');
        X.cookie.add('xsid', sid, 360);
        
        checkSession();

        // if (X.qs.ref) {
        //     window.location = decodeURIComponent(X.qs.ref);
        // } else {
        //     window.location = '/m/my';
        // }
    }
});