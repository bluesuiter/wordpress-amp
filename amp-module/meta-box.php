<?php

class ampMetaBox
{
    public function __construct()
    {
        add_action('add_meta_boxes', [$this, 'callMetaBox']);
        add_action('save_post', [$this, 'ampSaveMetaBox']);
    }


    public function callMetaBox()
    {
        $id = "ampScriptExclusion";
        $title = "Select AMP Script";
        $callback = array($this, "ampMetaBoxTemplate");
        $screen = array('post');
        $context = "side";
        $priority = 'default';

        add_meta_box($id, $title, $callback, $screen, $context, $priority);      
    }


    public function ampMetaBoxTemplate($post)
    {
        /* Add an nonce field so we can check for it later.*/
        wp_nonce_field('amp_meta_box_keyCode', 'amp_meta_box_nonce');

        $value = get_post_meta($post->ID, 'amp_script_selection', true);
        ?>
        <div id="ampmetabox">
            <p>
                <input type="checkbox" <?php if(isset($value['haveCarousel']) && $value['haveCarousel'] == 1){echo 'checked';} ?> id="haveCarousel" name="haveCarousel" value="1"/>
                <label for="haveCarousel">Carousel Script</label>                
                <i class="dashicons dashicons-info" title="Check if post have Carousel on it."></i>
            </p>
            <p>
                <input type="checkbox" <?php if(isset($value['haveInstagram']) && $value['haveInstagram'] == 1){echo 'checked';} ?> id="haveInstagram" name="haveInstagram" value="1"/>
                <label for="haveInstagram">Instagram Script</label>
                <i class="dashicons dashicons-info" title="Check if post have Instagram on it."></i>
            </p>
        </div>
        <?php
    }


    public function ampSaveMetaBox($post_id)
    {
        $data = array();

        if(wp_verify_nonce(handlePostData('amp_meta_box_nonce'), 'amp_meta_box_keyCode'))
        {
            $data['haveCarousel'] = handlePostData('haveCarousel');
            $data['haveInstagram'] = handlePostData('haveInstagram');

            if (current_user_can('edit_post', $post_id)) {
                update_post_meta($post_id, 'amp_script_selection', $data);
            }
        }
    }
}


?>