<?php

namespace Flynt\Components\QuoteSection;

use Flynt\FieldVariables;

function getACFLayout()
{
    return [
        'name' => 'quoteSection',
        'label' => 'Quote Section',
        'sub_fields' => [
            [
                'label' => 'Avatar',
                'name' => 'avatar',
                'type' => 'image',
                'preview_size' => 'medium',
                'instructions' => '',
                'max_size' => 4,
                'mime_types' => 'gif,jpg,jpeg,png'
            ],
            [
                'label' => 'Name',
                'name' => 'name',
                'type' => 'text',
            ],
            [
                'label' => 'Role',
                'name' => 'role',
                'type' => 'text',
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
                'label' => 'Background Image',
                'name' => 'background_image',
                'type' => 'image',
                'preview_size' => 'medium',
                'instructions' => '',
                'max_size' => 4,
                'mime_types' => 'gif,jpg,jpeg,png'
            ],
        ]
    ];
}
