<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress AMP
 * @subpackage WordPress_AMP
 * @since WordPress AMP 1.0
 */

getAmpHeader();
?>

<div class="post-detail-wrapper">
    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="container">
            <div class="post-content-wrapper">
                <div class="post-detail-title">
                    <h1 class="uppercase entry-title" itemprop="headline"><?php the_title(); ?></h1>
                    <!-- Post Content Wrapper -->
                </div>
                <?php while (have_posts()) : the_post(); ?>
                <div class="post-summary-wrapper">
                    <div class="row-fluid">
                        <div class="span8">
                            <div class="clearfix">
                                <span class="right calendar">
                                    <i class="icons8-calendar-2"></i> 
                                    <?php echo get_the_time('F d,', $post->ID); ?>&nbsp;&nbsp;<?php echo get_the_time('Y', $post->ID); ?>
                                    <meta itemprop="datePublished" content="<?php echo get_the_time('Y-m-d', $post->ID); ?>"/> 
                                    <meta itemprop="dateModified" content="<?php echo get_the_time('Y-m-d', $post->ID); ?>"/>
                                </span>
                            </div>
                            <div class="post-detail-content">
                                <?php the_content(); ?>
                                <?php
                                  /*  wp_link_pages(array(
                                        'before' => '<div class="paging-wrap pagewrpNum"><div class="cus-paginate">' . __('Pages :'),
                                        'after' => '</div></div>',
                                        'next_or_number' => 'next_and_number', # activate parameter overloading
                                        'nextpagelink' => '',/* '<i class="icons8-right"></i>' */
                                       /*'previouspagelink' => '',/* '<i class="icons8-left"></i>' */
                                       /*'pagelink' => '%',
                                        'separator' => ' ',
                                        'link_before' => '<span>',
                                        'link_after' => '</span>',
                                        'echo' => 1,)
                                    );*/
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
                <!-- Post Content Wrapper End -->
            </div>
        </div>
    </div>
    <div class="container">
        <?php //comments_template(); ?>
    </div>
</div>
<?php getAmpFooter(); ?>
