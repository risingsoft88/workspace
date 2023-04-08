<?php

namespace Flynt\CustomPostTypes;

function registerBenefitPostType()
{
    $labels = array(
        'name'                  => _x('Benefits', 'Benefit General Name', 'flynt'),
        'singular_name'         => _x('Benefit', 'Benefit Singular Name', 'flynt'),
        'menu_name'             => __('Benefits', 'flynt'),
        'name_admin_bar'        => __('Benefit', 'flynt'),
        'all_items'             => __('All Benefits', 'flynt'),
        'add_new_item'          => __('Add New Benefit', 'flynt'),
        'add_new'               => __('Add New', 'flynt'),
        'new_item'              => __('New Benefit', 'flynt'),
        'edit_item'             => __('Edit Benefit', 'flynt'),
        'update_item'           => __('Update Benefit', 'flynt'),
        'view_item'             => __('View Benefit', 'flynt'),
        'view_items'            => __('View Benefits', 'flynt'),
        'search_items'          => __('Search Benefit', 'flynt'),
    );

    $args = array(
        'label'                 => __('Benefit', 'flynt'),
        'description'           => __('Benefit Description', 'flynt'),
        'labels'                => $labels,
        'supports'              => array('title', 'page-attributes'),
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
        'rewrite'               => array( 'slug' => 'benefit', 'with_front' => false ),
        'capability_type'       => 'page',
        'menu_icon'             => 'dashicons-money-alt',
    );

    register_post_type('benefit', $args);
}

add_action('init', '\\Flynt\\CustomPostTypes\\registerBenefitPostType');
