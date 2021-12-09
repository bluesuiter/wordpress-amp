<?php

/**
 * Handling request to detect (AMP/Non-AMP) 
 * */
function checkAmp()
{
    global $wp_query, $wp;
    if(isset($wp_query->query) && array_key_exists('amp', $wp_query->query))
    {
        if(!defined('AMP_VERSION'))
        {
            define('AMP_VERSION', true);    
            setTemplateDirectoryPath();
        }

        add_filter('post_link', '_cfAmpPermalinkFilter', 10, 3);
        add_filter('page_link', '_cfAmpPermalinkFilter', 10, 3);

        /*Remove the reponsive stuff from the content*/
        remove_filter('the_content', 'removeContentImagesResponsiveCode');
        add_filter('the_content', 'ampAttachmentAnchorRemoveFilter');
        add_action('the_post', 'removeInPagePagination', 99);

        if(is_category() || is_tax())
        {
            add_filter('category_template', 'ampCategoryTemplateFilter', 10, 1); 
            add_filter('taxonomy_template', 'ampCategoryTemplateFilter', 10, 1);
        }
        else if(is_page())
        {
            add_filter('page_template', 'ampPageTemplateFilter'); 
        }
        else if(is_single())
        {
            add_filter('single_template', 'ampSingleTemplateFilter');
        }
        else if(is_front_page())
        {
            add_filter('home_template', 'ampTemplateFilter');       
        }
        else
        {           
            wp_redirect(str_replace(['amp/', 'amp'], ['', ''], home_url($wp->request)));
            ob_end_flush();
        }
    }
    else
    {
        //ob_end_flush();
        //add_filter('single_template', 'nonAmpSingleTemplate');
        add_action('wp_head', 'cfAmpHtmlUrl');
    }
}
add_action('parse_query', 'checkAmp');


/* Function return canonical URL
 * URL is added in headers of amp-pages*/
function cfAmpHtmlUrl()
{
    global $wp;
	$current_url = "";
	
	if(is_home())
	{
    	$current_url = trailingslashit(home_url(add_query_arg(array(), 'amp'. DIRECTORY_SEPARATOR . $wp->request))); 
		$current_url = '<link rel="amphtml" href="'. $current_url .'" />';
	}
	else if(is_single() || is_page())
	{
		$current_url = trailingslashit(home_url(add_query_arg(array(), $wp->request . DIRECTORY_SEPARATOR . 'amp'))); 
		$current_url = '<link rel="amphtml" href="'. $current_url .'" />';	
    }
    else if(is_category() || is_tax())
    {
        $current_url = trailingslashit(home_url(add_query_arg(array(), $wp->request . DIRECTORY_SEPARATOR . 'amp'))); 
        $current_url = str_replace(site_url(), site_url() . DIRECTORY_SEPARATOR . 'category', $current_url);
		$current_url = '<link rel="amphtml" href="'. $current_url .'" />';	
    }
    echo $current_url;
}


function wordpressAmpAdmin()
{
    $objSettingsAmp = new SettingsAmp();
    add_action('admin_menu', array($objSettingsAmp, 'addSettingAmpMenu'));
}


/**
* Filter the Single Templates (Non-AMP Version)
* */
function nonAmpSingleTemplate($single)
{
    global $wp_query, $post;

    /* Checks for single template by author
    * Check by user nicename and ID */
    $curauth = get_userdata($wp_query->post->post_author);

    if (file_exists(AMP_TEMPLATEPATH . DIRECTORY_SEPARATOR . 'single-author-' . $curauth->user_nicename . '.php'))
    {
        return AMP_TEMPLATEPATH . DIRECTORY_SEPARATOR . 'single-author-' . $curauth->user_nicename . '.php';
    }
    elseif (file_exists(AMP_TEMPLATEPATH . DIRECTORY_SEPARATOR . 'single-author-' . $curauth->ID . '.php'))
    {
        return AMP_TEMPLATEPATH . DIRECTORY_SEPARATOR . 'single-author-' . $curauth->ID . '.php';
    }
    else
    {
        return AMP_TEMPLATEPATH . DIRECTORY_SEPARATOR . 'single.php';
    }
}


