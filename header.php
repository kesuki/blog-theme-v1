<?php
/*
Theme Name: mak
Version: 4
File Name: header.php
*/
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="UTF-8" />
<title><?php global $page, $paged;wp_title( '|', true, 'right' );bloginfo( 'name' );$site_description = get_bloginfo( 'description', 'display' );if ( $site_description && ( is_home() || is_front_page() ) ) echo " | $site_description";if ( $paged >= 2 || $page >= 2 ) echo ' | ' . sprintf( __( '第 %s 页'), max( $paged, $page ) );?></title>
<?php
if (is_home()){
	$description = "Mak是一个记录编程开发的博客，分享自己在折腾的过程中遇到的纠结，内容没有局限，夹杂着些许杂谈。";
	$keywords = "Mak,Qt,Ubuntu,google,Godaddy,网站建设，编程开发，嵌入式，随笔杂感";
} else if (is_single()){
	if ($post->post_excerpt) {
		$description = $post->post_excerpt;
	} else {
    	$description =  mb_strimwidth(strip_tags($post->post_content),0,220,"...");
	}
	$description = str_replace(array("\r\n", "\r", "\n", " "), " ", $description);
	$description = str_replace(array("\""), "", $description);

	$keywords = "";       
	$tags = wp_get_post_tags($post->ID);
	foreach ($tags as $tag ) {
		$keywords = $keywords . $tag->name . ", ";
	}
	$keywords = substr($keywords,0,-2);
}
?>
<?php if ((is_home())||(is_single())){ ?>
<meta name="description" content="<?=$description?>" />
<meta name="keywords" content="<?=$keywords?>" />
<?php } ?>
<link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/images/favicon.ico" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="alternate" type="application/rss+xml" title="Feedsky RSS 2.0" href="<?php bloginfo('rss2_url'); ?>"/>
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-26298098-4']);
  _gaq.push(['_setDomainName', '.mak-blog.com']);
  _gaq.push(['_trackPageview']);
</script>

<?php wp_head(); ?>
</head>
<body>
<div id="container">
	<div id="header">
		<div id="hdr-main">
			<div id="hdr-wrap">
				<a id="hdr-banner-title" href="<?php bloginfo('url'); ?>"><img src="<?php bloginfo('template_url'); ?>/images/logo.png" width="220" height="90"></a>
			</div>
			<div id="hdr-nav"> 
				<ul> 
					<li><a rel="nofollow" href="<?php bloginfo('url'); ?>">Home</a></li> 
					<li><a href="<?php bloginfo('url'); ?>/album" title="相册">相册</a></li>
					<li><a href="<?php bloginfo('url'); ?>/a-list" title="List">List</a></li>
					<li><a href="<?php bloginfo('url'); ?>/a-word" title="片言只语">片言只语</a></li> 
					<li><a href="<?php bloginfo('url'); ?>/about" title="关于">关于</a></li> 
				</ul> 
			</div>
			<div id="motto">
				<span>
					<a>Mak是记录，分享，交流的空间。</a>
				</span>
			</div>
			<form method="get" id="searchform" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
				<div>
					<input type="text" name="s" id="s" placeholder="输入回车搜索" x-webkit-speech/>
				</div>
			</form>
		</div>
	</div>