<?php

namespace Flynt\Components\BlockPostContent;

use Timber;
use Flynt\Utils\TimberDynamicResize;
use Flynt\Utils\Options;

add_filter('Flynt/addComponentData?name=BlockPostContent', function ($data) {
    global $post;

    $data['current_post_id'] = $post->id;

    $data['user_avatar_url'] = '';
    
    $author_id = $data['post']->post_author;
    /**
     * User Profile Picture Plugin Used for User Avatar
     * https://wordpress.org/plugins/metronet-profile-picture/
     */
    if (function_exists('mt_profile_img')) {
        $profile_post_id = absint(get_user_option('metronet_post_id', $author_id));

        if (0 === $profile_post_id || 'mt_pp' !== get_post_type($profile_post_id)) {
            $data['user_avatar_url'] = '';
        } else {
            $post_thumbnail_id = get_post_thumbnail_id($profile_post_id);
            
            $timberDynamicResize = new TimberDynamicResize();
            
            $author_avatar_src = wp_get_attachment_image_src($post_thumbnail_id, 'full')[0];
            $data['user_avatar_url'] = $timberDynamicResize->resizeDynamic($author_avatar_src, 95, 95);
        }
    }

    $curauth = get_userdata($author_id);

    $data['post_author_url'] = $curauth->user_url;
    // $data['footer_post'] = Options::getGlobal('Post Settings', 'footer_post');
    
    $posts_per_page = 3;
    $cat = get_the_category();
    $cat = $cat[0]->term_id;
    $data['posts_per_page'] = $posts_per_page;
    $data['cat'] = $cat;
    $data['nonce'] = wp_create_nonce('get_related_posts_nonce');

    return $data;
});

// function sharer_buttons_enqueue_scripts()
// {
//     wp_enqueue_script('custom-script', get_stylesheet_directory_uri() . 'script.js', array(), '0.0.1', true);
// }
// add_action('wp_enqueue_scripts', 'sharer_buttons_enqueue_scripts');
