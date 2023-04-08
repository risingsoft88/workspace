<?php

namespace Flynt\Components\BlockCareersTwoColumnContentSection;

use Flynt\FieldVariables;

function getACFLayout()
{
    return [
        'name' => 'blockCareersTwoColumnContentSection',
        'label' => 'Block Careers Two Column Content Section',
        'sub_fields' => [
            [
                'label' => 'Border Bottom',
                'name' => 'border_bottom',
                'type' => 'true_false'
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
