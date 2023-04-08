<?php

namespace Flynt\CustomPostTypes;

function registerTestimonialPostType()
{
    $labels = array(
        'name'                  => _x('Testimonials', 'Testimonial General Name', 'flynt'),
        'singular_name'         => _x('Testimonial', 'Testimonial Singular Name', 'flynt'),
        'menu_name'             => __('Testimonials', 'flynt'),
        'name_admin_bar'        => __('Testimonial', 'flynt'),
        'all_items'             => __('All Testimonials', 'flynt'),
        'add_new_item'          => __('Add New Testimonial', 'flynt'),
        'add_new'               => __('Add New', 'flynt'),
        'new_item'              => __('New Testimonial', 'flynt'),
        'edit_item'             => __('Edit Testimonial', 'flynt'),
        'update_item'           => __('Update Testimonial', 'flynt'),
        'view_item'             => __('View Testimonial', 'flynt'),
        'view_items'            => __('View Testimonials', 'flynt'),
        'search_items'          => __('Search Testimonial', 'flynt'),
    );

    $args = array(
        'label'                 => __('Testimonial', 'flynt'),
        'description'           => __('Testimonial Description', 'flynt'),
        'labels'                => $labels,
        'supports'              => array('title'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => false,
        'rewrite'               => array( 'slug' => 'testimonial', 'with_front' => false ),
        'capability_type'       => 'page',
        'menu_icon'             => 'dashicons-clipboard',
    );

    register_post_type('testimonial', $args);
}

add_action('init', '\\Flynt\\CustomPostTypes\\registerTestimonialPostType');

function set_custom_edit_testimonial_columns($columns)
{

    return [
        'cb' => $columns['cb'],
        'title' => 'User Name',
        'avatar' => 'Avatar',
        // 'role' => 'Role',
        'company' => 'Company',
        'date' => $columns['date'],
    ];
}

add_filter('manage_testimonial_posts_columns', '\\Flynt\\CustomPostTypes\\set_custom_edit_testimonial_columns');

function custom_testimonial_column($column, $post_id)
{
    if ($column == 'avatar') {
        $user_avatar = get_field('user_avatar', $post_id);
        if (!empty($user_avatar)) {
            echo '<img src="' . $user_avatar->src . '" alt="' . $user_avatar->alt . '" style="max-width: 100px;"/>';
        }
    } else if ($column == 'role') {
        echo get_field('role', $post_id);
    } else if ($column == 'company') {
        $company_logo = get_field('company_logo', $post_id);
        echo '<img src="' . $company_logo->src . '" alt="' . $company_logo->alt . '" style="max-width: 200px;"/>';
    }
}

add_action('manage_testimonial_posts_custom_column', '\\Flynt\\CustomPostTypes\\custom_testimonial_column', 10, 2);

if (function_exists('acf_add_local_field_group')) :
    acf_add_local_field_group(array(
    'key' => 'group_5e94af3a3f8b7',
    'title' => 'Testimonial Metabox',
    'fields' => array(
        array(
            'key' => 'field_5e94af86de33f',
            'label' => 'User Avatar Retina Image',
            'name' => 'user_avatar',
            'type' => 'image',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'return_format' => 'array',
            'preview_size' => 'medium',
            'library' => 'all',
            'min_width' => '',
            'min_height' => '',
            'min_size' => '',
            'max_width' => '',
            'max_height' => '',
            'max_size' => '',
            'mime_types' => '',
        ),
        array(
            'key' => 'field_5e94af6fde33e',
            'label' => 'Company Logo Retina Image',
            'name' => 'company_logo',
            'type' => 'image',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'return_format' => 'array',
            'preview_size' => 'medium',
            'library' => 'all',
            'min_width' => '',
            'min_height' => '',
            'min_size' => '',
            'max_width' => '',
            'max_height' => '',
            'max_size' => '',
            'mime_types' => '',
        ),
        // array(
        //     'key' => 'field_5e94af4bde33d',
        //     'label' => 'Role',
        //     'name' => 'role',
        //     'type' => 'text',
        //     'instructions' => '',
        //     'required' => 0,
        //     'conditional_logic' => 0,
        //     'wrapper' => array(
        //         'width' => '',
        //         'class' => '',
        //         'id' => '',
        //     ),
        //     'default_value' => '',
        //     'placeholder' => '',
        //     'prepend' => '',
        //     'append' => '',
        //     'maxlength' => '',
        // ),
        array(
            'key' => 'field_5e94afbdde340',
            'label' => 'Content',
            'name' => 'content',
            'type' => 'wysiwyg',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'default_value' => '',
            'tabs' => 'all',
            'toolbar' => 'basic',
            'media_upload' => 0,
            'delay' => 1,
        ),
        // array(
        //     'key' => 'field_5e94afbddee40',
        //     'label' => 'Link Title',
        //     'name' => 'link_title',
        //     'type' => 'text',
        //     'default_value' => 'Intellectual Property',
        // ),
        // array(
        //     'key' => 'field_5e94afbddee41',
        //     'label' => 'Link URL',
        //     'name' => 'link_url',
        //     'type' => 'text',
        //     'default_value' => '',
        // ),
    ),
    'location' => array(
        array(
            array(
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'testimonial',
            ),
        ),
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
