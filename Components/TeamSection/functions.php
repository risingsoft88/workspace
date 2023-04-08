<?php

namespace Flynt\Components\TeamSection;

use Flynt\FieldVariables;

function getACFLayout()
{
    return [
        'name' => 'teamSection',
        'label' => 'Team Section',
        'sub_fields' => [
            [
                'label' => 'Section ID',
                'name' => 'section_id',
                'type' => 'text',
                'default_value' => '',
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
                'label' => 'Team Images',
                'name' => 'team_images',
                'type' => 'repeater',
                'layout' => 'table',
                'button_label' => 'Add Image',
                'sub_fields' => [
                    [
                        'label' => 'Image',
                        'name' => 'image',
                        'type' => 'image',
                        'preview_size' => 'thumbnail',
                        'instructions' => '',
                        'max_size' => 4,
                        'mime_types' => 'gif,jpg,jpeg,png',
                    ],
                    [
                        'label' => 'Size',
                        'name' => 'size',
                        'type' => 'select',
                        'choices' => [
                            1 => '1x',
                            2 => '2x',
                        ],
                        'default_value' => 1,
                        'allow_null' => 0,
                        'multiple' => 0,
                        'ui' => 0,
                        'return_format' => 'value',
                    ],
                ],
            ],
            [
                'label' => 'Link Title',
                'name' => 'link_title',
                'type' => 'text',
                'default_value' => '',
            ],
            [
                'label' => 'Link URL',
                'name' => 'link_url',
                'type' => 'text',
                'default_value' => '',
            ],
        ]
    ];
}
