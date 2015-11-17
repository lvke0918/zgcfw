<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=7" />
<title><?php if(isset($SEO['title']) && !empty($SEO['title'])) { ?><?php echo $SEO['title'];?><?php } ?><?php echo $SEO['site_title'];?></title>
<meta name="keywords" content="<?php echo $SEO['keyword'];?>">
<meta name="description" content="<?php echo $SEO['description'];?>">
<link href="<?php echo CSS_PATH;?>common.css" rel="stylesheet" type="text/css" />
<link href="<?php echo CSS_PATH;?>container.css" type="text/css" rel="stylesheet">

<?php if($_GET['c']=='index'||$_GET['c']=='tag') { ?>
<link href="<?php echo CSS_PATH;?>category.css" type="text/css" rel="stylesheet">
<?php } else { ?>
<link href="<?php echo CSS_PATH;?>home.css" type="text/css" rel="stylesheet">
<?php } ?>
<script type="text/javascript" src="<?php echo JS_PATH;?>jquery.min.js"></script>
<script type="text/javascript" src="<?php echo JS_PATH;?>jquery.sgallery.js"></script>
<script type="text/javascript" src="<?php echo JS_PATH;?>search_common.js"></script>
<script type="text/javascript" src="<?php echo JS_PATH;?>jquery.KinSlideshow-1.1.js"></script>

<style type="text/css">
.code{ height:auto; padding:20px; border:1px solid #9EC9FE; background:#ECF3FD;}
.code pre{ font-family:"Courier New";font-size:14px;}
.info{ font-size:12px; color:#666666; font-family:Verdana; }
.info p{ margin:0; padding:0; line-height:22px; text-indent:40px;}
h2.title{ margin:0; padding:0; margin-top:50px; font-size:18px; font-family:"微软雅黑",Verdana;}
h3.title{ font-size:16px; font-family:"微软雅黑",Verdana;}
.importInfo{ font-family:Verdana; font-size:14px;}
</style>
</head>
<script language="JavaScript">
<!--

	$(function(){
		$('#username').focus();
	})


	
	function show_login(site) {
		if(site == 'sina') {
			art.dialog({lock:false,title:'用新浪账号登录',id:'protocoliframe', iframe:'index.php?m=member&c=index&a=public_sina_login',width:'500',height:'310',yesText:'关闭'}, function(){
			});
		} else if(site == 'snda') {
			art.dialog({lock:false,title:'用盛大连接登录',id:'protocoliframe', iframe:'index.php?m=member&c=index&a=public_snda_login',width:'500',height:'310',yesText:'关闭'}, function(){
			});
		} else if(site == 'qq') {
			art.dialog({lock:false,title:'用腾讯微博帐号登录',id:'protocoliframe', iframe:'index.php?m=member&c=index&a=public_qq_login',width:'500',height:'310',yesText:'关闭'}, function(){
			});
		}
	}
//-->
</script>

<?php
        $userid= param::get_cookie('_userid');

?>
<body class="yui-skin-sam">
<div class="" description="" id="layout"><div class="" description="" id="north"><div class=""><div class="" description="" id="header"><div class="top"><div class="block"><div class="block_body">
<a class="logo" href="<?php echo siteurl($siteid);?>"></a>

<div class="contact">
            <img width="80" height="80" src="/statics/images/qrcode_for_gh_b82ef7a479ca_258.jpg" style="float:left;margin-right:20px;">
            <ul style="float:left;">
              <li><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=2727932550&site=qq&menu=yes">
                   <img border="0" src="http://wpa.qq.com/pa?p=2:2727932550:41" alt="在线服务" title="在线服务">
                   </a></li>
<li><img src="/statics/images/icon/find_phone.png" style="height:20px;">：010-82626510 &nbsp;&nbsp; </li>
              <li><img src="/statics/images/icon/email.png" style="height:20px;">：<a href="mailto:zgcqyfw@126.com">zgcqyfw@126.com</a></li>
            </ul>
          </div>
     
</div></div></div><div class="menu"><div class="block"><div class="block_body">
<map>
    	<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=b43f1459ac702900c8d44c91a5e796dd&action=category&catid=0&num=25&siteid=%24siteid&order=listorder+ASC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'category')) {$data = $content_tag->category(array('catid'=>'0','siteid'=>$siteid,'order'=>'listorder ASC','limit'=>'25',));}?>
        	<ul >
			<li  <?php if(!$top_parentid ) { ?>  class="onClick"  <?php } ?> id="main_menu_1"><a href="<?php echo siteurl($siteid);?>">首页</a></li>
			<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
			<li <?php if($top_parentid == $r[catid]) { ?>  class="onClick"  <?php } ?>><a href="<?php echo $r['url'];?>"><?php echo $r['catname'];?></a></li>
			<?php $n++;}unset($n); ?>
            </ul>
        <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
		<?php echo runhook('glogal_menu')?>
        </map>
           
