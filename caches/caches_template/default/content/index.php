<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template("content","header"); ?>
<div class="" description="" id="layout">

<div class="" description="" id="middle">
<div class="" description="" id="left">
<div class="picShow">

<div id="banner">	

<div id="KinSlideshow" style="visibility:hidden;border:solid 1px #848484; ">
    <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=d481e01acce7c38918bb2e85374441a7&action=position&posid=1&order=listorder+DESC&thumb=1&num=8\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'1','order'=>'listorder DESC','thumb'=>'1','limit'=>'8',));}?>
    <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
    <a href="<?php echo $r['url'];?>" target="_blank"><img src="<?php echo $r['thumb'];?>" alt="<?php echo $r['title'];?>" width="250" height="190" /></a>
    <?php $n++;}unset($n); ?>
    <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
</div>
     
</div>
</div>

<div class="leftMenu01">
<h1><span class="left_more"><a href="<?php echo $CATEGORYS['12']['url'];?>" title="<?php echo $CATEGORYS['12']['catname'];?>">更多</a></span><?php echo $CATEGORYS['12']['catname'];?></h1>
                <ul>
               <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=ef11c06c871a87075ed6a594359f929c&action=position&posid=10&catid=12&order=id+DESC&num=6\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'10','catid'=>'12','order'=>'id DESC','limit'=>'6',));}?>
               <?php $n=1; if(is_array($data)) foreach($data AS $n => $r) { ?>
               <li><a href="<?php echo $r['url'];?>" title="<?php echo $r['title'];?>"><span style="font-weight:bold">&nbsp;·&nbsp;</span><?php echo str_cut($r[title],56,'...');?></a></li>
               <?php $n++;}unset($n); ?>
               <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
                </ul>
</div>

<div class="leftMenu02">
<h1><span class="left_more"><a href="<?php echo $CATEGORYS['13']['url'];?>" title="<?php echo $CATEGORYS['13']['catname'];?>">更多</a></span><?php echo $CATEGORYS['13']['catname'];?></h1>
                <ul>
               <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=752d9d3f4d21e21e756f84338409acc9&action=position&posid=10&catid=13&order=id+DESC&num=6\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'10','catid'=>'13','order'=>'id DESC','limit'=>'6',));}?>
               <?php $n=1; if(is_array($data)) foreach($data AS $n => $r) { ?>
               <li><a href="<?php echo $r['url'];?>" title="<?php echo $r['title'];?>"><span style="font-weight:bold">&nbsp;·&nbsp;</span><?php echo str_cut($r[title],55,'...');?></a></li>
               <?php $n++;}unset($n); ?>
               <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
                </ul>
</div>

<div class="leftMenu03">
<h1><span class="left_more"><a href="<?php echo $CATEGORYS['14']['url'];?>" title="<?php echo $CATEGORYS['14']['catname'];?>">更多</a></span><?php echo $CATEGORYS['14']['catname'];?></h1>
                <ul>
                 
               <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=6c188e0b917d3685bd65c4e1e7092ff4&action=position&posid=10&catid=14&order=listorder++DESC&num=6\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'10','catid'=>'14','order'=>'listorder  DESC','limit'=>'6',));}?>

               <?php $n=1; if(is_array($data)) foreach($data AS $n => $r) { ?>
               <li><a href="<?php echo $r['url'];?>" title="<?php echo $r['title'];?>"><span style="font-weight:bold">&nbsp;·&nbsp;</span><?php echo str_cut($r[title],55,'...');?></a></li>
               <?php $n++;}unset($n); ?>
               <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
                </ul>
