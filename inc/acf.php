<?php

namespace Flynt\Acf;

use Flynt\Utils\Options;

add_filter('pre_http_request', function ($preempt, $args, $url) {
    if (strpos($url, 'https://www.youtube.com/oembed') !== false || strpos($url, 'https://vimeo.com/api/oembed') !== false) {
        $response = wp_cache_get($url, 'oembedCache');
        if (!empty($response)) {
            return $response;
        }
    }
    return false;
}, 10, 3);

add_filter('http_response', function ($response, $args, $url) {
    if (strpos($url, 'https://www.youtube.com/oembed') !== false || strpos($url, 'https://vimeo.com/api/oembed') !== false) {
        wp_cache_set($url, $response, 'oembedCache');
    }
    return $response;
}, 10, 3);

// Website global settings
Options::addGlobal('Website Settings', [
    [
        'label' => 'Website Scripts',
        'name' => 'website_scripts',
        'type' => 'group',
        'layout' => 'row',
        'sub_fields' => [
            [
                'label' => 'Run tracking scripts?',
                'name' => 'run_tracking_scripts',
                'type' => 'true_false',
                'ui' => true,
                'ui_on_text' => 'Yes',
                'ui_off_text' => 'No',
            ],
            [
                'label' => 'Before head closing tag',
                'name' => 'before_head_closing_tag',
                'type' => 'textarea',
                'default_value' => '',
            ],
            [
                'label' => 'After body opening tag',
                'name' => 'after_body_opening_tag',
                'type' => 'textarea',
                'default_value' => '',
            ],
            [
                'label' => 'Before body closing tag',
                'name' => 'begore_body_closing_tag',
                'type' => 'textarea',
                'default_value' => '',
            ],
        ]
    ],
]);

// Footer settings
Options::addGlobal('Footer Settings', [
    [
        'label' => 'Footer Title',
        'name' => 'footer_title',
        'type' => 'text',
        'default_value' => '',
    ],
    [
        'label' => 'Footer Copyright',
        'name' => 'footer_copyright',
        'type' => 'text',
        'default_value' => '',
    ],
    [
        'label' => 'Footer Links',
        'name' => 'footer_links',
        'type' => 'repeater',
        'min' => 1,
        'max' => 4,
        'layout' => 'table',
        'sub_fields' => [
            [
                'label' => 'Link',
                'name' => 'link',
                'type' => 'link',
            ]
        ]
    ],
]);

// Options::addGlobal('Post Settings', [
//     [
//         'label' => 'Footer Post',
//         'name' => 'footer_post',
//         'type' => 'post_object',
//         'post_type' => 'post',
//         'return_format' => 'object',
//         'ui' => 1,
//     ]
// ]);

Options::addGlobal('Benefit Settings', [
    [
        [
            'label' => 'Benefit Footer Form Background Image',
            'name' => 'benefit_footer_form_background_image',
            'type' => 'image',
            'preview_size' => 'medium',
            'instructions' => '',
            'max_size' => 4,
            'mime_types' => 'gif,jpg,jpeg,png',
        ],
        [
            'label' => 'Benefit Footer Form Content',
            'name' => 'benefit_footer_form_content',
            'type' => 'wysiwyg',
            'delay' => 1,
            'media_upload' => 0,
            'wrapper' => [
                'class' => 'autosize',
            ],
        ],
        [
            'label' => 'Benefit Footer Gravity Form Shortcode',
            'name' => 'benefit_footer_gravity_form_shortcode',
            'type' => 'text',
            'default_value' => '',
        ]
    ]
]);

Options::addGlobal('Role Settings', [
    [
        [
            'label' => 'Role Footer Form Background Image',
            'name' => 'role_footer_form_background_image',
            'type' => 'image',
            'preview_size' => 'medium',
            'instructions' => '',
            'max_size' => 4,
            'mime_types' => 'gif,jpg,jpeg,png',
        ],
        [
            'label' => 'Role Footer Form Content',
            'name' => 'role_footer_form_content',
            'type' => 'wysiwyg',
            'delay' => 1,
            'media_upload' => 0,
            'wrapper' => [
                'class' => 'autosize',
            ],
        ],
        [
            'label' => 'Role Footer Gravity Form Shortcode',
            'name' => 'role_footer_gravity_form_shortcode',
            'type' => 'text',
            'default_value' => '',
        ]
    ]
]);

Options::addGlobal('Team Member Settings', [
    [
        [
            'label' => 'Hero Background Element Image',
            'name' => 'hero_background_element_image',
            'type' => 'image',
            'preview_size' => 'medium',
            'instructions' => '',
            'max_size' => 4,
            'mime_types' => 'gif,jpg,jpeg,png',
        ],
    ]
]);
