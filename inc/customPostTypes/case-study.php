<?php

namespace Flynt\CustomPostTypes;

function registerCaseStudyPostType()
{
    $labels = array(
        'name'                  => _x('Case Studies', 'Case Study General Name', 'flynt'),
        'singular_name'         => _x('Case Study', 'Case Study Singular Name', 'flynt'),
        'menu_name'             => __('Case Studies', 'flynt'),
        'name_admin_bar'        => __('Case Study', 'flynt'),
        'all_items'             => __('All Case Studies', 'flynt'),
        'add_new_item'          => __('Add New Case Study', 'flynt'),
        'add_new'               => __('Add New', 'flynt'),
        'new_item'              => __('New Case Study', 'flynt'),
        'edit_item'             => __('Edit Case Study', 'flynt'),
        'update_item'           => __('Update Case Study', 'flynt'),
        'view_item'             => __('View Case Study', 'flynt'),
        'view_items'            => __('View Case Studies', 'flynt'),
        'search_items'          => __('Search Case Study', 'flynt'),
    );

    $args = array(
        'label'                 => __('Case Study', 'flynt'),
        'description'           => __('Case Study Description', 'flynt'),
        'labels'                => $labels,
        'supports'              => array('title', 'thumbnail', 'excerpt'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'rewrite'               => array( 'slug' => 'case-study', 'with_front' => false ),
        'capability_type'       => 'page',
        'menu_icon'             => 'dashicons-text-page',
    );

    register_post_type('case-study', $args);
}

add_action('init', '\\Flynt\\CustomPostTypes\\registerCaseStudyPostType');
