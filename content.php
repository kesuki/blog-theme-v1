<?php
/*
Theme Name: mak
Version: 4
File Name: content.php
*/
?>
			<div class="boxheader"></div>
			<div class="box post" id="post-<?php the_ID(); ?>">
					<h2 class="title"><a title="Permanent Link to <?php the_title(); ?>" href="<?php the_permalink() ?>" rel="bookmark">
						<?php the_title(); ?></a>
					</h2>
					<div class="clear"></div>
					<div class="post-excerpt">
						<?php the_content('read more'); ?>
					</div>
					<div class="post-meta">						
						<span class="meta1">					
						category: <?php the_category(', ') ?>
						<br />
						<?php if (function_exists('the_tags')) { ?>
						<?php the_tags('Tags: ', ', '); ?>
						<?php } ?>
						</span>
						<span class="meta2">
							<?php the_time('j') ?> <?php the_time('M') ?>月 <?php the_time('Y') ?> by <a href="<?php bloginfo('url'); ?>" title="由 mak 发布" rel="author">mak</a>
						</span>
						<div class="clear"></div>
					</div>	
					
					<div class="post-detailed">
						 <?php if(function_exists('the_views')) { the_views(); } ?> | <?php comments_popup_link('0 comment', '1 comment', '% comments'); ?>
					</div>				
			</div>
			<div class="boxfooter"></div>
			