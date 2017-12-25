<?php
/*
  Plugin Name: Wordpress AMP
  Plugin URI: https://github.com/bluesuiter/wordpress-amp
  Description: Plugin for making website AMP compatible.
  Author: BlueSuiter
  Version: 1.12.17
  Author URI:
 */

/*Stop direct access of the file*/
if (!defined('ABSPATH'))
{
    die();
}

/* Functions added for support */
if(file_exists(dirname(__FILE__) . "/helper/functions.php"))
{
    require_once(dirname(__FILE__) . "/helper/functions.php");
}
else
{
    echo (dirname(__FILE__) . "/helper/functions.php" . ' not exist.');
    die;
}


/**
 *  Functions Responsible for filtering returning data
 * While AMP is on for (Work in Mobile version of site)
 */
sopLodFile(dirname(__FILE__) . "/amp-module/amp-module.php");
wordpressAmpAdmin();