<?php
/*
Theme Name: mak
Version: 4
File Name: function.php
*/
?>
<?php
/*半角*/
remove_filter('the_content','wptexturize');

/*自定义表情路径*/
function custom_smilies_src($src, $img){
    return get_option('home') . '/wp-content/themes/mak/images/smilies/' . $img;
}
add_filter('smilies_src', 'custom_smilies_src', 10, 2);

/* Mini Pagenavi v1.0 by Willin Kan. Edit by zwwooooo */
if ( !function_exists('pagenavi') ) {
	function pagenavi( $p = 4 ) {
		if ( is_singular() ) return;
		global $wp_query, $paged;
		$max_page = $wp_query->max_num_pages;
		if ( $max_page == 1 ) return;
		if ( empty( $paged ) ) $paged = 1;
		if ( $paged > 1 ) p_link( $paged - 1, '上一页', 'Previous' );
		if ( $paged > $p + 1 ) p_link( 1, '最前页' );
		if ( $paged > $p + 2 ) echo '... ';
		for( $i = $paged - $p; $i <= $paged + $p; $i++ ) {
			if ( $i > 0 && $i <= $max_page ) $i == $paged ? print "<span class='page-numbers current'>{$i}</span> " : p_link( $i );
		}
		if ( $paged < $max_page - $p - 1 ) echo '... ';
		if ( $paged < $max_page - $p ) p_link( $max_page, '最后页' );
		if ( $paged < $max_page ) p_link( $paged + 1,'下一页', 'Next' );
	}
	function p_link( $i, $title = '', $linktype = '' ) {
		if ( $title == '' ) $title = "第 {$i} 页";
		if ( $linktype == '' ) { $linktext = $i; } else { $linktext = $linktype; }
		echo "<a class='page-numbers' href='", esc_html( get_pagenum_link( $i ) ), "' title='{$title}'>{$linktext}</a> ";
	}
}

/* mak_time v1.0 by evlos.*/
function mak_time($gmto) {
	$set = 24*60*60*10;   
	$info = array(array(86400,'天'),array(3600,'小时'),array(60,'分钟'),array(1,'秒'));
	$gmt = strtotime($gmto);   
	$inte = strtotime(gmdate('Y-m-j G:i:s')) - $gmt;
	if (($inte <= $set)&($inte > 0)) {     
		foreach ($info as $val) {       
			$count = 0;       
			while ($inte - $val[0] > 0) {         
				$inte = $inte - $val[0];         
				$count++;       
			}       
			if ($count>0) { 
				$res .= $count.$val[1]; 
				break;
			}			
		}
		if ($res == '') { 
			$res = '0s'; 
		}
		$res = '约'.$res.'前';   
	} else {     
		$res = date(get_settings('date_format').' '.get_settings('time_format'),$gmt+get_settings("gmt_offset")*3600);   
	}   echo "&nbsp;&nbsp;".$res; 
} 

/* 博客建立时间计数 */
function mak_blog() {
	$info = array(array(86400,'天'));
	$gmt = strtotime("9 July 2008");   
	$inte = strtotime(gmdate('Y-m-j')) - $gmt;
	if ($inte > 0) {     
		foreach ($info as $val) {       
			$count = 0;       
			while ($inte - $val[0] > 0) {         
				$inte = $inte - $val[0];         
				$count++;       
			}       
			if ($count>0) { 
				$res = $count; 
				break;
			}			
		}
		$res = '低调地默默存在了'.$res.'天';   
	}
	echo $res; 
}

/* wp_list_comments() callback */
function mytheme_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment;
   global $commentcount;
   if(!$commentcount) {
	   $page = ( !empty($in_comment_loop) ) ? get_query_var('cpage')-1 : get_page_of_comment( $comment->comment_ID, $args )-1;
	   $cpp=get_option('comments_per_page');
	   $commentcount = $cpp * $page;
	}
?>
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
		<div id="comment-<?php comment_ID(); ?>" class="comment-body">
			<div class="comment-author"><?php echo get_avatar( $comment, $size = '26'); ?></div>
			<div class="comment-head">
				<span class="name"><?php printf(__('%s'), get_comment_author_link()) ?> ： </span>
				<div class="date"><?php if(!$parent_id = $comment->comment_parent) {printf(__('%1$s'), time_ago());} ?> <?php if(!$parent_id = $comment->comment_parent) {printf('#%1$s', ++$commentcount);} ?></div>
				<div class="comment-entry"><?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => __('回复')))) ?> <?php comment_text() ?> </div>
			</div>

     </div>
