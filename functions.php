<?php

namespace Flynt;

use Flynt\Utils\FileLoader;
use Flynt\Utils\Options;

require_once __DIR__ . '/vendor/autoload.php';

if (!defined('WP_ENV')) {
    define('WP_ENV', 'production');
}

// Check if the required plugins are installed and activated.
// If they aren't, this function redirects the template rendering to use
// plugin-inactive.php instead and shows a warning in the admin backend.
if (Init::checkRequiredPlugins()) {
    FileLoader::loadPhpFiles('inc');
    add_action('after_setup_theme', ['Flynt\Init', 'initTheme']);
    add_action('after_setup_theme', ['Flynt\Init', 'loadComponents'], 101);
}

// Remove the admin-bar inline-CSS as it isn't compatible with the sticky footer CSS.
// This prevents unintended scrolling on pages with few content, when logged in.
add_theme_support('admin-bar', array('callback' => '__return_false'));

add_action('after_setup_theme', function () {
    /**
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     */
    load_theme_textdomain('flynt', get_template_directory() . '/languages');
});

// Add Custom Metabox To Post Type

if (function_exists('acf_add_local_field_group')) :
    acf_add_local_field_group(array(
        'key' => 'group_5f354a1b4eeb4',
        'title' => 'Post Custom Metabox',
        'fields' => array(
            array(
                'key' => 'field_5f35852f67787',
                'label' => 'Landing Page Link',
                'name' => 'landing_page_link',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ),
            array(
                'key' => 'field_5f35854867788',
                'label' => 'Landing Page Type',
                'name' => 'landing_page_type',
                'type' => 'radio',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'choices' => array(
                    'watch-video' => 'Watch video',
                    'listen-now' => 'Listen now',
                    'read-article' => 'Read article',
                ),
                'allow_null' => 0,
                'other_choice' => 0,
                'default_value' => '',
                'layout' => 'vertical',
                'return_format' => 'value',
                'save_other_choice' => 0,
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'post',
                ),
            ),
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'case-study',
                ),
            )
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
    ));
endif;

add_filter(
    'gform_ajax_spinner_url',
    function ($image_src, $form) {
        return  'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7'; // relative to you theme images folder
    },
    10,
    2
);

//Include the comment reply Javascript
add_action('wp_print_scripts', function () {
    if ((!is_admin()) && is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
});

// prevent page from scrolling up after gravity form submit
add_filter('gform_confirmation_anchor', '__return_false');

// adding a wrapper to the youtube embed automatically
add_filter('embed_oembed_html', function ($html, $url, $attr, $post_id) {
    if (strpos($html, 'youtube') !== false) {
        return '<div class="video-wrapper">' . $html . '</div>';
    }

    return $html;
}, 10, 4);

// // Remove 'benefit', 'role' and 'team-member' slug from the url
// add_filter('post_type_link', function ($post_link, $post, $leavename) {
//     if (('benefit' != $post->post_type && 'role' != $post->post_type && 'team-member' != $post->post_type)
//       || 'publish' != $post->post_status) {
//         return $post_link;
//     }

//     $post_link = str_replace('/' . $post->post_type . '/', '/', $post_link);
//     return $post_link;
// }, 10, 3);

// add_action('pre_get_posts', function ($query) {
//     // If is not the main query OR if it doesn't match our rewire rule
//     if (!$query->is_main_query() || 2 != count($query->query) || !isset($query->query['page'])) {
//         return;
//     }

//     // OR if not querying based on the post name
//     if (!empty($query->query['name'])) {
//         $query->set('post_type', array( 'post', 'page', 'benefit', 'role', 'team-member' ));
//     }
// });


// Add global settings to timber context
add_filter('timber/context', function ($context) {
    $context['website_scripts'] = Options::getGlobal('Website Settings', 'website_scripts');

    return $context;
});

// Hide update notifications
// add_filter('pre_site_transient_update_core','remove_core_updates'); // Hide updates for WordPress itself
// add_filter('pre_site_transient_update_plugins','remove_core_updates'); // Hide updates for all plugins
// add_filter('pre_site_transient_update_themes','remove_core_updates'); // Hide updates for all themes


// // Add /blog/ prefix to posts
// /**
//  * Add new rewrite rule
//  */
// function create_new_url_querystring() {
//     add_rewrite_rule(
//         'blog/([^/]*)$',
//         'index.php?name=$matches[1]',
//         'top'
//     );

//     add_rewrite_tag('%blog%','([^/]*)');
// }
// add_action('init', 'create_new_url_querystring', 999 );


// /**
//  * Modify post link
//  * This will print /blog/post-name instead of /post-name
//  */
// function append_query_string( $url, $post, $leavename ) {
//     if ( $post->post_type != 'post' ) {
//         return $url;
//     }

//     if ( false !== strpos( $url, '%postname%' ) ) {
//         $slug = '%postname%';
//     } elseif ( $post->post_name ) {
//         $slug = $post->post_name;
//     } else {
//         $slug = sanitize_title( $post->post_title );
//     }

//     $url = home_url( user_trailingslashit( 'blog/'. $slug ) );

//     return $url;
// }
// add_filter( 'post_link', 'append_query_string', 10, 3 );


// /**
//  * Redirect all posts to new url
//  * If you get error 'Too many redirects' or 'Redirect loop', then delete everything below
//  */
// function redirect_old_urls() {
//     if ( is_singular('post') ) {
//         global $post;

//         if ( strpos( $_SERVER['REQUEST_URI'], '/blog/') === false) {
//            wp_redirect( home_url( user_trailingslashit( "blog/$post->post_name" ) ), 301 );
//            exit();
//         }
//     }
// }
// add_filter( 'template_redirect', 'redirect_old_urls' );
