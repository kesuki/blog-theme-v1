<?php
/*
Theme Name: mak
Version: 4
File Name: archive.php
*/
?>
<?php get_header(); ?>
<div id="main">
	<div id="primary">
		<div id="content">
			<div class="boxheader"></div>
			<div class="box">
				<h3 style="padding-left:12px;">
				<?php if ( is_tag() ) : ?>
					<?php printf( __( '标签: %s' ), '<span>' . single_tag_title( '', false ) . '</span>' ); ?>
				<?php elseif ( is_category() ) : ?>
					<?php printf( __( '分类: %s' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?>
				<?php else : ?>
					<?php _e( 'Blog Archives' ); ?>
				<?php endif; ?>
				</h3>
			</div>
			<div class="boxfooter"></div>
			
			<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'content', get_post_format() ); ?>
			<?php endwhile; ?>
		
			<?php  if ( $wp_query->max_num_pages > 1 ) : ?>
				<div id="wp-pagenavi"> 
						<?php pagenavi(); ?>
					</div>
			<?php endif; ?>
		
		</div><!-- #content -->
	</div><!-- #primary -->
<?php get_sidebar(); ?>
</div><!-- #main -->
<?php get_footer(); ?>

