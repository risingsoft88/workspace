<?php

namespace Flynt\CustomPostTypes;

function registerPodcastPostType()
{
    $labels = array(
        'name'                  => _x('Podcasts', 'Podcast General Name', 'flynt'),
        'singular_name'         => _x('Podcast', 'Podcast Singular Name', 'flynt'),
        'menu_name'             => __('Podcasts', 'flynt'),
        'name_admin_bar'        => __('Podcast', 'flynt'),
        'all_items'             => __('All Podcasts', 'flynt'),
        'add_new_item'          => __('Add New Podcast', 'flynt'),
        'add_new'               => __('Add New', 'flynt'),
        'new_item'              => __('New Podcast', 'flynt'),
        'edit_item'             => __('Edit Podcast', 'flynt'),
        'update_item'           => __('Update Podcast', 'flynt'),
        'view_item'             => __('View Podcast', 'flynt'),
        'view_items'            => __('View Podcasts', 'flynt'),
        'search_items'          => __('Search Podcast', 'flynt'),
    );

    $args = array(
        'label'                 => __('Podcast', 'flynt'),
        'description'           => __('Podcast Description', 'flynt'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'thumbnail', 'author', 'excerpt'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_rest'          => true,
        'show_in_menu'          => true,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'rewrite'               => array( 'slug' => 'podcast', 'with_front' => false ),
        'capability_type'       => 'page',
        'menu_icon'             => 'dashicons-megaphone',
    );

    register_post_type('podcast', $args);
}

add_action('init', '\\Flynt\\CustomPostTypes\\registerPodcastPostType');
