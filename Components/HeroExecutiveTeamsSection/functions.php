<?php

namespace Flynt\Components\HeroExecutiveTeamsSection;

use Flynt\FieldVariables;

function getACFLayout()
{
    return [
        'name' => 'heroExecutiveTeamsSection',
        'label' => 'Hero Executive Teams Section',
        'sub_fields' => [
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
        ]
    ];
}
