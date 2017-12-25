<?php

/**
* Main content filter for the AMP module
* Note: Disabling this will cause dis-appearign of content. 
* */
function ampFilterCaller($content)
{
    $args = ['image'  => '/<img[^>]+>/i', 
            'iframe'  => '/<iframe[^>]+><\/iframe>/isU'];
    $newContent = array();
    $count = -1;

    foreach($args as $k => $v)
    {
        $newContent[$k] = array();
        preg_match_all($v, $content, $res);
        array_push($newContent[$k], $res[0]);
    }

    if (!empty($newContent))
    {
        foreach ($newContent as $ky => $value)
        {
            $imgCnt = -1;   
            switch($ky)
            {
                case 'image':
                    foreach($value[0] as $k => $v)
                    {   
                        $attr = ['tabindex="'.$k.'"', 'on="tap:lightboxImagePopUp"', 'role="button"'];
                        $content = str_replace($v, ampContentImageTagReplacer($v, $attr), $content);                    
                    }                       
                    break;
                    
                case 'iframe':
                    foreach($value[0] as $k => $v)
                    {
                        $content = str_replace($v, ampIframeTagReplacer($v), $content);
                    }
                    break;               
            }
        }    
        
        /*/Caption Shortcode Replace Call */
        $content = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $content);
        $content = str_replace(['<p><strong><em>Article continues on the next page:</em></strong></p>', '<p><!--nextpage--></p>'], ['', ''], $content);         
        echo $content;    
    }
}



/**
 * Filter to replace
 * img tags to amp-img within the content 
 * */
function ampContentImageTagReplacer($value, $attr = array())
{
    if($value !== '')
    {
        $leftImage = str_replace('<img', '<amp-img', $value);
        if (substr($value, -2) == '/>')
        {
            $newImage = str_replace('/>', implode(' ', $attr) . ' layout="responsive"></amp-img>', $leftImage);
        }
        else
        {
            $newImage = str_replace('>', implode(' ', $attr) . ' layout="responsive"></amp-img>', $leftImage);
        }
        return $newImage;
    }
    else
    {
        echo 'NULL given expected String';
    }
}



/**
 * Replace iFrame Tags to amp-iframe 
 * defined within editor content
 * */
function ampIframeTagReplacer($value)
{
    if($value !== '')
    { 
       $value = str_replace('width="100%"', 'width="668"', $value);
       $leftIframe = str_replace('<iframe', '<amp-iframe layout="responsive" sandbox="allow-scripts allow-same-origin allow-popups"', $value);
       $newIframe = str_replace('iframe>', 'amp-iframe>', $leftIframe);
       return $newIframe;
    }
    else
    {
        echo 'NULL given expected String';
    }
}



/**
 * Remove anchor tag wrapped around
 * img tag defined within the editor's content 
 * */
function ampAttachmentAnchorRemoveFilter($content)
{
    $content = preg_replace(array('{<a[^>]*><img}', '{/></a>}'), array('<img', '/>'), $content);
    return $content;
}



/**
 * Replace Image Tags Defiend within 
 * [caption] Tags 
 * */
function ampCaptionTagReplacer($value)
{
    if($value != '')
    {
        (preg_match_all('/\[caption[^]]+(.*)\[\/caption]/', $value, $res));
        
        foreach($res[0] as $k => $v)
        {
            $newString = str_replace(['[caption ', ']'], ['<div class="caption-wrap" ', '>'], $v);
            $newString = preg_replace('/(<div.+?)width=(["\']?)\d*\2(.*?>)/', '$1$3', $newString);

            if(preg_match('/(<\/amp-img><\/a>(.*)\[\/caption)/', $newString))
            {
                $newString = str_replace(['</amp-img></a>', '[/caption'], ['</amp-img></a><p class="caption-text">', '</p></div'], $newString);
            }
            elseif(preg_match('/(<\/amp-img>(.*)\[\/caption])/', $value))
            {
                $newString = str_replace(['</amp-img>', '[/caption'], ['</amp-img><p class="caption-text">', '</p></div'], $newString);
            }

            $value = str_replace($v, $newString, $value);
        }
        return $value;
        exit;
    }
    else
    {
        return false;
    }
}



