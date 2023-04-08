<?php

namespace Flynt\CustomPostTypes;

function registerRolePostType()
{
    $labels = array(
        'name'                  => _x('Roles', 'Role General Name', 'flynt'),
        'singular_name'         => _x('Role', 'Role Singular Name', 'flynt'),
        'menu_name'             => __('Roles', 'flynt'),
        'name_admin_bar'        => __('Role', 'flynt'),
        'all_items'             => __('All Roles', 'flynt'),
        'add_new_item'          => __('Add New Role', 'flynt'),
        'add_new'               => __('Add New', 'flynt'),
        'new_item'              => __('New Role', 'flynt'),
        'edit_item'             => __('Edit Role', 'flynt'),
        'update_item'           => __('Update Role', 'flynt'),
        'view_item'             => __('View Role', 'flynt'),
        'view_items'            => __('View Roles', 'flynt'),
        'search_items'          => __('Search Role', 'flynt'),
    );

    $args = array(
        'label'                 => __('Role', 'flynt'),
        'description'           => __('Role Description', 'flynt'),
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
        'rewrite'               => array( 'slug' => 'role', 'with_front' => false ),
        'capability_type'       => 'page',
        'menu_icon'             => 'dashicons-money',
    );

    register_post_type('role', $args);
}

add_action('init', '\\Flynt\\CustomPostTypes\\registerRolePostType');
