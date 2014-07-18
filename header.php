<!DOCTYPE html>
<!--
******开发者信息******
Name: Jason Xiang
Mail: info@xiguabaobao.com
Site: http://xiguabaobao.com
Date: 2014-07-12
-->
<html>
<head>
	<meta charset="utf-8">
	<title><?php wp_title('-', true, 'right'); echo get_option('blogname'); if (is_home ()) echo "-", get_option('blogdescription'); if ($paged > 1) echo '-Page ', $paged; ?></title>
	<meta name="description" content="<?php if (is_home ()) echo getThemeOption('d_description'); ?>">
	<meta name="keywords" content="<?php if (is_home ()) echo getThemeOption('d_keywords'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="generator" content="西瓜宝宝 1.0">
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/pure.css">
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/base.css">
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/screen.css">
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/post.css">
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/bdshare.custom.css">
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/duoshuo.custom.css">
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/typography.css">
	<?php if( getThemeOption('d_headcode_b') != '' ) echo getThemeOption('d_headcode'); ?>
</head>
<body>
	<div class="header">
		<a href="/list" class="menu">
			<div class="menu_ico"></div>
		</a>
		<a href="<?php bloginfo('url'); ?>" class="logo">
			<div></div>
		</a>
		<a href="/list" class="seach">
			<div id="search"></div>
		</a>
	</div>