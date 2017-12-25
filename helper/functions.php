<?php  

/**
 * Handles post data using this function
 */
if (!function_exists('handlePostData'))
{
    function handlePostData($key)
    {
        if (!is_array($key))
        {
            if (isset($_POST[$key]))
            {
                return htmlentities(trim($_POST[$key]));
            }
        }
        else
        {
            $out = [];
            foreach ($_POST as $k => $v)
            {
                $out[$k] = htmlentities(trim($v));
            }
            return $out;
        }
    }
}

/**
 * Include files using this function
 */
if(!function_exists('sopLodFile'))
{
    function sopLodFile($file)
    {
        try
        {
            if(file_exists($file))
            {
                require_once($file);
                return true;
            }
        }catch(Excepion $e)
        {
            echo 'Error : Function sopLodLib creating an error.';
            return false;
        }
    }
}


/* Handle Redirect Using JavaScript */
if (!function_exists('redirectPage'))
{
    function redirectPage($menu_slug)
    {
        echo '<script type="text/javascript">window.location="' . menu_page_url($menu_slug, false) . '";</script>';
    }
}


/* Handle WPDB ERROR*/
if(!function_exists('handleWpdbError'))
{
	function handleWpdbError($result, $module=false)
	{
		if(is_wp_error($result))
		{
			$error_string = $result->get_error_message();
			echo '<div id="message" class="error"><p>'.$module.': ' . $error_string . '</p></div>';
			return false;
		}
		return true;
	}
}

?>
