<?php

$dname = 'X-Simple';

// //自定义小工具
// include('widget/widget.php');
// //自定义主题设置
// include('option/dtheme.php');

//去除头部冗余代码
remove_action( 'wp_head',   'feed_links_extra', 3 ); 
remove_action( 'wp_head',   'rsd_link' ); 
remove_action( 'wp_head',   'wlwmanifest_link' ); 
remove_action( 'wp_head',   'index_rel_link' ); 
remove_action( 'wp_head',   'start_post_rel_link', 10, 0 ); 
remove_action( 'wp_head',   'wp_generator' ); 

//隐藏admin Bar
add_filter('show_admin_bar', create_function($flag, 'return false;'));

//启用特色图片功能
add_theme_support('post-thumbnails');
// add_image_size('headline-thumb', 520, 320, true); 
// add_image_size('entry-thumb', 220, 150, true); 
// add_image_size('side-thumb', 120, 120, true); 

//缩略图获取
function vb_the_thumbnail() {  
    global $post;  
    if ( has_post_thumbnail() ) {   
    $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), $size);
    $thumbnailsrc = $thumbnail[0];
    echo '<img class="lazy pure-img" src="'.$thumbnailsrc.'" alt="'.trim(strip_tags( $post->post_title )).'" />';
    } else {
        $content = $post->post_content;  
        preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);  
        $n = count($strResult[1]);  
        if($n > 0){
            echo '<img class="lazy pure-img" src="'.$strResult[1][0].'" alt="'.trim(strip_tags( $post->post_title )).'" />';  
        }else {
            echo '<img class="lazy pure-img" src="'.get_bloginfo('template_url').'/img/default.jpg" alt="'.trim(strip_tags( $post->post_title )).'" />';  
        }  
    }  
}

//启用后台侧栏widget
if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name'          => '首页/分类页侧栏',
        'id'            => 'widget_sidebar',
        'description'	=> '拖动小工具到这里，它们将显示在首页和分类页',
        'class'			=> '',
        'before_widget' => '<div class="panel panel-info %2$s">',
        'before_title'  => '<div class="panel-heading"><strong>',
        'after_title'   => '</strong></div><div class="panel-body">',
        'after_widget'  => '</div></div>'
	));
	register_sidebar(array(
        'name'          => '文章页侧栏',
        'id'            => 'widget_postsidebar',
        'description'	=> '拖动小工具到这里，它们将显示在文章页',
        'class'			=> '',
        'before_widget' => '<div class="panel panel-info %2$s">',
        'before_title'  => '<div class="panel-heading"><strong>',
        'after_title'   => '</strong></div><div class="panel-body">',
        'after_widget'  => '</div></div>'
    ));
}

//自定义导航菜单
if (function_exists('register_nav_menus')){
    register_nav_menus(array(
        'navbar-left' => '自定义导航左栏',
        'navbar-right' => '自定义导航右栏',
        'menu-footer' => '自定义底部导航',
        'menu-links' => '自定义友情链接'
    ));
}

//根据标签别名获取标签链接地址
function get_tag_link_by_slug($tag_slug) {
	$tag = get_term_by( 'slug', $tag_slug, 'post_tag' ); //用 get_term_by函数获取别名对应的标签数组
	if ($tag) return get_tag_link($tag->term_id); //用 get_tag_link 函数获取标签别名的链接
	return 0;
}

//根据标签名获取标签链接地址
function get_tag_link_by_name($tag_name) {
	$tag = get_term_by( 'name', $tag_name, 'post_tag' ); //用 get_term_by函数获取别名对应的标签数组
	if ($tag) return get_tag_link($tag->term_id); //用 get_tag_link 函数获取标签别名的链接
	return 0;
}

//获取热门标签
function get_hot_tags(){
	$posttags = get_the_tags();   
	if ($posttags) {   
		$hottags = "";
	  	foreach($posttags as $tag) {   
	    	$hottags .= '<a href="'.get_tag_link($tag).'">'. $tag->name .'</a>';   
	  	}   
	} 
	return $hottags;
}


/**
 * 自定义分页导航
 * @param  $range: 最大显示几页
 */
function vb_page_nav($range = 9){
    global $paged, $wp_query;
    if ( !$max_page ) {$max_page = $wp_query->max_num_pages;}
    if($max_page > 1){if(!$paged){$paged = 1;}
    if($paged != 1){echo "<a href='" . get_pagenum_link(1) . "'>最新</a>";}
    previous_posts_link('上页');
    if($max_page > $range){
        if($paged < $range){for($i = 1; $i <= ($range + 1); $i++){echo "<a href='" . get_pagenum_link($i) ."'";
        if($i==$paged)echo " class='current'";echo ">$i</a>";}}
    elseif($paged >= ($max_page - ceil(($range/2)))){
        for($i = $max_page - $range; $i <= $max_page; $i++){echo "<a href='" . get_pagenum_link($i) ."'";
        if($i==$paged)echo " class='current'";echo ">$i</a>";}}
    elseif($paged >= $range && $paged < ($max_page - ceil(($range/2)))){
        for($i = ($paged - ceil($range/2)); $i <= ($paged + ceil(($range/2))); $i++){echo "<a href='" . get_pagenum_link($i) ."'";if($i==$paged) echo " class='current'";echo ">$i</a>";}}}
    else{for($i = 1; $i <= $max_page; $i++){echo "<a href='" . get_pagenum_link($i) ."'";
    if($i==$paged)echo " class='current'";echo ">$i</a>";}}
    next_posts_link('下页');
    if($paged != $max_page){echo "<a href='" . get_pagenum_link($max_page) . "'>最旧</a>";}}
}


