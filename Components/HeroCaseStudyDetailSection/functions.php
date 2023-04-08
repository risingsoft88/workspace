<?php

namespace Flynt\Components\HeroCaseStudyDetailSection;

use Flynt\FieldVariables;

function getACFLayout()
{
    return [
        'name' => 'heroCaseStudyDetailSection',
        'label' => 'Hero Case Study Detail Section',
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
