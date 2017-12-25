<?php

class SettingsAmp{

    public function addSettingAmpMenu()
    {
        add_menu_page('Settings - WordPress AMP', 'WordPress AMP', 'manage_options', 'settings-wp-amp', array($this, 'settingPageWpAmp'), 'dashicons-analytics', 85);
    }


    public function settingPageWpAmp()
    {
        $screen = menu_page_url('settings-wp-amp', false);
        
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $this->saveSettingWpAmp();
            $_POST = '';
        }

        ?>
        <form name="wordpress-amp" action="<?php echo $screen ?>" method='post' id="wordpressAmpSettings" class="wpAmpForm">
            <p>
                <label for="gaCode">Google Analytics</label>
                <input id="gaCode" name="gaCode" type="text" class="input" value="<?php echo get_option('wpAmpGaCodeValue') ?>" placeholder="UA-XXXXXXX-X" maxlength="12"/>
            </p>
            <p>
                <label class="option_title"><strong>Top Position Blog</strong></label>
                <select class="option_value" name="wpAmpHomePageMainPost" class="input">
                    <option value="">-- Select Homepage Main Post --</option>
                    <?php
                    $homeBlog = get_option('wpAmpHomePageMainPost');
                    if ($homeBlog)
                    {
                        echo $this->data['exclude'] = $homeBlog;
                        echo '<option value="' . $homeBlog . '">' . get_the_title($homeBlog) . '</option>';
                    }
                    $this->data['exclude'] = $this->publishedBlogList();
                    ?>
                </select>
            </p>
            <button type="submit" name="saveWpAmpSettings" class="button button-primary">Submit</button>
        </form>
        <?php
    }


    private function saveSettingWpAmp(){
        update_option('wpAmpGaCodeValue', handlePostData('gaCode'));
        update_option('wpAmphomePageMainPost', handlePostData('wpAmpHomePageMainPost'));
    }


    /* /Retrieve Blogs List */
    private function publishedBlogList()
    {
        $args = array('post_type' => 'post', 'cat' => -10, 'post_status' => 'publish', 'posts_per_page' => -1,
            'orderby' => 'post_title', 'order' => 'ASC');

        if (is_array($this->data) && !empty($this->data))
        {
            $args = array_merge($args, $this->data);
        }

        $postArr = get_posts($args);
        foreach ($postArr as $k => $v)
        {
            ?>
            <option value="<?= $v->ID ?>"><?= $v->post_title ?></option>
            <?php
        }
    }
}