/*
*/
function getMostReadPostsLastDays($days, $page=0){
	global $wpdb;
	$table 				= $wpdb->prefix . 'posthit_count';
	$days 				= $days;
	$records_per_page 	= 12;
    $offset 			= 0;
    
    if($page !=0)
    {
        $offset 	= $records_per_page * ($page - 1);
    }
	
	$sql = "SELECT DISTINCT(post_id), SUM(hit_count) as hit FROM $table WHERE 1 AND hit_date BETWEEN CURDATE() - INTERVAL $days DAY AND CURDATE() GROUP BY post_id ORDER BY hit DESC LIMIT $offset, $records_per_page";
	$res = $wpdb->get_results($sql);
    
    foreach ($res as $key => $value){
        $result[$id] = $value->post_id;
        ++$id;
    }
    return $result;
}



/**
 *  Frontpage and Blog page check from reading settings.
 * */
function wordpressAmpBlogPage() {
	$page_for_posts = get_option('page_for_posts');
	$post = get_post($page_for_posts); 
	if ($post) {
		$slug = $post->post_name;
		return $slug;
	}
}


function wordpressAmpCustomPostPage() {
	$front_page_type = get_option('show_on_front');
	if ($front_page_type) {
		return $front_page_type;
	}
}


function wordpressAmpGetBlogPageId(){
	$page = "";
	$output = "";
	if (wordpressAmpBlogPage()) {
		$page = get_page_by_path(wordpressAmpBlogPage());
		$output = $page->ID;
	}

	return $output;
}

/**
 * Add Custom Rewrite Rule to make sure pagination & redirection is working correctly 
 * */
function wordpressAmpCustomRewriteRules() {
    add_rewrite_endpoint('amp', EP_ALL | EP_PAGES | EP_PERMALINK | EP_AUTHORS  | EP_ALL_ARCHIVES);        
    
    /** For Homepage */
    add_rewrite_rule('amp/?$', 'index.php?amp', 'top');

	/* For Homepage with Pagination */
    add_rewrite_rule('amp/page/([0-9]{1,})/?$', 'index.php?amp&paged=$matches[1]', 'top');

    add_rewrite_rule(wordpressAmpBlogPage(). '/amp/page/([0-9]{1,})/?$',
        'index.php?amp=0&paged=$matches[1]&page_id=' .wordpressAmpGetBlogPageId(),
        'top'
    );

    /* For Author pages */
    add_rewrite_rule('author\/([^/]+)\/amp\/?$',
                    'index.php?amp&author_name=$matches[1]', 'top');

    add_rewrite_rule('author\/([^/]+)\/amp\/page\/?([0-9]{1,})\/?$',
                    'index.php?amp=1&author_name=$matches[1]&paged=$matches[2]', 'top');

    /* For category pages */
    $rewrite_category = get_option('category_base'); 
    if (!empty($rewrite_category)) {
    	$rewrite_category = get_option('category_base');
    } else { 
    	$rewrite_category = 'category';
    }

    add_rewrite_rule($rewrite_category.'\/(.+?)\/amp/?$', 
                    'index.php?amp&category_name=$matches[1]', 'top');
    
    /* For category pages with Pagination */
    add_rewrite_rule($rewrite_category.'\/(.+?)\/amp\/page\/?([0-9]{1,})\/?$',
                    'index.php?amp&category_name=$matches[1]&paged=$matches[2]', 'top');

    /* For tag pages */
	$rewrite_tag = get_option('tag_base');
    if (! empty($rewrite_tag)) {
    	$rewrite_tag = get_option('tag_base');
    } else {
    	$rewrite_tag = 'tag';
    }

    add_rewrite_rule($rewrite_tag.'\/(.+?)\/amp/?$', 
                    'index.php?amp&tag=$matches[1]', 'top');
    
    /* For tag pages with Pagination */
    add_rewrite_rule($rewrite_tag.'\/(.+?)\/amp\/page\/?([0-9]{1,})\/?$',
                    'index.php?amp&tag=$matches[1]&paged=$matches[2]', 'top');
    
	/* Rewrite rule for custom Taxonomies */
	$args = array('public' => true, '_builtin' => false); 
	$output = 'names'; // or objects
	$operator = 'and'; // 'and' or 'or'
	$taxonomies = get_taxonomies($args, $output, $operator); 
	if ($taxonomies) {
	  foreach ($taxonomies as $taxonomy) {	   
	    add_rewrite_rule(
	      $taxonomy.'\/(.+?)\/amp/?$',
	      'index.php?amp&'.$taxonomy.'=$matches[1]',
	      'top'
	    );
	    /* For Custom Taxonomies with pages */
	    add_rewrite_rule(
	      $taxonomy.'\/(.+?)\/amp\/page\/?([0-9]{1,})\/?$',
	      'index.php?amp&'.$taxonomy.'=$matches[1]&paged=$matches[2]',
	      'top'
	    );
	  }
    }
}
add_action( 'init', 'wordpressAmpCustomRewriteRules', 99);


