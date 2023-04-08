<?php

namespace Flynt\Components\HeroResourcesSection;

use Flynt\FieldVariables;

function getACFLayout()
{
    return [
        'name' => 'heroResourcesSection',
        'label' => 'Hero Resources Section',
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
                'label' => 'Background Element Image',
                'name' => 'background_element_image',
                'type' => 'image',
                'preview_size' => 'medium',
                'instructions' => '',
                'max_size' => 4,
                'mime_types' => 'gif,jpg,jpeg,png'
            ],
        ]
    ];
}
