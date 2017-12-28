<?php

/* Define SINGLE PATH CONSTANT */
function setTemplateDirectoryPath()
{
    if(!defined('AMP_TEMPLATEPATH'))
    {   
        if(isAmpVersion())
        {
            if(file_exists(get_template_directory() . DIRECTORY_SEPARATOR . 'amp'))
            {
                define('AMP_TEMPLATEPATH', get_template_directory() . DIRECTORY_SEPARATOR . 'amp' . DIRECTORY_SEPARATOR);
                define('AMP_TEMPLATEPATH', get_template_directory_uri() . DIRECTORY_SEPARATOR . 'amp' . DIRECTORY_SEPARATOR);
            }
            else
            { 
                define('AMP_TEMPLATEPATH', rtrim(plugin_dir_path(__DIR__), '/') . DIRECTORY_SEPARATOR . 'theme' . DIRECTORY_SEPARATOR);
                define('AMP_TEMPLATEURL', plugin_dir_url(__DIR__) . 'theme' . DIRECTORY_SEPARATOR);
            }
            add_filter('template_directory', function(){ return AMP_TEMPLATEPATH;});
            add_filter('template_directory_uri', function(){ return AMP_TEMPLATEURL;}); 
        }
    }
}


function getAmpHeader(){
    return require_once(AMP_TEMPLATEPATH . 'header.php');
}


function getAmpFooter(){
    return require_once(AMP_TEMPLATEPATH . 'footer.php');
}


/* Filter Page Template */
function ampTemplateFilter($type=false)
{
    if (file_exists(AMP_TEMPLATEPATH . 'index.php')) 
    {
        return AMP_TEMPLATEPATH . 'index.php';
    }
    else
    {
        return 'Index Template Not Found';
    }
}


/* Filter Page Template */
function ampPageTemplateFilter()
{
    global $wp_query, $post;
    $template = get_page_template_slug($post->ID);
    $template = !empty($template) ? $template : 'page.php';
    if (file_exists(AMP_TEMPLATEPATH . $template)) 
    {
        return AMP_TEMPLATEPATH . $template;
    }
    else
    {
        return 'Page Template Not Found';
    }    
}


/* Filter Category Page Template */
function ampCategoryTemplateFilter($template)
{
    global $wp_query;
    $category = $wp_query->query['category_name'];

    if (file_exists(AMP_TEMPLATEPATH . 'category-' . $category . '.php')) 
    {
        return AMP_TEMPLATEPATH . 'category-' . $category . '.php';
    }
    else if (file_exists(AMP_TEMPLATEPATH . 'category.php'))
    {
        return AMP_TEMPLATEPATH . 'category.php';
    }
    else
    {
        return 'Category Template Not Found';
    }
}


/* Filter Taxonomy Page Template */
function ampTaxonomyTemplateFilter($template)
{
    global $wp_query;
    $taxonomy = $wp_query->query['taxonomy'];

   if (file_exists(AMP_TEMPLATEPATH . 'taxonomy-' . $taxonomy . '.php') != '') 
    {
        return AMP_TEMPLATEPATH . 'taxonomy-' . $taxonomy . '.php';
    }
    else if(file_exists(AMP_TEMPLATEPATH . 'taxonomy.php'))
    {
        return AMP_TEMPLATEPATH . 'taxonomy.php';
    }
    else
    {
        return 'Taxonomy Template Not Found';
    }
}


/* Filter Single Page Template */
function ampSingleTemplateFilter($single)
{
    global $wp_query, $post;
    $curauth = get_userdata($wp_query->post->post_author);
    
    add_filter('the_content', 'ampFilterCaller', 99);
    
    if (file_exists(AMP_TEMPLATEPATH . 'single-author-' . $curauth->user_nicename . '.php'))
    {
        return AMP_TEMPLATEPATH . 'single-author-' . $curauth->user_nicename . '.php';
    }
    elseif (file_exists(AMP_TEMPLATEPATH . 'single-author-' . $curauth->ID . '.php'))
    {
        return AMP_TEMPLATEPATH . 'single-author-' . $curauth->ID . '.php';
    }
    elseif (file_exists(AMP_TEMPLATEPATH . 'single-' . $post->post_type . '.php'))
    {
        return AMP_TEMPLATEPATH . 'single-' . $post->post_type . '.php';
    }
    elseif (file_exists(AMP_TEMPLATEPATH . 'single.php'))
    {
        return AMP_TEMPLATEPATH . 'single.php';
    }
    else
    {
        return 'Single Template Not Found.';
    }
}


/* Filter Archive Page Template */
function _cfAmpArchiveTemplateFilter($archive_template)
{
    global $wp_query, $archive;
    if(file_exists(AMP_TEMPLATEPATH . 'archive.php'))
    {
        return AMP_TEMPLATEPATH . 'archive.php';
    }
    else
    {
        return 'Archive Template Not Found';
    }
}
