<?php

/**
 * Check if website is in AMP version 
 * */
if(!function_exists('isAmpVersion'))
{
    function isAmpVersion()
    {
        if(defined('AMP_VERSION'))
        {
            return AMP_VERSION;
        }
        return false;
    }
}



/** 
 * Pagination Function For AMP Page templates 
 * */
function implyPaginationPage($page, $nextPageCount)
{
    echo '<div class="paginationOuter">';
        /* Show Previous Link */
        if($page > 1 ){
            echo '<div class="previousPage"><a href="' . add_query_arg(array('amp' => '', 'page' => ($page - 1)), get_permalink()) . '">&laquo; Load Previous</a></div>';
        }
        
        /*Show Next Link*/
        if(count($nextPageCount) > 0 ){
            echo '<div class="nextPage"><a href="' . add_query_arg(array('amp' => '', 'page' => ++$page), get_permalink()) . '">Load Next &raquo</a></div>';
        }
    echo '</div>';
}



/**
 * Return the AMP/Non-Amp image tag
 * @attr array || Attributes required in image tag
 * */
function get_tagged_img($attr = array())
{
    $amp_status = get_option('site_amp_status');
    $out = '';

    if (!empty($attr))
    {
        foreach ($attr as $k => $v)
        {
            $out .= ' ' . $k . '="' . $v . '"';
        }

        if (isAmpVersion())
        {
            $out = '<amp-img ' . $out . '></amp-tag>';
        }
        else
        {
            $out = '<img ' . $out . '/>';
        }
    }
    return $out;
}



/**
 * Pagination Function For AMP Category and Home templates 
 * */
function implyPagination()
{
    ?>
    <div class="paginationOuter">
        <div class="previousPage"><?php previous_posts_link('Load Previous') ?></div>
        <div class="nextPage"><?php next_posts_link('Load Next') ?></div>
    </div>
    <?php
}



/* Permalink Filters and Functions (AMP) */

/**
* Flter for the category permalinks
* */
function _cfAmpCategroyPermalink($catId)
{
    $cat = get_category($catId);
    $current_url = trailingslashit(get_category_link($catId) . 'amp');
    return str_replace(site_url(), site_url() . '/' . $cat->taxonomy, $current_url);
}


/**
* Add slash to the URL if it is not there 
* */
function _cfAmpPermalinkFilter($url, $post, $leavename=false) {
    return trailingslashit($url . 'amp');
}

/* End - Permalink Filters and Functions (AMP) */