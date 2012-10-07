<?php
/*
Theme Name: mak
Version: 4
File Name: single.php
*/
?>
<?php get_header(); ?>
<div id="main">
	<div id="primary">
		<div id="content">
			<?php while ( have_posts() ) : the_post(); ?>
			<div class="boxheader"></div>
			<div class="box post" id="post-<?php the_ID(); ?>">
					<h2 class="title"><a title="Permanent Link to <?php the_title(); ?>" href="<?php the_permalink() ?>" rel="bookmark">
						<?php the_title(); ?></a>
					</h2>
					<!--/post-title -->
					<div class="clear"></div>
					<!--/post-date -->
					<div class="post-content">
						<?php the_content(); ?>
					</div>
					
					<div class="post-detailed">
						 <?php if(function_exists('the_views')) { the_views(); } ?> | <?php comments_popup_link('0 comment', '1 comment', '% comments'); ?>
					</div>
					
					<div class="post-meta">						
						<span class="meta1">					
						category: <?php the_category(', ') ?>
						<br>
						<?php if (function_exists('the_tags')) { ?>
						<?php the_tags('Tags: ', ', '); ?>
						<?php } ?>
						</span>
						<!--/post-tags -->
						<span class="meta2">
							<?php the_time('j') ?> <?php the_time('M') ?>月 <?php the_time('Y') ?> by <a href="<?php bloginfo('url'); ?>" title="由 mak 发布" rel="author">mak</a>
						</span>
						
						<div class="clear"></div>
						<div class="post_related">
							<?php include(TEMPLATEPATH . '/query-posts.php'); ?>
						</div>
						<!--/post_related -->
						
						<div class="nav_below">
							<div class="nav-previous"><?php previous_post_link('&laquo; previous %link'); ?></div>
							<div class="nav-next"><?php next_post_link('%link next &raquo;'); ?></div>
							<div class="clear"></div>
						</div>
						<!--/navigation -->
						<div class="clear"></div>
					</div>	
					<!--/post-commets -->

			</div><!--/box -->
			<div class="boxfooter"></div>
			
			<div class="boxheader"></div>
			<div id="comments">
					<?php comments_template('', true); ?>
					<div class="clear"></div>
			</div>
			<div class="boxfooter"></div>
			<!--/my_comment -->

			<?php endwhile; ?>
		</div><!-- #content -->
	</div><!-- #primary -->
<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>