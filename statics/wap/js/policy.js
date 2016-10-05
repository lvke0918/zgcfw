/**
 * My module:
 *  政策解读
 */
X.sub("init", function() {
    var msgs = {};

    msgs.noItem = "没有任何内容";

    // service URLs
    var itemLists = "/json/policys";
    var limit = 10;
    var start = 1;
    var total = 0;
    var totalPages = 0;
    var currentPage = 1;
    var loaded = false;
    var canload = true;
    var qt = '';
    var isUp = 0;
    //检查是否登录
    var user = {};


    function loadContent() {
        $("#list").html("<div class='loading'></div>");
        //初始化
        start = 1;
        total = 0;
        totalPages = 0;
        currentPage = 1;
        loaded = false;
        $.get( '/index.php?m=wap&c=index&a=jsonlists&json=true&typeid=3&page='+start + qt, onGetContent);
       // $.get(itemLists + '?sortby=id&reverse=true&status=1&start=' + start + '&limit=' + limit + qt, onGetContent);
    }
    
    loadContent();

    X.sub('userLoaded', function(evt, respText) {
        user = respText;
        X.pub('closeLoading');
    });
    //X.pub('checkSession');

    function onGetContent(respText) {
        var resp = JSON.parse(respText);
      //  var resp = respText;
        resp.meta = resp.meta || {
            total: "0",
            size: "0"
        };
        if (resp.meta && resp.meta.size === '0') {
            loaded = true;
        }
        if (resp.meta && resp.meta.total === '0') {
            $("#list").html('<div class="noItem">' + msgs.noItem + '</div>');
        } else {
            var size = parseInt(resp.meta.size);
            var res = "";
            for (var i = 0; i < size; ++i) {
                var item = resp.data[i];
                item.category = item.category || {
                    "title": ""
                };
                item.category = item.category || {};
                res += '<li class="c' + (item.category.num || 1) + '">';
                res += '<a href="' + item.url + '">';
                res += '<div class="caption">' + item.category.title + '</div>';
                res += '<div class="title">';
                res += '<p>' + item.title + '</p>';
                res += '<p>' + moment(Number(item.created)).format("YYYY年MM月DD日") + '</p>';
                res += '</div>';
                res += '</a>';
                res += '</li>';
            }
            if (resp.meta.start === '1') {
                $("#list").html(res);
            } else {
                $("#list").append(res);
            }
            //$("#uList").html(res);
        }
        canload = true;
        $(".loading").addClass("hide");
        $(".list-loading").addClass("hide");

        total = parseInt(resp.meta.total);
        currentPage = Math.floor(start / limit) + 1;
        //start = (currentPage * limit) + 1;
        start = (parseInt(resp.meta.start) + 1);


        /**
         * 滚动到底部时动态加载
         */
        $(window).unbind('scroll').bind('scroll', function() {
            var viewH = $(window).height(), //可见高度
                contentH = $(document).height(), //内容高度
                scrollTop = $(document).scrollTop(); //滚动高度

            if (contentH - viewH - scrollTop <= 0) { //到达底部50px时,加载新内容
                //if (scrollTop / (contentH - viewH) >= 0.95) { //到达底部100px时,加载新内容
                if (!loaded && canload && start !== 1) {
                    $(".list-loading").removeClass("hide");
                    canload = false;
                    $.get( '/index.php?m=wap&c=index&a=jsonlists&json=true&typeid=3&page='+start + qt, onGetContent);
                  //  $.get(itemLists + '?sortby=id&reverse=true&status=1&start=' + start + '&limit=' + limit + qt, onGetContent);
                }
            }
        });
    }
});