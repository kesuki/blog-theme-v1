<?php
/*
Theme Name: mak
Version: 4
File Name: index.php
*/
?>
<?php get_header(); ?>
<div id="main">
	<div id="primary">
		<div id="content">
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