<?php
/**
 * The template for displaying Category pages
 *
 * Used to display archive-type pages for posts in a category.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress AMP
 * @subpackage Wordpress_AMP
 * @since WordPress AMP 1.0
 */
 
get_header('amp');
$category = $wp_query->queried_object;
$count = 0;
?>
<div class="full-width">
	<div class="page-title">
		<h1><?php echo $category->name ?></h1>
	</div>
	<div class="post-division full-width">
		<?php
		$query_args = array('category_name' => $category->slug, 'post_status' => 'publish', 'paged' => get_query_var('paged'), 'posts_per_page' => 10);
		$the_query = new WP_Query( $query_args );
		
		$divCounter = 0;
		$totalPost  = $the_query->post_count;

		while ($the_query->have_posts()) : $the_query->the_post();
			$postTitle = get_the_title();
			$postUrl = get_permalink(); 
			$postImage = get_the_post_thumbnail_url();
			
			echo ($divCounter%2==0 ? '</div><div class="post-division full-width">':''); 
		?>
			<div class="post-box">
				<a class="post-box" href="<?php echo $postUrl ?>">
					<amp-img src="<?php echo $postImage ?>" height="610" width="610" layout="responsive"></amp-img>
				</a>
				<div class="post-content">
					<div class="post-title-top-box"><?php echo get_the_date('d.m.y', $post->ID); ?></div>
					<a class="post-title" href="<?php echo $postUrl ?>"> <?php echo $postTitle ?></a>
					<p class="post-exceprt"><?php echo get_custom_excerpt($post->ID, 135); ?></p>
					<span class="read-more">
						<a href="<?php echo $postUrl ?>" class>Read more<i class="icons8-play"></i></a>
					</span>
				</div>
			</div>
		<?php 
			$divCounter++;
			$count++;
			endwhile; 
			/*Close `.post-division` class div*/
			if($divCounter <= $totalPost){
				echo '</div>';
			}
		?>
	</div>
    <?php implyPagination(); ?>
</div>
<?php get_footer('amp'); ?>
