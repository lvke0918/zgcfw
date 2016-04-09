////政策研究
//$(".item").click(function(){
//     var i=$(this).index();
//
//	 $(this).addClass('on').siblings().removeClass('on');
//	 for(var j =0; j<5; j++){
//		$(".item:eq("+j+") .icon").html('<img src="images/ny_ic_' + (j+1) + '.png">');
//	 }
//	 $(this).children('.icon').html('<img src="images/ny_ic_' + (i+1) + '_on.png">');
//		$(".part").hide();
//		$(".part").eq(i).show();
//
//
//});


////知识库
//$(".item01").click(function(){
//     var a=$(this).index();
//
//	 $(this).addClass('on').siblings().removeClass('on');
//	 for(var b =0; b<5; b++){
//		$(".item01:eq("+b+") .icon").html('<img src="images/ny_ic_' + (b+3) + '.png">');
//	 }
//	 $(this).children('.icon').html('<img src="images/ny_ic_' + (a+3) + '_on.png">');
//		$(".part").hide();
//		$(".part").eq(a).show();
//
//
//});
//



//登陆
$(".login_button").click(function(){
	$(".alertDiv").show();	
	});
$(".cancel").click(function(){
	$(".alertDiv").hide();
	
	});
	

//切换注册
$(".alertDiv .p3").click(function(){
	$(".alertDiv").hide();	
	$(".alertDiv_2").show();
	
	});
	

//注册
$(".register_button").click(function(){
	$(".alertDiv_2").show();	
	});
$(".cancel").click(function(){
	$(".alertDiv_2").hide();
	
	});
	
//切换登陆
$(".alertDiv_2 .p3").click(function(){
	$(".alertDiv_2").hide();	
	$(".alertDiv").show();
	
	});

	
//微信二维码
 c=true;	
$(".wechat_all").click(function(){
	if(c){
	  $(".wechat_ic").show();	
	  c=false;
	  return;
	} 
	else{
	  $(".wechat_ic").hide();	
	  c=true;
	  return;	
	 }
});
$(function() {
    $("#btn_login").click(function () {
        var username   =$('#username').val();
        var password =$('#password').val();

        $.ajax({
            type: "post",
            url: "/index.php?m=member&c=index&a=ajaxlogin",
            data:{
                username : username,
                password : password
            },
            async: false,
            dataType:"JSON",
            beforeSend: function(xhr){
                xhr.setRequestHeader('X-AJAX', 'true');
            },
            success: function(data){
                if(data.errno==1){
                    $('#errMsg').html(data.msg);
                    setTimeout(function(){$('#errMsg').html('')}, 2000);

                }else{
                    $('.alertDiv').hide();
                    $('#loginDiv').html(' <div class="log_off"><p>你好：'+data.data.name+'</p> |  <a href="index.php?m=member&c=index&a=logout" >注销</a></div>')
                }
            }
        });
    });

    $("#btn_reg").click(function () {
        var nickname =$('#nickname').val();
        var username   =$('#name').val();
        var mobile   =$('#mobile').val();
        var mobile_verify   =$('#mobile_verify').val();
        var password =$('#pwd').val();
        var password1 =$('#pwd1').val();
        var email =$('#email').val();
        var position =$('#position').val();
        var f=true;

        $.ajaxSettings.async = false;
        $.get('/index.php?m=member&c=index&a=public_checkname_ajax', {
            clientid   : 'username',
            username: username
        }, function(data) {
            if( data == "1" ) {
                f=true
            } else {
                alert('用户名称已经注册')
                f=false;
            }
        });

        if(!f){
            return false;
        }
        $.get('/index.php?m=member&c=index&a=public_checknickname_ajax', {
            clientid : 'nickname',
            nickname: nickname
        }, function(data) {
            if( data == "1" ) {
                f=true
            }else {
                alert('企业名称已经注册')
                f=false;
            }
        });



        if(!f){
            return false;
        }

        $.get('/index.php?m=member&c=index&a=public_checkemail_ajax', {
            clientid : 'email',
            email: email
        }, function(data) {
            if( data == "1" ) {
                f=true;
            }else {
                alert('邮箱输入错误或已经注册')
                f=false;
            }
        });


        if(!f){
            return false;
        }

        $.get('/api.php?op=sms_idcheck&action=id_code', {
            clientid : 'mobile_verify',
            mobile : mobile,
            mobile_verify: mobile_verify,
            jscheck:1
        }, function(data) {
            if( data == "1" ) {
                f=true
            }else {
                alert('验证码错误')
                f=false;
            }
        });


        if(!f){
            return false;
        }

        if(password==''&&password!=password1){
            alert('密码输入不一致')
            return false;
        }


        $.ajax({
            type: "post",
            url: "/index.php?m=member&c=index&a=ajaxreg",
            data:{
                username : username,
                mobile : mobile,
                mobile_verify : mobile_verify,
                password : password,
                password1 : password1,
                email : email,
                nickname : nickname,
                position : position
            },
            beforeSend: function(xhr){
                xhr.setRequestHeader('X-AJAX', 'true');
            },
            dataType: "json",
            success: function(data){

                if(data.errno==1){
                    $('#errMsgReg').html(data.msg);
                    setTimeout(function(){$('#errMsgReg').html('')}, 2000);
                }else{
                    $('.alertDiv_2').hide();
                    $('#loginDiv').html(' <div class="log_off"><p>你好：'+data.data.name+'</p> |  <a href="index.php?m=member&c=index&a=logout" >注销</a></div>')
                }
            }
        });

        $.ajaxSettings.async = true;
    });


    $('#getCode').on('click', function(){

        var mobile = $("#mobile").val(),
            me = $(this),
            timeLeft = 60;
        var telReg = !!mobile.match(/^(0|86|17951)?(13[0-9]|15[012356789]|17[0678]|18[0-9]|14[57])[0-9]{8}$/);

        if(telReg == false){
            alert('手机号不正确');
            return false;
        }
        $.ajax({
            cache: true,
            type: "GET",
            url:'api.php?op=sms',
            data:{ mobile: mobile,random:Math.random()},
            async: false,
            dataType:"JSON",
            beforeSend: function(xhr){
                xhr.setRequestHeader('X-AJAX', 'true');
            },
            success:function(data){
                if(data == 0){
                    me.attr('disabled', 'disabled');
                    var sh = setInterval(function(){
                        me.html(timeLeft+' 秒');
                        if(timeLeft ==0){
                            clearInterval(sh);
                            me.html('获取验证码').removeAttr('disabled');
                        }else{
                            timeLeft--;
                        }
                    }, 1000);
                }else{
                    alert(data.msg);
                }
            }
        });
        return false;
    });

})








