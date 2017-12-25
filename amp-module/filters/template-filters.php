<?php

/* Define SINGLE PATH CONSTANT */
function setTemplateDirectoryPath()
{
    if(!defined('AMP_TEMPLATEPATH'))
    {   
        if(isAmpVersion())
        {
            if(sopLodFile(get_template_directory() . DIRECTORY_SEPARATOR . 'amp'))
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
    return AMP_TEMPLATEPATH . 'index.php';
}


function ampPageTemplateFilter()
{
    global $wp_query, $post;
    $template = get_page_template_slug($post->ID);
    $template = !empty($template) ? $template : 'page.php';
    return AMP_TEMPLATEPATH . $template;
}


/* Filter Category Page Template */
function ampCategoryTemplateFilter()
{
    global $wp_query;
    $category = $wp_query->query['category_name'];

    if (locate_template('/amp/category-' . $category . '.php') != '') 
    {
        return AMP_TEMPLATEPATH . 'category-' . $category . '.php';
    }
    elseif(locate_template('amp/category.php'))
    {
        return AMP_TEMPLATEPATH . 'amp/category.php';
    }
    else
    {
        return plugin_dir_path(__DIR__) . DIRECTORY_SEPARATOR . 'theme' . DIRECTORY_SEPARATOR . 'category.php';
    }
}


/* Filter Single Page Template */
function ampSingleTemplateFilter($single)
{
    global $wp_query, $post;  
    $curauth = get_userdata($wp_query->post->post_author);
    
    add_filter('the_content', 'ampFilterCaller', 99);
    
    if (file_exists(AMP_TEMPLATEPATH . '/amp/single-author-' . $curauth->user_nicename . '.php'))
    {
        return AMP_TEMPLATEPATH . '/amp/single-author-' . $curauth->user_nicename . '.php';
    }
    elseif (file_exists(AMP_TEMPLATEPATH . '/amp/single-author-' . $curauth->ID . '.php'))
    {
        return AMP_TEMPLATEPATH . '/amp/single-author-' . $curauth->ID . '.php';
    }
    elseif (file_exists(AMP_TEMPLATEPATH . '/amp/single.php'))
    {
        return AMP_TEMPLATEPATH . '/amp/single.php';
    }
    else
    {
        return AMP_TEMPLATEPATH . '/single.php';
    }
}


/* Filter Archive Page Template */
function _cfAmpArchiveTemplateFilter($archive_template)
{
    global $wp_query, $archive;
    if(file_exists(AMP_TEMPLATEPATH . '/amp/archive.php'))
    {
        $archive_template = AMP_TEMPLATEPATH . '/amp/archive.php';
    }
    else
    {
        $archive_template = plugin_dir_path(__DIR__) . 'theme/archive.php';
    }
    return $archive_template;
}
