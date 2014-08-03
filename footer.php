	<div class="footer">
		<div class="info">
			<a href="<?php echo getThemeOption('d_weibo'); ?>" target="_blank" title="新浪微博">
				<div class="icon">
					<div class="weibo bg_logo"></div>
				</div>
			</a>
			<a href="javascript:void(0);" target="_blank" title="微信">
				<div class="icon">
					<div class="weixin bg_logo"></div>
					<img class="qrcode" alt="" src="<?php echo getThemeOption('d_weixin'); ?>" style="width:260px;height:260px;left: 822.5px; top: 4482.53125px; display: none;"></div>
			</a>
			<a href="#" target="_blank" title="视频">
				<div class="icon">
					<div class="video bg_logo"></div>
				</div>
			</a>
			<a href="<?php bloginfo('rss2_url'); ?>" target="_blank" title="RSS订阅">
				<div class="icon">
					<div class="rss bg_logo"></div>
				</div>
			</a>
		</div>
		<div id="foot-info">
			<a href="http://themes.xiguabaobao.com/" id="foot-logo">
				<img src="http://arvin.qiniudn.com/%E7%94%A8%E5%BF%83%E5%81%9A%E4%B8%BB%E9%A2%98.png" alt="<?php bloginfo('name'); ?> logo">
			</a>
			<section class="copyright">&copy; 2014 <?php bloginfo('name'); ?>. All Rights Reserved.</section>
			<p class="approve"><?php  echo (getThemeOption('d_beian') == '' ? 'Theme by <a href="http://themes.xiguabaobao.com/B1/">B1</a>' : getThemeOption('d_beian')); ?></p>
		</div>
	</div>

	<script src="<?php bloginfo('template_url'); ?>/js/jquery.min.js"></script>
	<script src="<?php bloginfo('template_url'); ?>/js/jquery.lazyload.min.js"></script>
	<script src="<?php bloginfo('template_url'); ?>/js/jquery.topbar.js"></script>
	<script src="<?php bloginfo('template_url'); ?>/js/script.js"></script>
	<script type="text/javascript">
		var duoshuoQuery = {short_name:"<?php echo getThemeOption('d_duoshuo'); ?>"};
		(function() {
			var ds = document.createElement('script');
			ds.type = 'text/javascript';ds.async = true;
			ds.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') + '//static.duoshuo.com/embed.js';
			ds.charset = 'UTF-8';
			(document.getElementsByTagName('head')[0] 
			 || document.getElementsByTagName('body')[0]).appendChild(ds);
		})();
	</script>
	<?php 
		global $HasShare; 
		if($HasShare == true){ 
			echo '<script>window._bd_share_config={"common":{},"share":{}};with(document)0[(getElementsByTagName("head")[0]||body).appendChild(createElement("script")).src="http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion="+~(-new Date()/36e5)];</script>';
		} 
		if( getThemeOption('d_footcode_b') != '' ) echo getThemeOption('d_footcode'); 
	?>
</body>
</html>