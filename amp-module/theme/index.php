<?php
/**
 * The main template file
 * 
 * @package WordPress AMP
 * @subpackage WordPress_AMP
 * @since WordPress AMP 1.0
**/
getAmpHeader();
$currentPage = $page = get_query_var('paged');

$featuredPostId = get_option('wpAmpHomePageMainPost');
if(get_query_var('paged') <= 1 && !empty($featuredPostId))
{
    $largeImage = wp_get_attachment_image_src(get_post_thumbnail_id($featuredPostId), 'full')[0];
    $postTitle = get_the_title($featuredPostId);   
    ?>

  <div class="full-width position-relative">
    <a href="<?php echo get_permalink($featuredPostId) ; ?>">
        <?php 
            $args = ['width' => 750, 'height' => 800, 'layout' => 'responsive', 
                  'src' => ($largeImage), 'alt' => $postTitle];
        ?>
        <?php echo get_tagged_img($args); ?>
    </a>
    <div class="post-content position-bottom">
      <div class="post-title">
        <a href="<?php echo get_permalink($featuredPostId) ?>" title="<?php echo $postTitle ?>"><?php echo $postTitle ?></a>
      </div>
    </div>
  </div>
  <?php
}

$args = array('post_type' => 'post', 'cat' => -10, 'post_status' => 'publish', 'posts_per_page' => 10,
'orderby' => 'post_date', 'order' => 'DESC', 'post__not_in' => [$featuredPostId], 'fields' => 'ids', 'paged' => $page);
$wp_query = new WP_Query($args);
?>
    <div class="post-wrapper">
      <div class="wrapper" id="post-grid-home">
        <div class="full-width">
          <?php
            $startPoint = 0;
            while($wp_query->have_posts()) : the_post();
              $postId = get_the_ID();
              $postTitle = get_the_title($postId);
              $largeImage = wp_get_attachment_image_src(get_post_thumbnail_id($postId), 'full')[0];
              $permalink = get_permalink($postId);
          ?>
            <div class="post-box col-2">
              <a href="<?php echo $permalink ; ?>">
                <amp-img alt="<?php echo $postTitle ?>" width="610" height="610" layout="responsive" src="<?php echo ($largeImage) ?>"></amp-img>
              </a>
              <div class="post-content">
                <div class="post-title-top-box">
                  <?php echo get_the_date('d.m.y', $postId); ?>
                </div>
                <div class="post-title">
                  <a href="<?php echo $permalink ; ?>">
                    <?php echo $postTitle ?>
                  </a>
                </div>
              </div>
            </div>
            <?php
        $startPoint++;
        if($startPoint == 2)
        {
            $startPoint = 0;
            echo '</div><div class="full-width">';
        }
      endwhile;
    ?>
    </div>
  </div>
<?php getAmpFooter(); ?>