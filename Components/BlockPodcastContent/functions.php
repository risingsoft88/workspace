<?php

namespace Flynt\Components\BlockPodcastContent;

use Timber;
use Flynt\Utils\TimberDynamicResize;
use Flynt\Utils\Options;
use Flynt\ZebraPagination;

add_filter('Flynt/addComponentData?name=BlockPodcastContent', function ($data) {
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
    
    $posts_per_page = 3;
    $data['posts_per_page'] = $posts_per_page;
    $data['nonce'] = wp_create_nonce('get_related_podcasts_nonce');

    return $data;
});

add_action('wp_ajax_get_related_podcasts', 'Flynt\Components\BlockPodcastContent\getRelatedPodcastsFunc');
add_action('wp_ajax_nopriv_get_related_podcasts', 'Flynt\Components\BlockPodcastContent\getRelatedPodcastsFunc');

function getRelatedPodcastsFunc()
{
    global $post;

    if (!wp_verify_nonce($_REQUEST['nonce'], 'get_related_podcasts_nonce')) {
        exit('No naughty business please');
    }

    $result = [];
    $result['type'] = 'success';

    $page = intval($_REQUEST['page']);
    $posts_per_page = intval($_REQUEST['postsPerPage']);
    $current_post_id = $_REQUEST['currentPostId'];

    $args = [
        'post_type' => 'podcast',
        'orderby' => 'date',
        'order' => 'DESC',
        'posts_per_page' => -1,
        'post__not_in' => [$current_post_id],
        'post_status' => 'publish',
    ];

    $blogs = Timber::get_posts($args);
    $post_counts = count($blogs);
    $result['post_counts'] = $post_counts;

    $result['page_nav_html'] = '';
    if ($post_counts > $posts_per_page) {
        $pagination = new ZebraPagination();

        $pagination->records($post_counts);
        $pagination->recordsPerPage($posts_per_page);
        $pagination->setPage($page);
        $pagination->padding(false);
        $pagination->isMobile(wp_is_mobile());

        $result['page_nav_html'] = $pagination->render(true);
    }

    $result['blog_html'] = '';
    
    $args = [
        'post_type' => 'podcast',
        'orderby' => 'date',
        'order' => 'DESC',
        'posts_per_page' => $posts_per_page,
        'offset' => ($page - 1) * $posts_per_page,
        'post__not_in' => [$current_post_id],
        'post_status' => 'publish'
    ];
    
    $blogs = Timber::get_posts($args);

    $timberDynamicResize = new TimberDynamicResize();

    foreach ($blogs as $index => $blog) {
        if ($post_counts <= 1) { //1 has to be the current post
            $result['blog_html'] .= "<p class='related-posts-no-post'> At the moment there are no related posts for this post</p>";
        } else {
            $excerpt = substr($blog->post_excerpt, 0, 90);

            $blog_image_style = "";
            
            if ($blog->thumbnail !== null) {
                $blog_image_style = "style=\"background-image: url('" . $timberDynamicResize->resizeDynamic($blog->thumbnail->src, 450, 350) . "');\"";
            }

            $result['blog_html'] .= "
                <div class=\"related-posts-col\">
                    <div class=\"related-posts-col-inner\">
                        <a href=\"{$blog->link}\">
                            <div class=\"related-posts-col-img\" {$blog_image_style}></div>
                            <div class=\"related-posts-col-info\">
                                <h3>{$blog->post_title}</h3>
                                <p>{$excerpt}</p>
                            </div>
                            <div class=\"related-posts-col-link\">
                                <p class=\"global-link\">Listen now</p>
                                <span class=\"related-posts-col-icon post-view-link-icon-listen-now\"></span>
                            </div>
                        </a>
                    </div>
                </div>
            ";
        }
    }

    // check end page
    if ($post_counts > $page * $posts_per_page) {
        $next_page = $page + 1;
        $result['load_more_btn'] = "<button id=\"related-podcasts-load-more-btn\" class=\"related-posts-load-more-btn\" data-next-page=\"{$next_page}\">Load more articles</button>";
    } else {
        $result['load_more_btn'] = "";
    }

    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        $result = json_encode($result);
        echo $result;
    } else {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }

    die();
}
