/**
 * My module:
 *  注册会员
 */
X.sub("init", function() {
    /**
     * 参数
     */
    var sex = 0;
    var userUpdate = '/json/user/profile/upload';
    var userList = '/json/user/profile/lists';
    var userCheck = '/user';
    var userReg = '/user';
    var idService = '/userProfile/id';
    var submit = false;
    var rp = false;
    var ru = false;
    var psuc = false;
    var usuc = false;
    var loaded = 0;
    var isver = false;
    var isSend = true;
    var canver = false;
    var code = "";
    var t = 0;
    var MOBILE_REG = /^1[3|4|5|7|8][0-9]{9}$/;
    var EMAIL_REG = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

    /**
     * 手机号验证
     */
    $("#sendcode").click(function() {
        if (!isSend) {
            return;
        }
        code = "";
        for (var i = 0; i < 6; i++) {
            code += Math.floor(Math.random() * 10);
        }
        var aForm = X('itemForm');
        var phone = aForm.cell.value;
        if (phone.length !== 11) {
            error("请输入正确的手机号");
            return false;
        }
        if (!MOBILE_REG.test(phone)) {
            error("您的手机号填写不正确！");
            return false;
        } else {
            isSend = false;
            var req = {};
            $.ajax({
                type: "get",
                async: false,
                url: "api.php?op=sms",
                data:{ mobile: phone,random:Math.random()},
                async: false,
                dataType:"JSON",
                beforeSend: function(xhr){
                    xhr.setRequestHeader('X-AJAX', 'true');
                },
                //jsonpCallback: "jsonpCallback",
                success: function(json) {
                    if (json === 0) {
                        $("#testcode").css({
                            opacity: 1
                        });
                        $("#sendcode").css("background", "#999");
                        canver = true;
                        var c = 120;
                        t = setInterval(function() {
                            $("#sendcode").html(c + "秒");
                            --c;
                            if (c <= 0) {
                                isSend = true;
                                $("#sendcode").html("发送").css("background", "#06c3a6");
                                clearInterval(t);
                            }
                        }, 1000); //成功
                        return false;
                    } else {
                        isSend = true;
                        error('发送失败，请重试'); //失败
                    }
                },
                error: function() {
                    error('提交失败，请重试');
                }
            });
            //});
        }
    });


    //重置验证按钮

    function resetVer() {
        $(".cellbutton").show();
        $("#sendcode").html("发送").css("background", "#06c3a6");
        $("#testcode").css({
            opacity: 0.6
        });
        isver = false;
        isSend = true;
        canver = false;
        code = "";
        t = 0;
    }

    /**
     * 提交form
     */
    X('submitBtn').addEventListener("click", function(e) {
        e.preventDefault();
        X.pub("showLoading");


        if (submit) {
            return;
        }
        loaded = 0;
        submit = true;



        var aForm = X('itemForm');
        var item = {};
        item.phone = aForm.phone.value;
        item.email = aForm.email.value;
        item.password = aForm.password.value;
        item.password1 = aForm.password1.value;
        item.name = aForm.name.value;
        item.code = aForm.code.value;
        item.post = aForm.post.value;
        item.company = aForm.company.value;
        if (item.company.length < 2) {
            error("请正确输入您的公司名称");
            return false;
        }
        if (item.phone.length < 11) {
            error("请输入正确的手机号！");
            return false;
        }

        if (!MOBILE_REG.test(item.phone)) {
            error("请输入正确的手机号！");
            return false;
        }

        if (item.email.length < 3) {
            error("请输入邮箱！");
            return false;
        }

        if (!EMAIL_REG.test(item.email)) {
            error("请输入正确的邮箱！");
            return false;
        }

        if (item.password.length < 6) {
            error("请输入密码，6-16位！");
            return false;
        }

        if (item.password1.length < 6) {
            error("请输入确认密码，6-16位！");
            return false;
        }

        if (item.password1 !== item.password) {
            error("两次密码输入不相同，请重新输入！");
            return false;
        }
        if (item.name.length < 2) {
            error("请正确输入联系人姓名");
            return false;
        }
        if (item.post.length < 2) {
            error("请正确输入您的职务名称");
            return false;
        }

        checkProfile(item);

    }, false);

    function checkProfile(item) {
        X.get( '/index.php?m=member&c=index&a=public_checkname_ajax&clientid=username&username='+item.company, function(respText) {
            if (respText === '1') {
                rp = false;
            } else {
                rp = true;
                error("该公司已经注册，请重新输入公司名称");
                resetVer();
                return false;
            }
            checkCode(item);
        });
    }

    function checkCode(item) {
        X.get('/api.php?op=sms_idcheck&action=id_code&clientid=mobile_verify&mobile=' + item.phone+'&mobile_verify='+item.code, function(respText) {
            if (respText === '1') {
                ru = false;
            } else {
                error("该验证码已经失效，请重新获取验证码");
                resetVer();
                return false;
            }
            checkMail(item);
        })
    }

    function checkMail(item) {

        X.get('/index.php?m=member&c=index&a=public_checkemail_ajax&clientid=email&email=' + item.email, function(respText) {
            if (respText === '1') {
                ru = false;
            } else {
                error("该邮箱号已经注册，请重新输入邮箱");
                resetVer();
                return false;
            }
            onSubmit();
        });
    }

    function onSubmit() {
        if (ru && rp) {
            error("该手机号已经注册，请重新输入手机号");
            resetVer();
            return false;
        }
        var item = {};
        var aForm = X('itemForm');
        item.phone = aForm.phone.value;
        item.password = aForm.password.value;
        item.password1 = aForm.password1.value;
        item.email = aForm.email.value;
        item.company = aForm.company.value;
        item.code = aForm.code.value;
        item.name = aForm.name.value;
        item.post = aForm.post.value;
        item.status = '0';
        var reg = {};
        if (!ru) {
            $.ajax({
                type: "post",
                url: "/index.php?m=member&c=index&a=ajaxreg",
                data:{
                    username : item.company,
                    mobile : item.phone,
                    mobile_verify : item.code,
                    password : item.password,
                    password1 : item.password1,
                    email : item.email,
                    nickname : item.name,
                    position : item.post
                },
                beforeSend: function(xhr){
                    xhr.setRequestHeader('X-AJAX', 'true');
                },
                dataType: "json",
                success: function(data){
                    loaded=1;
                    onRegRequest(data)
                }
            });
         } else {
            usuc = true;
            checkSubmited();
        }

    }

    function onRegRequest(respText) {

        if (respText.errno === 0) {
            usuc = true;
        } else {
            usuc = false;
        }
        checkSubmited();
    }

    function checkSubmited() {
        loaded += 1;
        if (loaded === 2) {
            submit = false;
            if ( usuc) {
                X('itemForm').reset();
                var obj = {};
                obj.type = '1';
                obj.callback = function() {
                    document.location = "/index.php?&a=account";
                };
                obj.msg = '注册成功';
                X.pub('showDialog', obj);
            } else {
                error("提交错误，请重新提交");
            }
        }
    }

    function error(msg) {
        var obj = {};
        obj.title = "提示";
        obj.msg = '<p>' + msg + '</p>';
        obj.noCancel = true;
        obj.okText = "确定";
        X.pub('showDialog', obj);
        submit = false;
        X.pub("closeLoading");
    }

    function dialog(msg) {
        var obj = {};
        obj.type = "1";
        obj.disbg = true;
        obj.msg = '<p>' + msg + '</p>';
        X.pub('showDialog', obj);
        submit = false;
        X.pub("closeLoading");
    }

});