<?php

namespace Flynt\Components\BlockImageText3;

function getACFLayout()
{
    return [
        'name' => 'blockImageText3',
        'label' => 'Block: Image & Text3',
        'sub_fields' => [
            [
                'label' => 'Section Padding',
                'name' => 'section_padding',
                'type' => 'select',
                'choices' => [
                    'none' => 'None',
                    'add-top-padding' => 'Add Top Padding',
                    'add-bottom-padding' => 'Add Bottom Padding',
                    'add-top-bottom-padding' => 'Add Top & Bottom Padding',
                ],
                'default_value' => 'none',
                'multiple' => 0,
                'ui' => 0,
                'return_format' => 'value',
                'ajax' => 0,
                'placeholder' => '',
                'wrapper' => [
                    'width' => '50'
                ]
            ],
            [
                'label' => 'Gray Background Color',
                'name' => 'gray_background_color',
                'type' => 'true_false',
                'wrapper' => [
                    'width' => '50'
                ]
            ],
            [
                'label' => 'Image',
                'name' => 'image',
                'type' => 'image',
                'preview_size' => 'medium',
                'instructions' => '',
                'max_size' => 4,
                'mime_types' => 'gif,jpg,jpeg,png',
                'wrapper' => [
                    'width' => '50'
                ]
            ],
            [
                'label' => 'Retina Image',
                'name' => 'retina_image',
                'type' => 'image',
                'preview_size' => 'medium',
                'instructions' => '',
                'max_size' => 4,
                'mime_types' => 'gif,jpg,jpeg,png',
                'wrapper' => [
                    'width' => '50'
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
        ]
    ];
}
