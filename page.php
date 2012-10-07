<?php
/*
Theme Name: theme
Version: 4
Template Name: page
File Name: page.php
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
			</div>
			<div class="boxfooter"></div>

			<div class="boxheader"></div>
			<div id="comments">
				<?php comments_template('', true); ?>
				<div class="clear"></div>
			</div>
			<div class="boxfooter"></div>
			<!--/my_comment -->
			
			<?php endwhile; ?>

		</div> <!-- #content -->
	</div>
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>

