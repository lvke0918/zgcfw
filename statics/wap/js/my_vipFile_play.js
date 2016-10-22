/**
 * My module:
 *  description about what it does
 */
X.sub("init", function() {
    /* 
     ** 页面切换的效果控制 
     */
    var initP = null, //初值控制值
        moveP = null, //每次获取到的值
        firstP = null, //第一次获取的值
        moveY = null,
        startY = null,
        position = null, //方向值
        time = 4000, //切换时间
        t = 0,
        n = 0,
        count = 0,
        mousedown = null; //PC鼠标控制鼠标按下获取值
    /*
     **模版切换页面的效果
     */
    //绑定事件
    function changeOpen(e) {
        $(".center_box").on('mousedown touchstart', page_touchstart);
        $(".center_box").on('mousemove touchmove', page_touchmove);
        $(".center_box").on('mouseup touchend mouseout', page_touchend);
    }
    //取消绑定事件

    function changeClose(e) {
        $(".center_box").off('mousedown touchstart');
        $(".center_box").off('mousemove touchmove');
        $(".center_box").off('mouseup touchend mouseout');
    }

    //开启事件绑定滑动
    changeOpen();
    onGetContent();

    //触摸（鼠标按下）开始函数

    function page_touchstart(e) {
        if (e.type == "touchstart") {
            initP = window.event.touches[0].pageX;
            startY = window.event.touches[0].pageY;
        } else {
            initP = e.x || e.pageX;
            startY = e.y || e.pageY;
            mousedown = true;
        }
        firstP = initP;
    }
    //插件获取触摸的值

    function V_start(val) {
        initP = val;
        mousedown = true;
        firstP = initP;
    }
    //触摸移动（鼠标移动）开始函数

    function page_touchmove(e) {
        // e.preventDefault();
        // e.stopPropagation();

        //判断是否开始或者在移动中获取值
        if (e.type == "touchmove") {
            moveP = window.event.touches[0].pageX;
            moveY = window.event.touches[0].pageY;
        } else {
            if (mousedown) moveP = e.x || e.pageX;
            if (mousedown) moveY = e.y || e.pageY;
        }
        var isMoveX = false;
        Math.abs(moveP - initP) - Math.abs(moveY - startY) >= 2 ? isMoveX = true : isMoveX = false;

        if (isMoveX) {
            e.preventDefault();
            e.stopPropagation();
        } else {
            return;
        }
        position = moveP - initP > 0 ? true : false; //true 为向左滑动 false 为向右滑动
    }

    //触摸结束（鼠标起来或者离开元素）开始函数

    function page_touchend(e) {

        //判断移动的方向
        var move_p;
        position ? move_p = moveP - firstP > 100 : move_p = firstP - moveP > 100;

        //切画页面(移动成功)
        if (move_p && Math.abs(moveP) > 5) {
            /*
             ** 切换成功回调的函数
             */
            success();
            //返回页面(移动失败)
        } else if (Math.abs(moveP) >= 5) { //页面退回去

        }
        /* 初始化值 */
        initP = null, //初值控制值
        moveP = null, //每次获取到的值
        firstP = null, //第一次获取的值
        mousedown = null; //取消鼠标按下的控制值
    }

    /*
     ** 切换成功的函数
     */
    function success() {
        /*
         ** 切换成功回调的函数
         */
        if (count < 2) {
            return;
        }
        if (position) {
            n = n <= 0 ? (count - 1) : --n;
            showAuto();
        } else {
            n = n >= (count - 1) ? 0 : ++n;
            showAuto();
        }
    }


    onGetContent()

    function onGetContent() {
        //轮播
        $(".banner_list:first-child").show();
        count = $(".banner_list").length;
        $(".banner_list:first-child").show();
        $(".banner_list:not(:first-child)").hide();
        $(".percent").html((n + 1) + "<s>/<s>" + count);

        initPage();
    }

    function sortBySort(obj1, obj2) {
        if (obj1.num > obj2.num) {
            return 1;
        } else if (obj1.num == obj2.num) {
            return 0;
        } else {
            return -1;
        }
    }

    function showAuto() {
        n = n - 1;
        n = n >= (count - 1) ? 0 : ++n;
        //$(".banner_list").filter(":visible").fadeOut(500).parent().children().eq(n).fadeIn(1000);
        var mg = "-100%";
        var smg = "100%";
        if (position) {
            mg = "100%";
            smg = "-100%";
        }

        $(".banner_list").filter(":visible").animate({
            "left": mg
        }, function() {
            $(this).css({
                "left": 0
            }).hide();
        }).parent().children().eq(n).css({
            "left": smg
        }).show().animate({
            "left": '0'
        }, function() {
            //$(this).hide();
        });
        $(".percent").html((n + 1) + "<s>/<s>" + count);
    }

    /*
     ** 页面加载初始化
     */
    function initPage() {
        //PC端图片点击不产生拖拽
        $(document.body).find("img").on("mousedown", function(e) {
            e.preventDefault();
        });

        var w = $(document).width() || window.innerWidth;
        if (w <= 320) {
            w = 320;
        }
        if (w >= 640) {
            w = 640;
        }
        var cw = $('.center_box');
        $('.center_box img').height(w * 720 / 960);
        cw.height(w * 720 / 960);

        //高度
        var h = $(document).height() || window.innerHeight;
        if ((w * 720 / 960) < h) {
            cw.css({
                "marginTop": (h - w * 720 / 960 - 100) / 2
            });
        }
    }

    $(window).resize(function() {
        initPage();
    });
});