/**
 * Ignore the <!--nextpage--> for
 * content pagination. 
 * */
 function removeInPagePagination($post)
 {
     if (false !== strpos($post->post_content, '<!--nextpage-->')) 
     {
         /*Reset the global $pages:*/
         $GLOBALS['pages'] = [$post->post_content];
 
         /*Reset the global $numpages:*/
         $GLOBALS['numpages'] = 0;
 
        /*Reset the global $multipage:*/
         $GLOBALS['multipage'] = false;
     }
 }


function generateMenuItems($key, $finalNaveList, $menu, $lastNav){
    if($menu->menu_item_parent == $lastNav->ID){ 
        ?>
            <a class="menu-item item-layer-2" href="<?php echo $menu->url; ?>" title="<?php $menu->title ?>">
                <?php echo $menu->title ?>
            </a>
        <?php 
        if(isset($finalNaveList[$key + 1]) && $finalNaveList[$key + 1]->menu_item_parent == $lastNav->ID)
        {
            $menu = $finalNaveList[$key++];
            return generateMenuItems($key, $finalNaveList, $menu, $lastNav);
        }
        else
        {
            return;
        }
    }
}

function soShareFromInstagram($atts)
{
    ob_start();
    if(isset($atts['url']) && $atts['url'] != '')
    {
        $url = $atts['url'];
        $width = isset($atts['width']) ? $atts['width'] : '600';
        $height = isset($atts['height']) ? $atts['height'] : '450';
        $layout = isset($atts['layout']) ? $atts['layout'] : 'responsive';
        
        if(isAmpVersion())
        {
            $url = str_replace('/', '', (explode('/p/', $url)[1]));
            echo $result = '<amp-instagram data-shortcode="'. $url .'" width="'. $width .'" height="'. $height .'" layout="'. $layout .'"></amp-instagram>';
        }
        else
        {
            $url = "https://api.instagram.com/oembed/?url=" . $url;
            $url .= ($width) ? '&maxwidth='.$width : '';
            $result = json_decode(getCurlResult($url, 30));
            $result = explode('<script', $result->html);
            echo $result[0];
            $script = '<script' . $result[1];
            add_action('wp_footer', function()use($script){echo $script;});
        }    
    }
    return ob_get_clean();
}
add_shortcode('instagram', 'soShareFromInstagram');

 /**
  * 
  */
  function navigationCall($navMenu, $args=[])
  {
    $navMenu = wp_get_nav_menu_items($navMenu, $args);
    //pr($navMenu);
    $custom_logo_id = get_theme_mod('custom_logo');
    $logo = wp_get_attachment_image_src($custom_logo_id , 'full');
    $logo = !empty($logo) ? $logo[0] : get_template_directory_uri() . 'images/logo.png';

    add_filter('page_link', function($pageId){ trailingslashit(get_page_link($pageId) . 'amp');});
    ?>
    <amp-sidebar id='sidebar' layout='nodisplay' >
        <form class="menu-layer primary" action="/" target="_top">
            <button type="reset" class="close-button" id="menu-button" on='tap:sidebar.toggle'>Close</button>
            <div class="items sideNavi">
            <?php
                $finalNaveList = [];
                $counter = 0;
                if(!empty($navMenu)){
                    foreach($navMenu as $menu){
                        $parent = $menu->menu_item_parent;
                        {
                            $finalNaveList[] = $menu;
                        }
                    }
                    //pr($finalNaveList);
                    $lastNav = '';
                    foreach($finalNaveList as $key => $menu){
                        $parent = $menu->menu_item_parent;
                        if(!empty($lastNav)){
                            if($parent == 0){
                                ?>
                                <a href="<?php echo $lastNav->url; ?>" class="menu-item item-layer-3">
                                    <?php echo $lastNav->title ?>
                                </a>
                                <?php
                            }
                            else if($parent != 0)
                            {
                                ?>
                                <label class="menu-item item-layer-1 has-sub-level active"><input type="checkbox">
                                    <?php echo $lastNav->title ?>
                                    <div class="submenu menu-layer secondary">
                                        <div class="return-button">Back</div>
                                        <button type="reset" class="close-button" id="menu-button" on='tap:sidebar.toggle'>X</button>
                                        <div class="items">                                        
                                            <?php generateMenuItems($key, $finalNaveList, $menu, $lastNav) ?>
                                        </div>
                                    </div>                                    
                                </label>
                                <?php
                            }
                        }
                        $lastNav = $menu;                       
                    }                 
                }
            ?>
            <?php 
                //pr($finalNaveList);
                // foreach($finalNaveList as $navItem){
                //     $navMenu
                // }

            ?>
            <a href="<?php echo site_url('/amp'); ?>" class="menu-item item-layer-3">Home</a>
            <label class="menu-item item-layer-1 has-sub-level active"><input type="checkbox">
                Most Read
                <div class="submenu menu-layer secondary">
                
                    <div class="return-button">Back</div>
                    <button type="reset" class="close-button" id="menu-button" on='tap:sidebar.toggle'>X</button>
                
                    <div class="items">
                        <a class="menu-item item-layer-2"  href="" title="">Menu Layer One</a>
                    </div>
                </div>
                </label>
                <label class="menu-item item-layer-1 has-sub-level"><input type="checkbox">
                Categories List
                <div class="submenu menu-layer secondary">
                    <div class="return-button">Back</div>
                    <button type="reset" class="close-button" id="menu-button" on='tap:sidebar.toggle'>X</button>
                    <div class="items">
                        <li>
                            <ul class="level1">
                                <li>
                                    <a href="#">Category 1</a>
                                </li>
                                <li>
                                <a href="#">Category 2</a>
                                </li>
                            </ul>
                        </li>
                        <br/><br/>
                    </div>
                </div>
                </label>
                <a class="menu-item item-layer-3" href="#" title="page-1">Page 1</a>
                <a class="menu-item item-layer-3" href="#" title="page-2">Page 2</a>
                <a class="menu-item item-layer-3" href="#" title="page-3">Page 3</a>
                <label class="menu-item item-layer-1 has-sub-level active"><input type="checkbox">
                Shop
                <div class="submenu menu-layer secondary">
                    <div class="return-button">Back</div>
                    <button type="reset" class="close-button" id="menu-button" on='tap:sidebar.toggle'>X</button>
                    <div class="items">
                        <label class="menu-item item-layer-2 has-sub-level"><input type="checkbox">Luxury &amp; Premium Brands
                            <div class="submenu menu-layer tertiary">
                                <div class="return-button">Back</div>
                                <button type="reset" class="close-button" id="menu-button" on='tap:sidebar.toggle'>X</button>
                                <div class="items">
                                    <a class="menu-item item-layer-3" href="<?php echo $shop_URL; ?>/brands.html" class="view-all-title">View All</a>
                                </div>
                            </div>
                        </label>
                        <label class="menu-item item-layer-2 has-sub-level"><input type="checkbox">Online Boutiques
                            <div class="submenu menu-layer tertiary">
                                <div class="return-button">Back</div>
                                <button type="reset" class="close-button" id="menu-button" on='tap:sidebar.toggle'>X</button>
                                <div class="items">
                                    <a class="menu-item item-layer-3" href="<?php echo $shop_URL; ?>/brands.html" class="view-all-title">View All</a>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>
                </label>
            </div>
        </form>
        </amp-sidebar>
    <nav>
    <button class="tab hamburger" id="menu-button" on='tap:sidebar.toggle'>=</button>
     <a class="brandLogo" href="<?php echo site_url('/amp'); ?>">
        <amp-img width="322" height="32" layout="responsive" src="<?php echo $logo; ?>"></amp-img>
    </a>
    
	<p class="search-holder" on="tap:search-blog" role="button" tabindex="frmsrch1"><span class="searchbox-icon"></span></p>
    <amp-lightbox id="search-blog" layout="nodisplay" class="search-popup" scrollable>
      <div class="search-popup-main">
        <span on="tap:search-blog.close" role="button" tabindex="frmsrch1"><amp-img width="28" height="28" layout="responsive" src="<?= get_template_directory_uri(); ?>/images/close.svg"></amp-img></span>
          <div class="lightbox">
            <form method="GET" class="p2" action="<?= site_url() ?>" target="_top">
              <div class="ampstart-input inline-block relative mb3">
                <input type="search" placeholder="Search..." name="s">
              </div>
              <input type="submit" value="Search" class="ampstart-btn caps uppercase">
            </form>
          </div>
      </div>
    </amp-lightbox>
   <!-- <div id="closemenu">&#215;</div>-->
  </nav>
    <?php
  }