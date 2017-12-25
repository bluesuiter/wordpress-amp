<!doctype html>
<html amp lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php wp_title('|', true, 'right'); ?></title>
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1,user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    
    <?php _cfAmpHeader(); ?> 
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Lato:400,300,300italic,700&#038;subset=latin,latin-ext' type='text/css' media='all' />
    <?php require_once(get_template_directory() . 'style.php') ?>
  </head>
<body>
<amp-analytics config="https://www.googletagmanager.com/amp.json?id=GTM-NZ62P9P&gtm.url=SOURCE_URL" data-credentials="include"></amp-analytics>

    <!-- Navigation -->
    <amp-sidebar id='sidebar' layout='nodisplay' >
        <form class="menu-layer primary" action="/" target="_top">
            <button type="reset" class="close-button" id="menu-button" on='tap:sidebar.toggle'>Close</button>
            <div class="items sideNavi">
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
                            <label class="menu-item item-layer-2 has-sub-level"><input type="checkbox">Menu ABC
                                <div class="submenu menu-layer tertiary">
                                    <div class="return-button">Back</div>
                                    <button type="reset" class="close-button" id="menu-button" on='tap:sidebar.toggle'>X</button>
                                    <div class="items">
                                    <a class="menu-item item-layer-3" href="#" class="view-all-title">Menu Layer 2</a>
                                    </div>
                                </div>
                            </label>
                            <label class="menu-item item-layer-2 has-sub-level"><input type="checkbox">Menu XYZ
                                <div class="submenu menu-layer tertiary">
                                    <div class="return-button">Back</div>
                                    <button type="reset" class="close-button" id="menu-button" on='tap:sidebar.toggle'>X</button>
                                    <div class="items">
                                        <a class="menu-item item-layer-3" href="#" class="view-all-title">Menu Layer 2</a>
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
        <?php 
            $custom_logo_id = get_theme_mod('custom_logo');
            $logo = wp_get_attachment_image_src($custom_logo_id , 'full');
            $logo = !empty($logo) ? $logo[0] : get_template_directory_uri() . 'images/logo.png';
        ?>
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

    <!-- Navigation End -->
    
    <div class="page-main-container">
        <?php if(is_single()){ ?>
        <!--post-title-img-desktop-->
            <div id="mobile-post-title-img" class="post-title-img post-title-img-mobile"></div>
        <!--post-title-img-mobile-->
        <?php } ?>
    </div>
