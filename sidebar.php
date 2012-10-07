<?php
/*
Theme Name: theme
Version: 4
Template Name: sidebar
File Name: sidebar.php
*/
?>
		<div id="secondary">
			<div class="widgetheader"></div>
			<div class="widget">
				<div id="widget_tab"> 
					<h3 id="tab-title"> 
					<span> 
						<em id="emtab0" data-value="0" class="selected" title="Most Viewed Posts">Most Viewed</em> 
						<em id="emtab1" data-value="-300px" title="Recent Comments">Comments</em> 
						<em id="emtab2" data-value="-600px" title="Recent Posts">Recent</em> 
					</span> 
					</h3> 
					<div class="clear"></div> 
					<div id="tab-content-wrap">
						<div id="tab-content">
							<ul id="tab0" class="rc_views">
								<?php if (function_exists('get_most_viewed')): ?><?php get_most_viewed('post',12); ?> <?php endif; ?>
							</ul>
							<ul id="tab1" class="rc_comments">
							<?php
							$show_comments = 8; //评论数量
							$my_email = get_bloginfo ('admin_email'); 
							$i = 1;
							$comments = get_comments('number=50&status=approve&type=comment'); 
							foreach ($comments as $rc_comment) {
								if ($rc_comment->comment_author_email != $my_email && strstr($rc_comment->comment_content,"<") == false) {
									?>
									<li>
										<?php 
										#$rc_comm_email = $rc_comment->comment_author_email;
										echo get_avatar( $rc_comment->comment_author_email, $size = '50', $default = get_bloginfo('template_directory'). '/images/default.jpg' ); 
										#$a = get_bloginfo('wpurl'). '/avatar/'.md5(strtolower($rc_comm_email)).'.jpg';
										#echo "<img src='" . $a . "' alt='' title='" . $rc_comment->comment_author . "' class='avatar' />";
										?>
										<a href="<?php echo get_permalink($rc_comment->comment_post_ID); ?>#comment-<?php echo $rc_comment->comment_ID; ?>"><?php echo convert_smilies($rc_comment->comment_content); ?></a>
										<span class="rc_info">by <?php echo $rc_comment->comment_author; ?> <?php mak_time($rc_comment->comment_date_gmt); ?></span>
									</li>
									<?php
									if ($i == $show_comments) break; 
									$i++;
								} 
							} 
							?>
							</ul>
							<ul id="tab2" class="rc_tag">
								<?php wp_get_archives('type=postbypost&limit=12&format=html'); ?>	
							</ul>
						</div>
					</div>
				</div> 
			</div>
			<div class="widgetfooter"></div>
			
			<div class="widgetheader"></div>
			<div class="widget">
				<div class="sideL">
					<ul>
						<?php wp_list_categories('show_count=1&title_li=<h2>文章分类</h2>'); ?>
					</ul>				
				</div>
				<div class="sideR">
					<ul class ="post_link">
						<?php wp_list_bookmarks(); ?>
					</ul>				
				</div>
			
				<div class="clear"></div>
			</div> 
			<div class="widgetfooter"></div>
			
			<div class="widgetheader"></div>
			<div class="widget">
				<div class="tag_cloud">
					<h2>Tag cloud</h2>
					<?php wp_tag_cloud('smallest=12&largest=12&number=22&unit=px&orderby=count'); ?>
				</div>
						
				<div class="clear"></div>
			</div> 
			<div class="widgetfooter"></div>
			
			<div class="widgetheader"></div>
			<div id="mottowid" class="widget">
				<?php 
					include(TEMPLATEPATH . '/mak.php'); 
				?>
			</div>
			<div class="widgetfooter"></div>
			
			<?php if (is_home()) { ?>
			<?php
			/*
			<div class="widgetheader"></div>
			<div class="widget">
				<video width="315" height="255" preload="auto" controls="controls">
					<source src="<?php bloginfo('url'); ?>/download/videoplayback.mp4" type="video/mp4" />
					<source src="<?php bloginfo('url'); ?>/download/videoplayback.ogg" type="video/ogg" />
				</video>
			</div>
			<div class="widgetfooter"></div>
			*/
			?>
			<?php } ?>

			<div class="mak-blog">
				<p><a href="http://feed.feedsky.com/mak-blog"><img src="http://img.feedsky.com/feed/mak-blog/sc/gif" height="26" width="88" style="border:0" alt="" /></a>
				<a href="http://feeds2.feedburner.com/mak-blog"><img src="http://feeds.feedburner.com/~fc/mak-blog?bg=99CCFF&amp;fg=444444&amp;anim=0" height="26" width="88" style="border:0" alt="" /></a></p>
			</div>
			
			<div class="mak-blog">
				<strong><?php mak_blog(); ?></strong>
			</div>

		</div>
		<div class="clear"></div>