<div class="clear"></div>
</div>
</div>
</div>
<div class="banner1"></div>

<div class="xlet">
</div>
<div class="xlet">
<div class="block"><div class="block_body">
</div>
</div>
</div>
<div class="" description="" id="search">
<div class="searchBlock">
<div class="xpe_ui" id="xpe_">
<form id="sform2" name="sform2"   action="<?php echo APP_PATH;?>index.php" method="get" target="_blank"  >
 <input  name="q" id="q"  onblur='if(this.value==""){this.value="请输入关键字"}' onfocus="if(this.value=='请输入关键字')this.value=''" value="请输入关键字"  class="input" type="text"> 
<input value="" name="queryTemplate" type="hidden">
<input type="hidden" name="m" value="search"/>
				<input type="hidden" name="c" value="index"/>
				<input type="hidden" name="a" value="init"/>
				<input type="hidden" name="typeid" value="<?php echo $typeid;?>" id="typeid"/>
				<input type="hidden" name="siteid" value="<?php echo $siteid;?>" id="siteid"/>
<input class="searchBtn" value="搜索" type="submit">
</form>
</div>
<div style="display:none" id="xpe_ui"></div>
</div>
<div class="loginText"><div class="xpe_ui" id="xpe_">
<div class="login">


<form method="post" action="index.php?m=member&c=index&a=login" id="myform" name="myform">
    <?php if($userid ) { ?>

    <span>你好：<a href="index.php?m=member&c=index" class="register"><?php echo param::get_cookie('_username')?></a>|<a href="index.php?m=member&c=index&a=logout" class="forgetPas">注销</a></span>

    <?php } else { ?>

            用户名：<input  id="username" name="username" class="username" type="text">
            密码：<input type="password" id="password" name="password" class="password">
			<input class="loginBtn" value="登陆" name="dosubmit" id="dosubmit" type="submit"><span><a href="index.php?m=member&c=index&a=register&siteid=1" class="register">注册</a>|<a href="index.php?m=member&c=index&a=public_forget_password&siteid=1" class="forgetPas">忘记密码</a></span>
			</form>
    <?php } ?>
			<form id="login" method="POST" action="/xpe/secu/login">
                              <input value="/xpe/portal/2da378f0-138b-1000-8387-49737a611cd0" name="onSuccess" type="hidden">
                              <input name="username" value="" type="hidden">

                <input name="password" value="" type="hidden">
                      </form>

</div>
<div class="clear"></div>
<div class="blank"></div>
<div style="visibility: hidden;" id="simpleDialog_d38902072e22_c" class="yui-panel-container yui-dialog yui-overlay-hidden yui-simple-dialog"><div class="yui-module yui-overlay yui-panel" id="simpleDialog_d38902072e22" style="display: none; visibility: inherit;"><div class="hd" id="hd_simpleDialog_d38902072e22">提示</div><div class="bd" id="bd_simpleDialog_d38902072e22"></div></div></div></div>
<div style="display:none" id="xpe_ui"></div>
</div>
<div class="clear" description="" id="clear02"></div>
<script type="text/javascript">
$(function(){
	$("#KinSlideshow").KinSlideshow();
     
})
</script>

</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>