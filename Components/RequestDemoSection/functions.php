<?php

namespace Flynt\Components\RequestDemoSection;

function getACFLayout()
{
    return [
        'name' => 'requestDemoSection',
        'label' => 'Request Demo Section',
        'sub_fields' => [
            [
                'label' => 'Background Image',
                'name' => 'background_image',
                'type' => 'image',
                'preview_size' => 'medium',
                'instructions' => '',
                'max_size' => 4,
                'mime_types' => 'gif,jpg,jpeg,png',
            ],
            [
                'label' => 'Is Hero?',
                'name' => 'is_hero',
                'type' => 'true_false',
                'wrapper' => [
                    'width' => '50'
                ]
            ],
            [
                'label' => 'Align Center',
                'name' => 'align_center',
                'type' => 'true_false',
                'wrapper' => [
                    'width' => '50'
                ]
            ],
            [
                'label' => 'Background Element Image 1',
                'name' => 'background_element_image_1',
                'type' => 'image',
                'preview_size' => 'medium',
                'instructions' => '',
                'max_size' => 4,
                'mime_types' => 'gif,jpg,jpeg,png',
                'wrapper' => [
                    'width' => '33.33333'
                ]
            ],
            [
                'label' => 'Background Element Image 2',
                'name' => 'background_element_image_2',
                'type' => 'image',
                'preview_size' => 'medium',
                'instructions' => '',
                'max_size' => 4,
                'mime_types' => 'gif,jpg,jpeg,png',
                'wrapper' => [
                    'width' => '33.33333'
                ]
            ],
            [
                'label' => 'Background Element Image 3',
                'name' => 'background_element_image_3',
                'type' => 'image',
                'preview_size' => 'medium',
                'instructions' => '',
                'max_size' => 4,
                'mime_types' => 'gif,jpg,jpeg,png',
                'wrapper' => [
                    'width' => '33.33333'
                ]
            ],
            [
                'label' => 'Content',
                'name' => 'content',
                'type' => 'wysiwyg',
                'delay' => 1,
                'media_upload' => 0,
                'wrapper' => [
                    'class' => 'autosize',
                ],
            ],
            [
                'label' => 'Gravity From Shortcode',
                'name' => 'gravity_grom_shortcode',
                'type' => 'text',
                'default_value' => '',
            ],
            [
                'label' => 'Youtube Video URL',
                'name' => 'video_url',
                'type' => 'text',
                'default_value' => '',
            ]
        ]
    ];
}
