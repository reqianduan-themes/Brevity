<!DOCTYPE html>
<!--
******开发者信息******
 * Theme Name: Brevity
 * Theme URI: http://themes.xiguabaobao.com/Brevity/
 * Description: Brevity主题（免费） 技术支持：<a href="http://themes.xiguabaobao.com/Brevity/#respond">西瓜宝宝</a>
 * Author: 西瓜宝宝主题
 * Author URI: http://themes.xiguabaobao.com
 * Version: 1.0.0
 * © 2014 themes.xiguabaobao.com. All rights reserved.
-->
<html>
<head>
	<meta charset="utf-8">
	<title><?php wp_title('-', true, 'right'); echo get_option('blogname'); if (is_home ()) echo "-", get_option('blogdescription'); if ($paged > 1) echo '-Page ', $paged; ?></title>
	<meta name="description" content="<?php if (is_home ()) echo getThemeOption('d_description'); ?>">
	<meta name="keywords" content="<?php if (is_home ()) echo getThemeOption('d_keywords'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="generator" content="西瓜宝宝主题v1.0">
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>?20141029">

	<?php if( getThemeOption('d_headcode_b') != '' ) echo getThemeOption('d_headcode'); ?>
</head>
<body>
	<!-- <div class="header">
		<a href="<?php bloginfo('url'); ?>" class="menu">
			<div class="menu_ico"></div>
		</a>
		<a href="<?php bloginfo('url'); ?>" class="logo">
			<img src="<?php bloginfo('template_url'); ?>/img/logo_small.png" alt="<?php echo get_option('blogname'); ?> - <?php echo get_option('blogdescription'); ?>">
		</a>
		<a href="<?php bloginfo('url'); ?>" class="seach">
			<div id="search"></div>
		</a>
	</div> -->