</div>
</div>
<div class="" description="" id="right"><div class="" description="" id="right_top"><div class="hot">
<h1><span class="more"><a href="<?php echo $CATEGORYS['6']['url'];?>">更多</a></span><?php echo $CATEGORYS['6']['catname'];?> <span class="title">HOT</span></h1>
                    <ul>

     
               <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=ccf2c2bb2efbc5ef7a6de05b3a19fff7&action=position&posid=10&catid=6&order=id+DESC&num=12\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'10','catid'=>'6','order'=>'id DESC','limit'=>'12',));}?>
               <?php $n=1; if(is_array($data)) foreach($data AS $n => $r) { ?>

<li><span class="updateTime"><?php echo date('Y-m-d',$r[inputtime]);?></span><a href="<?php echo $r['url'];?>" title="<?php echo $r['title'];?> "><span style="font-weight:bold">&nbsp;·&nbsp;</span><?php echo str_cut($r[title],75,'...');?>
                  </a> </li>

               <?php $n++;}unset($n); ?>
               <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
    
                    </ul>
</div><div class="softRegister">
<h1><span class="more"><a href="<?php echo $CATEGORYS['44']['url'];?>">更多</a></span><?php echo $CATEGORYS['44']['catname'];?><span class="title"> SERVICE</span></h1>
                    <ul>

 <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=b767ff2850a4359a555388c683f13589&action=position&posid=10&catid=44&order=listorder++DESC&num=12\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'10','catid'=>'44','order'=>'listorder  DESC','limit'=>'12',));}?>
               <?php $n=1; if(is_array($data)) foreach($data AS $n => $r) { ?>
<li><a href="<?php echo $r['url'];?>" title="<?php echo $r['title'];?>"><span style="font-weight:bold">&nbsp;·&nbsp;</span><?php echo str_cut($r[title],65,'...');?>
                  </a></li>
               <?php $n++;}unset($n); ?>
               <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>

           
                    </ul>
</div><div class="clear" description="" id="clear03"></div></div><div class="center" description="" id="center"><div class="">


<div class="info">
<span class="fuwu_title"><?php echo $CATEGORYS['9']['catname'];?></span>
<span class="infoTitle">资讯：</span>
<span class="fuwu_more"><a href="<?php echo $CATEGORYS['9']['url'];?>">更多</a></span>
<div class="Marquee" id="Marquee">

    <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=2e3bec5eab254972ef7678fb28fb15b9&action=position&posid=9&order=id&num=10&cache=3600\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$tag_cache_name = md5(implode('&',array('posid'=>'9','order'=>'id',)).'2e3bec5eab254972ef7678fb28fb15b9');if(!$data = tpl_cache($tag_cache_name,3600)){$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'9','order'=>'id','limit'=>'10',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>	
                 <?php $n=1; if(is_array($data)) foreach($data AS $k => $v) { ?>
                          <p style="height:24px;">
                         <a href="<?php echo $v['url'];?>" title="<?php echo $v['title'];?> "><?php echo $v['title'];?> </a>
                           </p>
          
                      <?php $n++;}unset($n); ?>
         
     <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>

</div>
</div>

</div><div class=""><div class="block"><div class="block_body"><script type="text/javascript">function up(x){
var Mar = document.getElementById(x); 
var child_div=Mar.getElementsByTagName("p") ;
var picH = 24;
var scrollstep=3; 
var scrolltime=20;
var stoptime=3000;
var tmpH = 0; 
Mar.innerHTML += Mar.innerHTML; 
function start(){ 
if(tmpH < picH){ 
tmpH += scrollstep; 
if(tmpH > picH )tmpH = picH ; 
Mar.scrollTop = tmpH; 
setTimeout(start,scrolltime); 
}else{ 
tmpH = 0; 
Mar.appendChild(child_div[0]); 
Mar.scrollTop = 0; 
setTimeout(start,stoptime); 
} 
} 
setTimeout(start,stoptime); 
}
up("Marquee")</script></div></div></div>

<div class="infoCon" description="" id="infoCon"><div class="">
                
                <div class="leftInfo">
                <ul>

                   <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=ed8984d16cefae03a30f235b44e2d327&action=position&posid=10&catid=21&order=id+DESC&num=10&i=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'10','catid'=>'21','order'=>'id DESC','i'=>'1','limit'=>'10',));}?>
                   <?php $n=1; if(is_array($data)) foreach($data AS $n => $r) { ?>
                  <li><a href="<?php echo $r['url'];?>" title="<?php echo $r['title'];?>"><span style="font-weight:bold">&nbsp;·&nbsp;</span><?php echo str_cut($r[title],80,'...');?></a></li>
                  <?php $n++;}unset($n); ?>
                    <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
               </ul>
                 </div>
               </div>
              <div class="">
                <div class="rightInfo">
                <ul> 
               <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=a5e071340f4a058b59795c9431d139c0&action=position&posid=10&catid=22&order=id+DESC&num=10&i=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'10','catid'=>'22','order'=>'id DESC','i'=>'1','limit'=>'10',));}?>
               <?php $n=1; if(is_array($data)) foreach($data AS $n => $r) { ?>
               <li><a href="<?php echo $r['url'];?>" title="<?php echo $r['title'];?>"><span style="font-weight:bold">&nbsp;·&nbsp;</span><?php echo str_cut($r[title],80,'...');?></a></li>
               <?php $n++;}unset($n); ?>
               <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
         
                </ul>
                </div>
                <div class="clear"></div>

