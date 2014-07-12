<?php

$dname = 'B1';


//自定义主题设置
include('option/dtheme.php');


//去除头部冗余代码
remove_action( 'wp_head', 'feed_links_extra', 3 ); 
remove_action( 'wp_head', 'rsd_link' ); 
remove_action( 'wp_head', 'wlwmanifest_link' ); 
remove_action( 'wp_head', 'index_rel_link' ); 
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); 
remove_action( 'wp_head', 'wp_generator' ); 


//隐藏admin Bar
add_filter('show_admin_bar', create_function($flag, 'return false;'));


//启用特色图片功能
add_theme_support('post-thumbnails');


//Gzip压缩
function initGzip() {
    if ( strstr($_SERVER['REQUEST_URI'], '/js/tinymce') )
        return false;
    if ( ( ini_get('zlib.output_compression') == 'On' || ini_get('zlib.output_compression_level') > 0 ) || ini_get('output_handler') == 'ob_gzhandler' )
        return false;
    if (extension_loaded('zlib') && !ob_start('ob_gzhandler'))
        ob_start();
}
add_action('init','initGzip'); 


//阻止站内PingBack
if( getThemeOption('d_pingback_b') != '' ){
    add_action('pre_ping','do_not_pingback');   
}
function do_not_pingback( &$links ) {
    $home = get_option( 'home' );
    foreach ( $links as $l => $link )
    if ( 0 === strpos( $link, $home ) )
    unset($links[$l]);
}


//移除自动保存和修订版本
if( getThemeOption('d_autosave_b') != '' ){
    add_action('wp_print_scripts', 'disable_autosave');
    remove_action('pre_post_update', 'wp_save_post_revision');
}
function disable_autosave() {
    wp_deregister_script('autosave');
}
    

//禁止无管理权限的人进入后台
function redirect_admin() {
    if ( ! current_user_can( 'manage_options' ) && $_SERVER['PHP_SELF'] != '/wp-admin/admin-ajax.php' ) {
        wp_redirect( home_url() );
    }
}
add_action( 'admin_init', 'redirect_admin', 1 );


/**
 * 自动为文章内的标签添加链接
 */
$match_num_from = 1;//一个标签出现少于多少次不添加链接
$match_num_to = 1;//同一个标签添加几次链接
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
 * 自动为文章添加已使用过的标签（注意：会导致无法手动删除标签）
 */
function auto_add_tags(){
    $tags = get_tags( array('hide_empty' => false) );
    $post_id = get_the_ID();
    $post_content = get_post($post_id)->post_content;
    if ($tags) {
        foreach ( $tags as $tag ) {
            // 如果文章内容出现了已使用过的标签，自动添加这些标签
            if ( strpos($post_content, $tag->name) !== false)
                wp_set_post_tags( $post_id, $tag->name, true );
        }
    }
}
add_action('save_post', 'auto_add_tags');


//移除googlefont，因为天朝的屏蔽导致进入后台巨慢
function remove_open_sans() {
    wp_deregister_style( 'open-sans' );
    wp_register_style( 'open-sans', false );
    wp_enqueue_style('open-sans','');
}
add_action('init','remove_open_sans');


/**
 * 自定义分页导航
 * @param  $range: 最大显示几页
 */
function getPagination($range = 9){
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
    if($i==$paged) echo " class='current'";echo ">$i</a>";}}
    next_posts_link('下页');
    if($paged != $max_page){echo "<a href='" . get_pagenum_link($max_page) . "'>最旧</a>";}}
}


//获取头像($param为用户email或者用户id)
function getAvatarUrl($param){ 
    $p = get_bloginfo('template_directory').'/img/avatar.jpg';
    if($param == '') {
        return $p;
    } else {
        preg_match("/src='(.*?)'/i", get_avatar( $param, '150'), $matches);
        return $matches[1];
    }
}


//获取缩略图
function getThumbnail() {  
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


//获取缩略图url
function getThumbnailUrl(){ 
    global $post;  
    if ( has_post_thumbnail() ) {   
        $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), $size);
        return $thumbnail[0];
    } else {
        $content = $post->post_content;  
        preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);  
        $n = count($strResult[1]);  
        if($n > 0){
            return $strResult[1][0];
            // echo '<img class="lazy pure-img" src="'.$strResult[1][0].'" alt="'.trim(strip_tags( $post->post_title )).'" />';  
        }else {
            return get_bloginfo('template_url').'/img/default.jpg';
            //echo '<img class="lazy pure-img" src="'.get_bloginfo('template_url').'/img/default.jpg" alt="'.trim(strip_tags( $post->post_title )).'" />';  
        }  
    }
}


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