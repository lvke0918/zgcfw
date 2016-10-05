/**
 * My module:
 *  最新政策详情
 */
X.sub("init", function() {
    //检查是否登录
    var user = {};
    X.sub('userLoaded', function(evt, respText) {
        user = respText;
        X.pub('closeLoading');
    });
    //X.pub('checkSession');
});