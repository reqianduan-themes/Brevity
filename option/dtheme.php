<?php

$themename = $dname.'主题';

$options = array (

	//基本设置
	array( "name" => "基本设置","type" => "section","desc" => "主题的基本设置，包括模块是否开启等"),

	array( "name" => "网站描述","type" => "tit"),
	array( "id" => "d_description","type" => "text","std" => "输入你的网站描述，一般不超过200个字符"),
	
	array( "name" => "网站关键字","type" => "tit"),	
	array( "id" => "d_keywords","type" => "text","std" => "输入你的网站关键字，一般不超过100个字符。 关键字之间用 ',' 隔开"),

	array( "name" => "网站备案号","type" => "tit"),	
	array( "id" => "d_beian","type" => "text","std" => "粤ICP备12345678号-1"),

	array( "name" => "阻止站内文章Pingback","type" => "tit"),	
	array( "id" => "d_pingback_b","type" => "checkbox" ),

	array( "name" => "移除后台编辑时自动保存","type" => "tit"),	
	array( "id" => "d_autosave_b","type" => "checkbox" ),

	array( "type" => "endtag"),


	//社交网络
	array( "name" => "社交网络","type" => "section" ),	
	
	array( "name" => "多说评论id","type" => "tit"),
	array( "id" => "d_duoshuo","type" => "text","class" => "d_inp_short","std" => "xiguabaobaowp"),

	array( "name" => "新浪微博主页","type" => "tit"),	
	array( "id" => "d_weibo","type" => "text","class" => "d_inp_short","std" => "http://weibo.com/arvinxiang/"),

	array( "name" => "微信二维码","type" => "tit"),	
	array( "id" => "d_weixin","type" => "text","class" => "d_inp_short","std" => "http://arvin.qiniudn.com/qrcode.jpg"),

	array( "type" => "endtag"),


	//首尾代码
	array( "name" => "首尾代码","type" => "section" ),	
	
	// array( "name" => "流量统计代码","type" => "tit"),	
	// array( "id" => "d_track_b","type" => "checkbox" ),
	// array( "id" => "d_track","type" => "textarea","std" => "贴入百度统计、CNZZ、51啦、量子统计代码等等"),

	array( "name" => "头部公共代码","type" => "tit"),	
	array( "id" => "d_headcode_b","type" => "checkbox" ),
	array( "id" => "d_headcode","type" => "textarea","std" => "这部分代码显示在head标签内，可以是css，js等代码"),

	array( "name" => "底部公共代码","type" => "tit"),	
	array( "id" => "d_footcode_b","type" => "checkbox" ),
	array( "id" => "d_footcode","type" => "textarea","std" => "这部分代码显示在页面最底部，可以是js等代码"),

	array( "type" => "endtag"),

);

function mytheme_add_admin() {
	global $themename, $options;
	if ( $_GET['page'] == basename(__FILE__) ) {
		if ( 'save' == $_REQUEST['action'] ) {
			foreach ($options as $value) {
				update_option( $value['id'], $_REQUEST[ $value['id'] ] ); 
			}
			header("Location: admin.php?page=dtheme.php&saved=true");
			die;
		}
		else if( 'reset' == $_REQUEST['action'] ) {
			foreach ($options as $value) {delete_option( $value['id'] ); }
			header("Location: admin.php?page=dtheme.php&reset=true");
			die;
		}
	}
	add_theme_page($themename." Options", $themename."设置", 'edit_themes', basename(__FILE__), 'mytheme_admin');
}

function mytheme_admin() {
	global $themename, $options;
	$i=0;
	if ( $_REQUEST['saved'] ) echo '<div class="d_message">'.$themename.'修改已保存</div>';
	if ( $_REQUEST['reset'] ) echo '<div class="d_message">'.$themename.'已恢复设置</div>';
?>

<div class="wrap d_wrap">
	<link rel="stylesheet" href="<?php bloginfo('template_url') ?>/option/dtheme.css"/>
	<h2><?php echo $themename; ?>设置
		<span class="d_themedesc">技术支持：<a href="http://www.xiguabaobao.com/" target="_blank">西瓜宝宝</a></span>
	</h2>
	
	<form method="post" class="d_formwrap">
		<div class="d_tab">
			<ul>
				<li class="d_tab_on">基本设置</li>
				<li>社交网络</li>
				<li>首尾代码</li>
			</ul>
		</div>
		<?php foreach ($options as $value) { switch ( $value['type'] ) { case "": ?>
			<?php break; case "tit": ?>
			</li><li class="d_li">
			<h4><?php echo $value['name']; ?>：</h4>
			<div class="d_tip"><?php echo $value['tip']; ?></div>
			
			<?php break; case 'text': ?>
			<input class="d_inp <?php echo $value['class']; ?>" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id'])  ); } else { echo $value['std']; } ?>" />

			<?php break; case 'number': ?>
			<label class="d_number"><?php echo $value['txt']; ?><input class="d_num <?php echo $value['class']; ?>" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id'])  ); } else { echo $value['std']; } ?>" /></label>
			
			<?php break; case 'textarea': ?>
			<textarea class="d_tarea" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id']) ); } else { echo $value['std']; } ?></textarea>
			
			<?php break; case 'select': ?>
			<?php if ( $value['desc'] != "") { ?><span class="d_the_desc" id="<?php echo $value['id']; ?>_desc"><?php echo $value['desc']; ?></span><?php } ?><select class="d_sel" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
				<?php foreach ($value['options'] as $option) { ?>
				<option <?php if (get_settings( $value['id'] ) == $option) { echo 'selected="selected" class="d_sel_opt"'; } ?>><?php echo $option; ?></option>
				<?php } ?>
			</select>
			
			<?php break; case "checkbox": ?>
			<?php if(get_settings($value['id']) != ""){ $checked = "checked=\"checked\""; }else{ $checked = "";} ?>
			<label class="d_check"><input type="checkbox" id="<?php echo $value['id']; ?>" name="<?php echo $value['id']; ?>" <?php echo $checked; ?> />开启</label>
			
			<?php break; case "section": $i++; ?>
			<div class="d_mainbox" id="d_mainbox_<?php echo $i; ?>">
				<ul class="d_inner">
					<li class="d_li">
				
			<?php break; case "endtag": ?>
			</li></ul>
			<div class="d_desc"><input class="button-primary" name="save<?php echo $i; ?>" type="submit" value="保存设置" /></div>
			</div>
			
		<?php break; }} ?>
				
		<input type="hidden" name="action" value="save" />
	</form>
	<script src="<?php bloginfo('template_url') ?>/js/jquery.min.js"></script>
	<script src="<?php bloginfo('template_url') ?>/option/dtheme.js"></script>
</div>
<?php } ?>
<?php add_action('admin_menu', 'mytheme_add_admin');?>