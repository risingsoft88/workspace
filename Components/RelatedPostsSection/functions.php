<?php

namespace Flynt\Components\RelatedPostsSection;

use Timber;
use Flynt\ZebraPagination;
use Flynt\Utils\TimberDynamicResize;

add_action('wp_ajax_get_related_posts', 'Flynt\Components\RelatedPostsSection\getRelatedPostsFunc');
add_action('wp_ajax_nopriv_get_related_posts', 'Flynt\Components\RelatedPostsSection\getRelatedPostsFunc');

function getRelatedPostsFunc()
{
    global $post;

    if (!wp_verify_nonce($_REQUEST['nonce'], 'get_related_posts_nonce')) {
        exit('No naughty business please');
    }

    $result = [];
    $result['type'] = 'success';

    $page = intval($_REQUEST['page']);
    $posts_per_page = intval($_REQUEST['postsPerPage']);
    $cat = $_REQUEST['cat'];
    $current_post_id = $_REQUEST['currentPostId'];

    $args = [
        'post_type' => 'post',
        'orderby' => 'date',
        'order' => 'DESC',
        'posts_per_page' => -1,
        'post__not_in' => [$current_post_id],
        'post_status' => 'publish'
    ];

    if ($cat !== 'all') {
        $args['cat'] = $cat;
    }

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
        'post_type' => 'post',
        'orderby' => 'date',
        'order' => 'DESC',
        'posts_per_page' => $posts_per_page,
        'offset' => ($page - 1) * $posts_per_page,
        'post__not_in' => [$current_post_id],
        'post_status' => 'publish'
    ];

    if ($cat !== 'all') {
        $args['cat'] = $cat;
    }
    
    $blogs = Timber::get_posts($args);

    $timberDynamicResize = new TimberDynamicResize();

    foreach ($blogs as $index => $blog) {
        if ($post_counts <= 1) { //1 has to be the current post
            $result['blog_html'] .= "<p class='related-posts-no-post'> At the moment there are no related posts for this post</p>";
        } else {
            $excerpt = substr($blog->post_excerpt, 0, 90);

            $blog_image_style = "";
            
            if ($blog->thumbnail !== null) {
                if ($index == 3) {
                    $blog_image_style = "style=\"background-image: url('" . $timberDynamicResize->resizeDynamic($blog->thumbnail->src, 600, $blog->thumbnail->height / $blog->thumbnail->width * 600) . "');\"";
                } else {
                    $blog_image_style = "style=\"background-image: url('" . $timberDynamicResize->resizeDynamic($blog->thumbnail->src, 450, 350) . "');\"";
                }
            }

            $landing_page_link = $blog->meta('landing_page_link');
            $landing_page_type_val = $blog->meta('landing_page_type');
            

            if ($landing_page_type_val == 'read-article') {
                $target_link = $blog->link;
            } else {
                $target_link = $landing_page_link;
            }

            $landing_page_type = $blog->field_object('landing_page_type')['choices'][$landing_page_type_val];

            $result['blog_html'] .= "
                <div class=\"related-posts-col\">
                    <div class=\"related-posts-col-inner\">
                        <a href=\"{$target_link}\">
                            <div class=\"related-posts-col-img\" {$blog_image_style}></div>
                            <div class=\"related-posts-col-info\">
                                <h3>{$blog->post_title}</h3>
                                <p>{$excerpt}</p>
                            </div>
                            <div class=\"related-posts-col-link\">
                                <p class=\"global-link\">{$landing_page_type}</p>
                                <span class=\"related-posts-col-icon post-view-link-icon-{$landing_page_type_val}\"></span>
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
        $result['load_more_btn'] = "<button id=\"related-posts-load-more-btn\" class=\"related-posts-load-more-btn\" data-next-page=\"{$next_page}\">Load more articles</button>";
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