function vb_queryinfo(){
    echo '<h2>';
    if (is_category())    { echo '分类“'; echo single_cat_title().'”的内容';
    } elseif ( is_tag() )  { echo '标签“'; echo single_tag_title().'”的内容';
    } elseif ( is_author() ) { echo '作者“'; echo the_author_nickname().'”的内容'; 
    } elseif ( is_day() )  { echo the_time('Y年 F j日').' 的内容';
    } elseif ( is_month() )  { echo the_time('Y年 F').' 的内容';
    } elseif ( is_year() )   { echo the_time('Y年').' 的内容';
    } elseif ( is_search() )   { echo the_search_query(); echo ' 的搜索结果';
    } elseif ( isset($_GET['paged']) && !empty($_GET['paged'])) { echo '您正在浏览的是以前的文章';
    }
    echo '</h2>';
}
    

//禁止无管理权限的人进入后台
function vb_redirect_admin() {
    if ( ! current_user_can( 'manage_options' ) && $_SERVER['PHP_SELF'] != '/wp-admin/admin-ajax.php' ) {
        wp_redirect( home_url() );
    }
}
add_action( 'admin_init', 'vb_redirect_admin', 1 );


/**
 * 自动为文章内的标签添加链接
 */
$match_num_from = 1;//一个标签在文章中出现少于多少次不添加链接
$match_num_to = 1;//一篇文章中同一个标签添加几次链接
//按长度排序
function tag_sort($a, $b){
    if ( $a->name == $b->name ) return 0;
    return ( strlen($a->name) > strlen($b->name) ) ? -1 : 1;
}
//为符合条件的标签添加链接
function tag_link($content){
    global $match_num_from,$match_num_to;
    $posttags = get_the_tags();
    if ($posttags) {
        usort($posttags, "tag_sort");
        foreach($posttags as $tag) {
            $link = get_tag_link($tag->term_id);
            $keyword = $tag->name;
            //链接的代码
            $cleankeyword = stripslashes($keyword);
            $url = "<a href=\"$link\" title=\"".str_replace('%s',addcslashes($cleankeyword, '$'),__('View all posts in %s'))."\"";
            $url .= ' target="_blank"';
            $url .= ">".addcslashes($cleankeyword, '$')."</a>";
            $limit = rand($match_num_from,$match_num_to);
            //不链接的代码
            $content = preg_replace( '|(<a[^>]+>)(.*)('.$ex_word.')(.*)(</a[^>]*>)|U'.$case, '$1$2%&&&&&%$4$5', $content);
            $content = preg_replace( '|(<img)(.*?)('.$ex_word.')(.*?)(>)|U'.$case, '$1$2%&&&&&%$4$5', $content);
            $cleankeyword = preg_quote($cleankeyword,'\'');
            $regEx = '\'(?!((<.*?)|(<a.*?)))('. $cleankeyword . ')(?!(([^<>]*?)>)|([^>]*?</a>))\'s' . $case;
            $content = preg_replace($regEx,$url,$content,$limit);
            $content = str_replace( '%&&&&&%', stripslashes($ex_word), $content);
        }
    }
    return $content;
}
add_filter('the_content','tag_link',1);


/**
 * 自动为文章添加已使用过的标签（会导致无法手动删除标签）
 */
// function auto_add_tags(){
//     $tags = get_tags( array('hide_empty' => false) );
//     $post_id = get_the_ID();
//     $post_content = get_post($post_id)->post_content;
//     if ($tags) {
//         foreach ( $tags as $tag ) {
//             // 如果文章内容出现了已使用过的标签，自动添加这些标签
//             if ( strpos($post_content, $tag->name) !== false)
//                 wp_set_post_tags( $post_id, $tag->name, true );
//         }
//     }
// }
// add_action('save_post', 'auto_add_tags');


//移除googlefont，因为天朝的屏蔽导致进入后台巨慢
function remove_open_sans() {
    wp_deregister_style( 'open-sans' );
    wp_register_style( 'open-sans', false );
    wp_enqueue_style('open-sans','');
}
add_action('init','remove_open_sans');

//获取主题设置
function getThemeOption($e){
    return stripslashes(get_option($e));
}

//百度分享组件
$HasShare = false;
function getThemeShare(){
    echo '<div id="bdshare" class="bdsharebuttonbox">
        <a class="bds_count" data-cmd="count"></a>
        <a class="bds_tsina" data-cmd="tsina" title="分享到新浪微博">分享到微博</a>
        <a class="bds_weixin" data-cmd="weixin" title="分享到微信">分享到微信</a>
        <a class="bds_sqq" data-cmd="sqq" title="分享到QQ">分享到QQ</a>
        <a class="bds_renren" data-cmd="renren" title="分享到人人网">分享到人人</a>
    </div>';
    global $HasShare;
    $HasShare = true;
}


?>