function _cfAmpHeader()
{
    global $wp;
    $current_url = str_replace(array('amp/','amp'), array('',''), remove_query_arg(array('page'), get_permalink())); 
    ?>
        <link rel="canonical" href="<?php echo $current_url; ?>" />
        <style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
        
        <script async src="https://cdn.ampproject.org/v0.js"></script>
        <script async custom-element="amp-lightbox" src="https://cdn.ampproject.org/v0/amp-lightbox-0.1.js"></script>
        <script async custom-element="amp-sidebar" src="https://cdn.ampproject.org/v0/amp-sidebar-0.1.js"></script>
        <script async custom-element="amp-form" src="https://cdn.ampproject.org/v0/amp-form-0.1.js"></script>
        <script async custom-template="amp-mustache" src="https://cdn.ampproject.org/v0/amp-mustache-0.1.js"></script>
        <?php /*<script async custom-element="amp-fit-text" src="https://cdn.ampproject.org/v0/amp-fit-text-0.1.js"></script>*/ ?>
        <script async custom-element="amp-accordion" src="https://cdn.ampproject.org/v0/amp-accordion-0.1.js"></script>
        <script async custom-element="amp-image-lightbox" src="https://cdn.ampproject.org/v0/amp-image-lightbox-0.1.js"></script>
        <script async custom-element="amp-iframe" src="https://cdn.ampproject.org/v0/amp-iframe-0.1.js"></script>
        <script async custom-element="amp-analytics" src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js"></script>
    <?php   
    do_action('amp_header');
}


function genreateGACode()
{
    $gaCode = get_option('wpAmpGaCodeValue');
    if(empty($gaCode)){
        return false;
    }
    ?>
    <amp-analytics type="googleanalytics">
        <script type="application/json">
            {
            "vars": {
                "account": "<?php echo $gaCode ?>"
            },
            "triggers": {
                "trackPageview": {
                "on": "visible",
                "request": "pageview"
                }
            }
            }
        </script>
    </amp-analytics>
    <?php
}


function _cfAmpFooter()
{
    ?>
        <amp-image-lightbox id="lightboxImagePopUp" layout="nodisplay"></amp-image-lightbox>
        <amp-lightbox id="lightboxPopUp" layout="nodisplay"></amp-lightbox>
    <?php
    genreateGACode();
    do_action('amp_footer');
}


/** 
 * Returns Google Structured Data for a page/post
 * */
function _cfGetStructuredData()
{
    ?>
    <script type="application/ld+json">
        {
            "@context": "http://schema.org",
            "@type": "Article",
            "headline": "<?php echo get_the_title() ?>",
            "datePublished": "<?php echo get_the_date(); ?>",
            "dateModified": "<?php echo get_the_modified_date() ?>",
            "image": {
                        "@type": "ImageObject",
                        "url": "<?php echo get_template_directory_uri(); ?>/images/logo.png",
                        "height": "32",
                        "width": "322"
                    },
            "author": "",
            "mainEntityOfPage": "<?php echo str_replace(['amp/', 'amp'], ['', ''], get_permalink()); ?>",
            "publisher": {
                    "@type": "Organization",
                    "name": "",
                    "logo": {
                        "@type": "ImageObject",
                        "url": "<?php echo get_template_directory_uri(); ?>/images/logo.png"
                    }
            }
        }
    </script>
    <?php
}



