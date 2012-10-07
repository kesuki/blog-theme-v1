<?php
/*
Theme Name: theme
Version: 4
Template Name: query-posts
File Name: query-posts.php
*/
?>
<div class="post_related_l">
<h3>Most Popular</h3>
<ul>
<?php
$post_num = 3; // 数量设定.
$exclude_id = $post->ID;
$myposts = $wpdb->get_results("
  SELECT ID, post_title FROM $wpdb->posts
  WHERE ID != $exclude_id
  AND post_status = 'publish'
  AND post_type = 'post'
  ORDER BY comment_count
  DESC LIMIT $post_num
"); // get_results() since 0.71 /wp-includes/wp-db.php 
  foreach($myposts as $mypost) { ?>
    <li><a href="<?php echo get_permalink($mypost->ID); ?>"><?php echo mb_strimwidth($mypost->post_title, 0, 50, "..."); ?></a></li>
<?php
  $exclude_id .= ',' . $post->ID; // 记录文章 ID, 让 Related Posts 不重复.(单独使用可刪此行)
  }
?>
</ul>
</div>

<div class="post_related_r">
<h3>Related Posts</h3>
<ul>
<?php
$post_num = 3; // 数量设定.
//$exclude_id = $post->ID; // 单独使用要开此行
$posttags = get_the_tags(); $i = 0;
if ( $posttags ) { $tags = ''; foreach ( $posttags as $tag ) $tags .= $tag->name . ',';
$args = array(
	'post_status' => 'publish',
	'tag_slug__in' => explode(',', $tags), // 只选 tags 的文章.
	'post__not_in' => explode(',', $exclude_id), // 排除已出现过的文章.
	'caller_get_posts' => 1, // 排除置顶文章.
	'orderby' => 'comment_date', // 依评论日期排序.
	'posts_per_page' => $post_num
);
query_posts($args); // query_posts() since 2.0.0 /wp-includes/classes.php
 while( have_posts() ) { the_post(); ?>
    <li><a href="<?php the_permalink(); ?>"><?php echo mb_strimwidth(the_title(), 0, 50, "..."); ?></a></li>
<?php
    $exclude_id .= ',' . $post->ID; $i ++;
 } wp_reset_query();
}
if ( $i < $post_num ) { // 当 tags 文章数量不足, 再取 category 补足.
$cats = ''; foreach ( get_the_category() as $cat ) $cats .= $cat->cat_ID . ',';
$args = array(
	'category__in' => explode(',', $cats), // 只选 category 的文章.
	'post__not_in' => explode(',', $exclude_id),
	'caller_get_posts' => 1,
	'orderby' => 'comment_date',
	'posts_per_page' => $post_num - $i
);
query_posts($args);
 while( have_posts() ) { the_post(); ?>
    <li><a href="<?php the_permalink(); ?>"><?php echo mb_strimwidth(the_title(), 0, 50, "..."); ?></a></li>
<?php
    $i ++;
 } wp_reset_query();
}
if ( $i  == 0 )  echo '<li>unfortunately,Nothing Found!</li>';
?>
</ul>
</div>

<div class="clear"></div>