</div></div></div>
<div class="" description="" id="right_bottom">
<div class="rightBot01">

<h1><span class="center_more"><a href="<?php echo $CATEGORYS['10']['url'];?>">更多</a></span><?php echo $CATEGORYS['10']['catname'];?></h1>
                    <ul>
                        <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=b7f53d5a1ce3f7513e8097767285ec13&action=position&posid=10&catid=10&order=id+DESC&num=5\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'10','catid'=>'10','order'=>'id DESC','limit'=>'5',));}?>
                        <?php $n=1; if(is_array($data)) foreach($data AS $n => $r) { ?>
                        <li><a href="<?php echo $r['url'];?>" title="<?php echo $r['title'];?>"><span style="font-weight:bold">&nbsp;·&nbsp;</span><?php echo str_cut($r[title],80,'...');?></a></li>
                        <?php $n++;}unset($n); ?>
                        <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
                    </ul>
</div>
<div class="rightBot02">
<h1><span class="center_more"><a href="<?php echo $CATEGORYS['120']['url'];?>">更多</a></span><?php echo $CATEGORYS['120']['catname'];?></h1>
                    <ul>
                      <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=355ddcfa85b060b58f8fd2a4cc8ada58&action=position&posid=10&catid=120&order=id+DESC&num=5\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'10','catid'=>'120','order'=>'id DESC','limit'=>'5',));}?>
                        <?php $n=1; if(is_array($data)) foreach($data AS $n => $r) { ?>
                        <li><a href="<?php echo $r['url'];?>" title="<?php echo $r['title'];?>"><span style="font-weight:bold">&nbsp;·&nbsp;</span><?php echo str_cut($r[title],80,'...');?></a></li>
                        <?php $n++;}unset($n); ?>
                        <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
                    </ul>
</div>

<div class="clear" description="" id="clear04"></div></div></div><div class="clear" description="" id="clear02"></div></div><div class="" description="" id="south">
<script language="JavaScript" type="text/JavaScript">
        <!--
        function ok(select){//友情链接代码开始
            if(select.options[select.selectedIndex].value!='$') {
                window.open(select.options[select.selectedIndex].value,'_blank');
            }
        }//友情链接结束
        //-->