/*
function remove_all_theme_styles() 
{  
    global $wp_styles;
    $wp_styles->queue = array();
}


function ampRunCheck()
{
    $amp_status = get_option('site_amp_status');
    //if ($amp_status == 'false' && $GLOBALS['pagenow'] !== 'wp-login.php' && !is_admin())
    {
        wp_deregister_script('jquery');
        wp_deregister_script('jquery-migrate');
        wp_deregister_script('wp-embed');
        wp_deregister_script('comment-reply');
        
        remove_action( 'wp_head', 'rsd_link' );
        remove_action( 'wp_head', 'wlwmanifest_link' );
        remove_action( 'wp_head', 'wp_generator' );
        remove_action( 'wp_head', 'start_post_rel_link' );
        remove_action( 'wp_head', 'index_rel_link' );
        remove_action( 'wp_head', 'adjacent_posts_rel_link' );
        remove_action( 'wp_head', 'wp_shortlink_wp_head' );

        add_action('wp_print_styles', 'remove_all_theme_styles', 100);
        add_action('wp_head', 'ampSupportScript');
        
        // Remove the reponsive stuff from the content
        remove_filter('the_content', 'wp_make_content_images_responsive');
        
        // Remove the REST API endpoint.
        remove_action('rest_api_init', 'wp_oembed_register_route');
        
        // Turn off oEmbed auto discovery.
        add_filter('embed_oembed_discover', '__return_false');
        
        // Don't filter oEmbed results.
        remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );
        
        // Remove oEmbed discovery links.
        remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
        
        // Remove oEmbed-specific JavaScript from the front-end and back-end.
        remove_action( 'wp_head', 'wp_oembed_add_host_js' );
        
        // Remove all embeds rewrite rules.
        add_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' );

        //Shortlink Removal
        remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
        //add_action('comment_form_after', 'commentFormFilter');

        /*Add Required Div To Footer*//*
        add_action('wp_footer', 'requiredElements');
    }
}*/
/*
function theCommentsList($comment, $args, $depth)
{
    $GLOBALS['comment'] = $comment;
    switch ($comment->comment_type) :
    case 'pingback' :
    case 'trackback' :
        // Display trackbacks differently than normal comments.
        ?>
        <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
            <p> 
                <?php _e('Pingback:', 'twentytwelve'); ?> <?php comment_author_link(); ?>
                <?php edit_comment_link(__('(Edit)', 'twentytwelve'), '<span class="edit-link">', '</span>'); ?>
            </p>
        </li>
            <?php
            break;
        default :
            /*Proceed with normal comments.*//*
            global $post;
            ?>
        <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
            <article id="comment-<?php comment_ID(); ?>" class="comment">
                <header class="comment-meta comment-author vcard">
                    <div class="alignleft commentAvatar">
                        <?php echo ampImageTagReplacer(get_avatar($comment, 44)); ?>
                    </div>
                    <div class="alignleft commentContent">
                        <?php
                        printf('<cite><b class="fn">%1$s</b> %2$s</cite>', get_comment_author_link(),
                                // If current post author is also comment author, make it known visually.
                                ( $comment->user_id === $post->post_author ) ? '<span>' . __('Post author', 'twentytwelve') . '</span>' : ''
                        );
                        printf('<a href="%1$s"><time datetime="%2$s">%3$s</time></a>', esc_url(get_comment_link($comment->comment_ID)), get_comment_time('c'),
                                /* translators: 1: date, 2: time *//* sprintf(__('%1$s at %2$s', 'twentytwelve'), get_comment_date(), get_comment_time())
                        );
                        ?>

                            <?php if ('0' == $comment->comment_approved) : ?>
                            <section class="comment-content comment-moderation-content">
                                <p class="comment-awaiting-moderation">
                                    <?php _e('Your comment is awaiting moderation.', 'twentytwelve'); ?>
                                </p>
                            </section>
                        <?php endif; ?>

                        <section class="comment-content comment">
                            <?php comment_text(); ?>
                            <?php edit_comment_link(__('Edit', 'twentytwelve'), '<p class="edit-link">', '</p>'); ?>
                        </section><!-- .comment-content -->

                        <div class="reply">
                            <?php comment_reply_link(array_merge($args, array('reply_text' => __('Reply', 'twentytwelve'), 'after' => ' <span>&darr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
                        </div><!-- .reply -->
                    </div>
                </header><!-- .comment-meta -->
            </article><!-- #comment-## -->
        </li>
            <?php
            break;
    endswitch; // end comment_type check
}*/
