<?php

namespace Flynt\Components\BlockImageText5;

function getACFLayout()
{
    return [
        'name' => 'blockImageText5',
        'label' => 'Block: Image & Text5',
        'sub_fields' => [
            [
                'label' => 'Section ID',
                'name' => 'section_id',
                'type' => 'text',
                'default_value' => '',
                'wrapper' => [
                    'width' => '50'
                ]
            ],
            
            [
                'label' => 'Row Reverse',
                'name' => 'row_reverse',
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
            [
                'label' => 'Link Title',
                'name' => 'link_title',
                'type' => 'text',
                'default_value' => '',
                'wrapper' => [
                    'width' => '33.33333'
                ]
            ],
            [
                'label' => 'Link URL',
                'name' => 'link_url',
                'type' => 'text',
                'default_value' => '',
                'wrapper' => [
                    'width' => '33.33333'
                ]
            ],
            [
                'label' => 'Open in new tab?',
                'name' => 'new_tab',
                'type' => 'true_false',
                'ui' => true,
                'ui_on_text' => 'Yes',
                'ui_off_text' => 'No',
                'default_value' => 0,
                'wrapper' => [
                    'width' => '33.33333'
                ]
            ]
        ]
    ];
}