</script>
<div class="friendLink">
<h1>相关链接</h1>
 <ul>
            <li style="white-space:nowrap;"><select name="choose" id="choose" onchange="ok(this)">
                <option value="" selected="selected">国家部委</option>
                <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"link\" data=\"op=link&tag_md5=d1d6b1f3b8da2e1948de35a82665d78d&action=type_list&siteid=1&typeid=55&order=listorder+DESC&num=40\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$link_tag = pc_base::load_app_class("link_tag", "link");if (method_exists($link_tag, 'type_list')) {$data = $link_tag->type_list(array('siteid'=>'1','typeid'=>'55','order'=>'listorder DESC','limit'=>'40',));}?>
                <?php $n=1; if(is_array($data)) foreach($data AS $n => $r) { ?>
                <option value="<?php echo $r['url'];?>"><?php echo $r['name'];?></option>
                <?php $n++;}unset($n); ?>
                <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
            </select>
            </li>
            <li style="white-space:nowrap;"><select name="choose" id="choose" onchange="ok(this)">
                <option value="" selected="selected">地方委办局</option>
                <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"link\" data=\"op=link&tag_md5=13b298ee3eabca14059c75186aee3749&action=type_list&siteid=1&typeid=56&order=listorder+DESC&num=40\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$link_tag = pc_base::load_app_class("link_tag", "link");if (method_exists($link_tag, 'type_list')) {$data = $link_tag->type_list(array('siteid'=>'1','typeid'=>'56','order'=>'listorder DESC','limit'=>'40',));}?>
                <?php $n=1; if(is_array($data)) foreach($data AS $n => $r) { ?>
                <option value="<?php echo $r['url'];?>"><?php echo $r['name'];?></option>
                <?php $n++;}unset($n); ?>
                <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
            </select>
            </li>
            <li style="white-space:nowrap;"><select name="choose" id="choose" onchange="ok(this)">
                <option value="" selected="selected">国内高新园区</option>
                <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"link\" data=\"op=link&tag_md5=9c11c806b17bf67cf270cbaa3e95ebdc&action=type_list&siteid=1&typeid=54&order=listorder+DESC&num=40\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$link_tag = pc_base::load_app_class("link_tag", "link");if (method_exists($link_tag, 'type_list')) {$data = $link_tag->type_list(array('siteid'=>'1','typeid'=>'54','order'=>'listorder DESC','limit'=>'40',));}?>
                <?php $n=1; if(is_array($data)) foreach($data AS $n => $r) { ?>
                <option value="<?php echo $r['url'];?>"><?php echo $r['name'];?></option>
                <?php $n++;}unset($n); ?>
                <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
            </select>
            </li>
            <li style="white-space:nowrap;"><select name="choose" id="choose"onchange="ok(this)">
                <option value="" selected="selected">项目申报</option>
                <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"link\" data=\"op=link&tag_md5=2b667b8d1447211ff6fe36a7795b8aea&action=type_list&siteid=1&typeid=58&order=listorder+DESC&num=40\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$link_tag = pc_base::load_app_class("link_tag", "link");if (method_exists($link_tag, 'type_list')) {$data = $link_tag->type_list(array('siteid'=>'1','typeid'=>'58','order'=>'listorder DESC','limit'=>'40',));}?>
                <?php $n=1; if(is_array($data)) foreach($data AS $n => $r) { ?>
                <option value="<?php echo $r['url'];?>"><?php echo $r['name'];?></option>
                <?php $n++;}unset($n); ?>
                <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
            </select>
            </li>
            <li style="white-space:nowrap;"><select name="choose" id="choose"onchange="ok(this)">
                <option value="" selected="selected">友情链接</option>
                <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"link\" data=\"op=link&tag_md5=ebea89e1f2f23e9279793c857f93d66f&action=type_list&siteid=1&typeid=57&order=listorder+DESC&num=40\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$link_tag = pc_base::load_app_class("link_tag", "link");if (method_exists($link_tag, 'type_list')) {$data = $link_tag->type_list(array('siteid'=>'1','typeid'=>'57','order'=>'listorder DESC','limit'=>'40',));}?>
                <?php $n=1; if(is_array($data)) foreach($data AS $n => $r) { ?>
                <option value="<?php echo $r['url'];?>"><?php echo $r['name'];?></option>
                <?php $n++;}unset($n); ?>
                <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
            </select>
            </li>
            <div class="clear"></div>
        </ul>
</div>

<script type="text/javascript"> 
$(function(){
	new slide("#main-slide","cur",310,260,1);//焦点图
	new SwapTab(".SwapTab","span",".tab-content","ul","fb");//排行TAB
})
</script>
<?php include template("content","footer"); ?>