<?php

namespace Flynt\Components\BlockTwoColumnContentSection;

use Flynt\FieldVariables;

function getACFLayout()
{
    return [
        'name' => 'blockTwoColumnContentSection',
        'label' => 'Block Two Column Content Section',
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
                'label' => 'Content Left',
                'name' => 'content_left',
                'type' => 'wysiwyg',
                'delay' => 1,
                'media_upload' => 0,
                'wrapper' => [
                    'class' => 'autosize',
                ],
            ],
            [
                'label' => 'Content Right',
                'name' => 'content_right',
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
