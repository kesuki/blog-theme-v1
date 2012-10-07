<?php
/*
Theme Name: mak
Version: 4
File Name: comments.php
*/
?>
<?php if ( post_password_required() ) : ?>
<?php _e( 'Enter your password to view comments.' ); ?>
<?php return; endif; ?>
<?php
$my_email = get_bloginfo ( 'admin_email' );
$str = "SELECT COUNT(*) FROM $wpdb->comments WHERE comment_post_ID = $post->ID 
AND comment_approved = '1' AND comment_type = '' AND comment_author_email";
$count_t = $post->comment_count;
$count_v = $wpdb->get_var("$str != '$my_email'");
$count_h = $wpdb->get_var("$str = '$my_email'");
$count_p = count($comments_by_type['pings']);
?>
<div class="commentsorping">
	<div class="commentpart"><?php echo "Comment (", $count_v+$count_h,")"; ?></div>
	<div class="pingpart"><?php echo "Trackback (", $count_p,")"; ?></div>
</div>
<div class="clear"></div>
<div class="comt">
	<?php if ( have_comments() ) : ?>
		<ol class="commentlist">
			<?php wp_list_comments('type=comment&callback=mytheme_comment'); ?>
		</ol>
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<div class="navigation">	
    	    	<span class="alignleft"><?php previous_comments_link( __( '&laquo; Older Comments' ) ); ?></span>
        		<span class="alignright"><?php next_comments_link( __( 'Newer Comments &raquo;' ) ); ?></span>
    		</div>
		<?php endif; ?>

		<?php $Pingbacks = $comments_by_type['pings']; if ( ! empty($Pingbacks) ) : ?>
		<ul class="pinglist">
			<?php foreach ( array_reverse( $Pingbacks ) as $comment) : ?>
			<li id="comment-<?php comment_ID( ); ?>">
				<div class="pingdiv">
					<?php comment_author_link(); ?>
				</div>
			</li>
			<?php endforeach; ?>
		</ul>
		<?php endif; ?>

	<?php elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p><?php _e( 'Comments are closed.' ); ?></p>
	<?php endif; ?>


<div id="respond">
<h3 id="reply-title">
<?php comment_form_title('发表评论', '评论回复'); ?> 
<small><?php cancel_comment_reply_link(); ?></small>
</h3>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
<h3 class="query-info"><?php printf('发表评论您必须先<a href="%s">登入</a>。', wp_login_url( get_permalink() ) );?></h3>
<?php else : ?>
<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform" name="comm_frm">
<?php if ( is_user_logged_in() ) { ?>
<p><?php printf('登入为 %s。', '<a href="'.get_option('siteurl').'/wp-admin/profile.php">'.$user_identity.'</a>'); ?> <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php echo '退出这个账号'; ?>"><?php echo '退出 &raquo;'; ?></a></p>
<?php } else { ?>

<div id ="author_info">
<p class="comment-notes">电子邮件地址不会被公开。 必填项已用 <span class="required">*</span> 标注</p>
<p class="comment-form-author"><label for="author">姓名</label> <span class="required">*</span>
<input id="author" name="author" type="text" value="<?php echo esc_attr($comment_author); ?>" size="30" aria-required="true"></p>
<p class="comment-form-email"><label for="email">电子邮件</label> <span class="required">*</span>
<input id="email" name="email" type="text" value="<?php echo esc_attr($comment_author); ?>" size="30" aria-required="true"></p>
<p class="comment-form-url"><label for="url">站点</label>
<input id="url" name="url" type="text" value="<?php echo esc_attr($comment_author_url); ?>" size="30"></p>
</div>

<?php if ( !empty($comment_author) ) { ?>
			<div id="author_info_save">
				<?php if ($comment_author_email == get_bloginfo ('admin_email')){ ?>
				<img src="<?php echo bloginfo('template_directory'),'/images/my-avatar.jpg' ?>" alt="" class="avatar" />
				<?php } else { echo get_avatar($comment_author_email, $size = '50', $default = get_bloginfo('template_directory') . '/images/default.jpg'); } ?>
				<span class="author-name"><?php echo $comment_author ?></span>
				<a href="javascript:showCommentAuthorInfo();">(更改)</a>
			</div>
			<script type="text/javascript">
			//<![CDATA[
				jQuery(document).ready(function() {
					jQuery('#author_info_save').show();
					jQuery('#author_info').fadeTo(1, 0);
				});
				function showCommentAuthorInfo() {
					jQuery('#author_info_save').hide();
					jQuery('#author_info').fadeTo('slow', 1);
				}
			//]]>
			</script>
<?php } } ?>

<div class="clear"></div>
<p class="comment-form-comment"><label for="comment">评论</label>
<br><?php include(TEMPLATEPATH . '/smiley.php');?><br>
<textarea id="comment" name="comment" cols="45" rows="8"></textarea><div id="loading" style="display: none; "><img src="http://localhost/~ching/wordpress/wp-admin/images/wpspin_light.gif" style="vertical-align:middle;" alt=""> 正在提交, 请稍候...</div><div id="error" style="display: none; ">#</div></p>
<p>
<input type="submit" name="submit" id="submit" class="buttom" tabindex="5" value="发表评论" />
<input type="checkbox" name="comment_mail_notify" id="comment_mail_notify" value="comment_mail_notify" checked="checked" style="width: auto;margin-left:20px;" /><label for="comment_mail_notify">有人回复時使用邮件通知我</label>
<?php comment_id_fields(); ?>
<?php do_action('comment_form', $post->ID); ?>
</p>
<div class="clear"></div>
</form>

<?php endif; ?>
</div><!-- #respond -->

	<script type="text/javascript">
/* <![CDATA[ */
    function grin(tag) {
      if (document.getElementById('comment') && document.getElementById('comment').type == 'textarea') {
        myField = document.getElementById('comment');
      } else {
        return false;
      }
      tag = ' ' + tag + ' ';
      if (document.selection) {
        myField.focus();
        sel = document.selection.createRange();
        sel.text = tag;
        myField.focus();
      }
      else if (myField.selectionStart || myField.selectionStart == '0') {
        startPos = myField.selectionStart
        endPos = myField.selectionEnd;
        cursorPos = startPos;
        myField.value = myField.value.substring(0, startPos)
                      + tag
                      + myField.value.substring(endPos, myField.value.length);
        cursorPos += tag.length;
        myField.focus();
        myField.selectionStart = cursorPos;
        myField.selectionEnd = cursorPos;
      }
      else {
        myField.value += tag;
        myField.focus();
      }
    }
/* ]]> */
</script>
</div><!-- #comt -->