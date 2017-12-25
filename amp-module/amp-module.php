<?php

/* Add AMP controller */
sopLodFile(dirname(__FILE__) . "/controller/AmpController.php");

/* Add AMP helper functions */
sopLodFile(dirname(__FILE__) . "/amp-helper.php");

/* Add AMP meta-boxes in POST interface */
sopLodFile(dirname(__FILE__) . "/meta-box.php");
$ampMetaBox = new ampMetaBox();

/* Add Filters to project */
sopLodFile(dirname(__FILE__) . "/filters/content-filters.php");
sopLodFile(dirname(__FILE__) . "/filters/template-filters.php");

/**
 * WordPress AMP admin settings 
 */
sopLodFile(dirname(__DIR__) . "/admin-module/settings-amp.php");


function scriptCheck()
{
    $scriptList = get_post_meta(get_the_ID(), 'amp_script_selection', true);

    if(!empty($scriptList))
    {
        if(isset($scriptList['haveCarousel']) && $scriptList['haveCarousel'] == 1)
        {
            ?>
            <script async custom-element="amp-carousel" src="https://cdn.ampproject.org/v0/amp-carousel-0.1.js"></script>
            <?php
        }

        if(isset($scriptList['haveInstagram']) && $scriptList['haveInstagram'] == 1)
        {
            ?>
            <script async custom-element="amp-instagram" src="https://cdn.ampproject.org/v0/amp-instagram-0.1.js"></script>
            <?php
        }
    }
}
add_action('amp_header', 'scriptCheck');






?>