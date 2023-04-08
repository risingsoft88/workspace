<?php

namespace Flynt\Components\BlockImageText;

function getACFLayout()
{
    return [
        'name' => 'blockImageText',
        'label' => 'Block: Image & Text',
        'sub_fields' => [
            [
                'label' => 'Section ID',
                'name' => 'section_id',
                'type' => 'text',
                'default_value' => '',
                'wrapper' => [
                    'width' => '20'
                ]
            ],
            [
                'label' => 'Image & Text Same Width',
                'name' => 'image_text_same_width',
                'type' => 'true_false',
                'wrapper' => [
                    'width' => '20'
                ]
            ],
            [
                'label' => 'Row Reverse',
                'name' => 'row_reverse',
                'type' => 'true_false',
                'wrapper' => [
                    'width' => '20'
                ]
            ],
            [
                'label' => 'Gray Background Color',
                'name' => 'gray_background_color',
                'type' => 'true_false',
                'wrapper' => [
                    'width' => '20'
                ]
            ],
            [
                'label' => 'Image Shadow',
                'name' => 'image_shadow',
                'type' => 'true_false',
                'default_value' => 1,
                'wrapper' => [
                    'width' => '20'
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
                'label' => 'Content Icon',
                'name' => 'content_icon',
                'type' => 'image',
                'preview_size' => 'medium',
                'instructions' => '',
                'max_size' => 4,
                'mime_types' => 'gif,jpg,jpeg,png'
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
                'label' => 'Link Style',
                'name' => 'link_style',
                'type' => 'select',
                'choices' => [
                    'text' => 'Text',
                    'button' => 'Button',
                ],
                'default_value' => '',
                'wrapper' => [
                    'width' => '25'
                ]
            ],
            [
                'label' => 'Link Title',
                'name' => 'link_title',
                'type' => 'text',
                'default_value' => '',
                'wrapper' => [
                    'width' => '25'
                ]
            ],
            [
                'label' => 'Link URL',
                'name' => 'link_url',
                'type' => 'text',
                'default_value' => '',
                'wrapper' => [
                    'width' => '25'
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
                    'width' => '25'
                ]
            ],
        ]
    ];
}
