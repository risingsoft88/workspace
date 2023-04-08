<?php

namespace Flynt\Components\HeroTextImageSection;

function getACFLayout()
{
    return [
        'name' => 'heroTextImageSection',
        'label' => 'Hero Text Image Section',
        'sub_fields' => [
            [
                'label' => 'Text Align',
                'name' => 'text_align',
                'type' => 'select',
                'choices' => [
                    'none' => 'None',
                    'mobile-text-center' => 'Mobile Text Center',
                ],
                'default_value' => 'none',
                'multiple' => 0,
                'ui' => 0,
                'return_format' => 'value',
                'ajax' => 0,
                'placeholder' => '',
                'wrapper' => [
                    'width' => '25'
                ]
            ],
            [
                'label' => 'Large Font Size',
                'name' => 'large_font_size',
                'type' => 'true_false',
                'wrapper' => [
                    'width' => '25'
                ]
            ],
            [
                'label' => 'Gradient Background Color',
                'name' => 'gradient_background_color',
                'type' => 'true_false',
                'wrapper' => [
                    'width' => '25'
                ]
            ],
            [
                'label' => 'Remove H2 Underline',
                'name' => 'remove_h2_underline',
                'type' => 'true_false',
                'wrapper' => [
                    'width' => '25'
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
        ]
    ];
}
