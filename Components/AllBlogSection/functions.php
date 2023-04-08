<?php

namespace Flynt\Components\AllBlogSection;

use Timber;
use Flynt\ZebraPagination;
use Flynt\Utils\TimberDynamicResize;

add_filter('Flynt/addComponentData?name=AllBlogSection', function ($data) {
    global $post;

    $posts_per_page = 7;
    $data['posts_per_page'] = $posts_per_page;
    $data['cat'] = 'all';
    
    // $args = [
    //     'post_type' => 'post',
    //     'orderby' => 'date',
    //     'order' => 'DESC',
    //     'posts_per_page' => $posts_per_page,
    //     'offset' => 0,
    // ];
    
    // $data['blogs'] = Timber::get_posts($args);
    
    // $pagination = new ZebraPagination();
    
    // $post_counts = wp_count_posts('post')->publish;
    // $pagination->records($post_counts);
    // $pagination->recordsPerPage($posts_per_page);
    // $pagination->padding(false);

    // $data['page_nav_html'] = $pagination->render(true);
    // $data['load_more_btn'] = "<button id=\"all-blog-load-more-btn\" class=\"all-blog-load-more-btn\" data-next-page=\"1\">Load more articles</button>";

    $data['nonce'] = wp_create_nonce('get_all_blog_posts_nonce');

    return $data;
});

function getACFLayout()
{
    return [
        'name' => 'allBlogSection',
        'label' => 'All Blog Section',
        'sub_fields' => [
            [
                'label' => 'Post Category List',
                'name' => 'post_category_list',
                'type' => 'repeater',
                'layout' => 'table',
                'button_label' => 'Add Category',
                'sub_fields' => [
                    [
                        'label' => 'Post Category',
                        'name' => 'post_category',
                        'type' => 'taxonomy',
                        'taxonomy' => 'category',
                        'field_type' => 'select',
                        'allow_null' => 0,
                        'add_term' => 0,
                        'save_terms' => 0,
                        'load_terms' => 0,
                        'return_format' => 'object',
                        'multiple' => 0,
                    ]
                ]
            ]
        ]
    ];
}

add_action('wp_ajax_get_all_blog_posts', 'Flynt\Components\AllBlogSection\getAllBlogPostsFunc');
add_action('wp_ajax_nopriv_get_all_blog_posts', 'Flynt\Components\AllBlogSection\getAllBlogPostsFunc');

function getAllBlogPostsFunc()
{
    if (!wp_verify_nonce($_REQUEST['nonce'], 'get_all_blog_posts_nonce')) {
        exit('No naughty business please');
    }

    $result = [];
    $result['type'] = 'success';

    $page = intval($_REQUEST['page']);
    $posts_per_page = intval($_REQUEST['postsPerPage']);
    $cat = $_REQUEST['cat'];

    $args = [
        'post_type' => 'post',
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => 'DESC',
        'posts_per_page' => -1,
    ];

    if ($cat !== 'all') {
        $args['category_name'] = $cat;
    }

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
        'post_type' => 'post',
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => 'DESC',
        'posts_per_page' => $posts_per_page,
        'offset' => ($page - 1) * $posts_per_page,
    ];

    if ($cat !== 'all') {
        $args['category_name'] = $cat;
    }
    
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
        $landing_page_type_val = $blog->meta('landing_page_type');
        

        if ($landing_page_type_val == 'read-article') {
            $target_link = $blog->link;
        } else {
            $target_link = $landing_page_link;
        }

        $landing_page_type = $blog->field_object('landing_page_type')['choices'][$landing_page_type_val];

        $last_class = '';
        if ($index > 3) {
            $last_class = 'all-blog-col-last';
        }

        if ($index == 3) {
            $result['blog_html'] .= "
                <div class=\"all-blog-one-col\">
                    <div class=\"all-blog-one-col-inner\">
                        <a class=\"all-blog-one-col-inner-link\" href=\"{$target_link}\">
                            <div class=\"all-blog-one-col-img\" {$blog_image_style}></div>
                            <div class=\"all-blog-one-col-content\">
                                <div class=\"all-blog-one-col-info\">
                                    <h3>{$blog->post_title}</h3>
                                    <p>{$blog->post_excerpt}</p>
                                </div>
                                <div class=\"all-blog-one-col-link\">
                                    <p class=\"global-link\">{$landing_page_type}</p>
                                    <span class=\"all-blog-one-col-icon post-view-link-icon-{$landing_page_type_val}\"></span>
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
                        <a href=\"{$target_link}\">
                            <div class=\"all-blog-col-img\" {$blog_image_style}></div>
                            <div class=\"all-blog-col-info\">
                                <h3>{$blog->post_title}</h3>
                                <p>{$excerpt}</p>
                            </div>
                            <div class=\"all-blog-col-link\">
                                <p class=\"global-link\">{$landing_page_type}</p>
                                <span class=\"all-blog-col-icon post-view-link-icon-{$landing_page_type_val}\"></span>
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
        $result['load_more_btn'] = "<button id=\"all-blog-load-more-btn\" class=\"all-blog-load-more-btn\" data-next-page=\"{$next_page}\">Load more articles</button>";
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
