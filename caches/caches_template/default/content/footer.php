<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><div class="copyright"><div class="block"><div class="block_body">
<p>2011-2015&copy;版权所有  <a style="color:#000" href="/index.php?m=content&c=index&a=lists&catid=50">免责声明</a> 京ICP备11043041-5号 京公网安备11010802017113</p>
</div></div></div>
<script type="text/javascript">
$(function(){
	$(".picbig").each(function(i){
		var cur = $(this).find('.img-wrap').eq(0);
		var w = cur.width();
		var h = cur.height();
	   $(this).find('.img-wrap img').LoadImage(true, w, h,'<?php echo IMG_PATH;?>msg_img/loading.gif');
	});
})
</script>
</body>
</html>