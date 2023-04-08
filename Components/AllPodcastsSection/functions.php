<?php

namespace Flynt\Components\AllPodcastsSection;

use Timber;
use Flynt\ZebraPagination;
use Flynt\Utils\TimberDynamicResize;

add_filter('Flynt/addComponentData?name=AllPodcastsSection', function ($data) {
    global $post;

    $posts_per_page = 7;
    $data['posts_per_page'] = $posts_per_page;

    $data['nonce'] = wp_create_nonce('get_all_podcast_posts_nonce');

    return $data;
});

function getACFLayout()
{
    return [
        'name' => 'allPodcastsSection',
        'label' => 'All Podcasts Section',
        'sub_fields' => [
        ]
    ];
}

add_action('wp_ajax_get_all_podcast_posts', 'Flynt\Components\AllPodcastsSection\getAllPodcastPostsFunc');
add_action('wp_ajax_nopriv_get_all_podcast_posts', 'Flynt\Components\AllPodcastsSection\getAllPodcastPostsFunc');

function getAllPodcastPostsFunc()
{
    if (!wp_verify_nonce($_REQUEST['nonce'], 'get_all_podcast_posts_nonce')) {
        exit('No naughty business please');
    }

    $result = [];
    $result['type'] = 'success';

    $page = intval($_REQUEST['page']);
    $posts_per_page = intval($_REQUEST['postsPerPage']);

    $args = [
        'post_type' => 'podcast',
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => 'DESC',
        'posts_per_page' => -1,
    ];

    $blogs = Timber::get_posts($args);
    $post_counts = count($blogs);
    $result['post_counts'] = $post_counts;

    $result['page_nav_html'] = '';
    if ($post_counts > 7) {
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
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => 'DESC',
        'posts_per_page' => $posts_per_page,
        'offset' => ($page - 1) * $posts_per_page,
    ];
    
    $blogs = Timber::get_posts($args);

    $timberDynamicResize = new TimberDynamicResize();

    foreach ($blogs as $index => $blog) {
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

        $last_class = '';
        if ($index > 3) {
            $last_class = 'all-blog-col-last';
        }

        if ($index == 3) {
            $result['blog_html'] .= "
                <div class=\"all-blog-one-col\">
                    <div class=\"all-blog-one-col-inner\">
                        <a class=\"all-blog-one-col-inner-link\" href=\"{$blog->link}\">
                            <div class=\"all-blog-one-col-img\" {$blog_image_style}></div>
                            <div class=\"all-blog-one-col-content\">
                                <div class=\"all-blog-one-col-info\">
                                    <h3>{$blog->post_title}</h3>
                                    <p>{$blog->post_excerpt}</p>
                                </div>
                                <div class=\"all-blog-one-col-link\">
                                    <p class=\"global-link\">Listen now</p>

                                    <span class=\"all-blog-col-icon post-view-link-icon-listen-now\"></span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            ";
        } else {
            $excerpt = strip_tags($excerpt);
            $result['blog_html'] .= "
                <div class=\"all-blog-col {$last_class}\">
                    <div class=\"all-blog-col-inner\">
                        <a href=\"{$blog->link}\">
                            <div class=\"all-blog-col-img\" {$blog_image_style}></div>
                            <div class=\"all-blog-col-info\">
                                <h3>{$blog->post_title}</h3>
                                <p>{$excerpt}</p>
                            </div>
                            <div class=\"all-blog-col-link\">
                                <p class=\"global-link\">Listen now</p>

                                <span class=\"all-blog-col-icon post-view-link-icon-listen-now\"></span>
                            </div>
                        </a>
                    </div>
                </div>
            ";
        }
    }

    // check end page
    if ($post_counts >= $page * $posts_per_page) {
        $next_page = $page + 1;
        $result['load_more_btn'] = "<button id=\"all-podcast-load-more-btn\" class=\"all-blog-load-more-btn\" data-next-page=\"{$next_page}\">Load more articles</button>";
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