<?php
}

/* Time Ago by Willin Kan. */
function time_ago( $type = 'commennt', $day = 356 ) {
  $d = $type == 'post' ? 'get_post_time' : 'get_comment_time';
  if (time() - $d('U') > 60*60*24*$day) echo get_comment_date('Y/n/j');
  else echo ' (', human_time_diff($d('U'), strtotime(current_time('mysql', 0))), '之前)';
}

/* comment_mail_notify v1.0 by willin kan. (有勾選欄, 由訪客決定) */
function comment_mail_notify($comment_id) {
  $admin_notify = '1'; // admin 要不要收回覆通知 ( '1'=要 ; '0'=不要 )
  $admin_email = get_bloginfo ('admin_email'); // $admin_email 可改為你指定的 e-mail.
  $comment = get_comment($comment_id);
  $comment_author_email = trim($comment->comment_author_email);
  $parent_id = $comment->comment_parent ? $comment->comment_parent : '';
  global $wpdb;
  if ($wpdb->query("Describe {$wpdb->comments} comment_mail_notify") == '')
    $wpdb->query("ALTER TABLE {$wpdb->comments} ADD COLUMN comment_mail_notify TINYINT NOT NULL DEFAULT 0;");
  if (($comment_author_email != $admin_email && isset($_POST['comment_mail_notify'])) || ($comment_author_email == $admin_email && $admin_notify == '1'))
    $wpdb->query("UPDATE {$wpdb->comments} SET comment_mail_notify='1' WHERE comment_ID='$comment_id'");
  $notify = $parent_id ? get_comment($parent_id)->comment_mail_notify : '0';
  $spam_confirmed = $comment->comment_approved;
  if ($parent_id != '' && $spam_confirmed != 'spam' && $notify == '1') {
    $wp_email = 'no-reply@' . preg_replace('#^www\.#', '', strtolower($_SERVER['SERVER_NAME'])); // e-mail 發出點, no-reply 可改為可用的 e-mail.
    $to = trim(get_comment($parent_id)->comment_author_email);
    $subject = '您在 [' . get_option("blogname") . '] 的留言有了回應';
    $message = '
      <div style="background-color:#eef2fa; border:1px solid #d8e3e8; color:#111; padding:0 15px; -moz-border-radius:5px; -webkit-border-radius:5px; -khtml-border-radius:5px; border-radius:5px;">
      <p>' . trim(get_comment($parent_id)->comment_author) . ', 您好!</p>
      <p>您曾在《' . get_the_title($comment->comment_post_ID) . '》的留言:<br />'
       . trim(get_comment($parent_id)->comment_content) . '</p>
      <p>' . trim($comment->comment_author) . ' 給您的回應:<br />'
       . trim($comment->comment_content) . '<br /></p>
      <p>您可以點擊 <a href="' . esc_attr(get_comment_link($parent_id, array('type' => 'comment'))) . '">查看回應完整內容</a></p>
      <p>歡迎再度光臨 <a href="' . get_option('home') . '">' . get_option('blogname') . '</a></p>
      <p>(此郵件由系統自動發出, 請勿回覆.)</p>
      </div>';
    $from = "From: \"" . get_option('blogname') . "\" <$wp_email>";
    $headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";
    wp_mail( $to, $subject, $message, $headers );
    //echo 'mail to ', $to, '<br/> ' , $subject, $message; // for testing
  }
}
add_action('comment_post', 'comment_mail_notify');

/* 让Wordpress通过HTML5校验 <?php the_category(', ') ?>问题*/
foreach(array(
	'rsd_link',//rel="EditURI"
	'index_rel_link',//rel="index"
	'start_post_rel_link',//rel="start"
	'wlwmanifest_link'//rel="wlwmanifest"
) as $xx)
remove_action('wp_head',$xx);
//rel="category"或rel="category tag", 这个最巨量
function the_category_filter($thelist){
	return preg_replace('/rel=".*?"/','rel="tag"',$thelist);
} 
add_filter('the_category','the_category_filter');

?>
