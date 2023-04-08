<?php

namespace Flynt\Components\BlockFormText;

function getACFLayout()
{
    return [
        'name' => 'blockFormText',
        'label' => 'Block: Form & Text',
        'sub_fields' => [
            [
                'label' => 'Section ID',
                'name' => 'section_id',
                'type' => 'text',
                'default_value' => '',
                'wrapper' => [
                    'width' => '33.33333'
                ]
            ],
            [
                'label' => 'Row Reverse',
                'name' => 'row_reverse',
                'type' => 'true_false',
                'wrapper' => [
                    'width' => '33.33333'
                ]
            ],
            [
                'label' => 'Gray Background Color',
                'name' => 'gray_background_color',
                'type' => 'true_false',
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
        ]
    ];
}
