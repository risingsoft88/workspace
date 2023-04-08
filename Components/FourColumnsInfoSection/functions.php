<?php

namespace Flynt\Components\FourColumnsInfoSection;

use Flynt\FieldVariables;

function getACFLayout()
{
    return [
        'name' => 'fourColumnsInfoSection',
        'label' => 'Four Columns Info Section',
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

                'label' => 'Info List',
                'name' => 'info_list',
                'type' => 'repeater',
                'layout' => 'table',
                'button_label' => 'Add Info',
                'sub_fields' => [
                    [
                        'label' => 'Background Image',
                        'name' => 'image',
                        'type' => 'image',
                        'preview_size' => 'medium',
                        'instructions' => '',
                        'max_size' => 4,
                        'mime_types' => 'gif,jpg,jpeg,png',
                        'wrapper' => [
                            'width' => '30'
                        ]
                    ],
                    [
                        'label' => 'Title',
                        'name' => 'title',
                        'type' => 'text',
                        'wrapper' => [
                            'width' => '30'
                        ]
                    ],
                    [
                        'label' => 'Content',
                        'name' => 'content',
                        'type' => 'text',
                        'wrapper' => [
                            'width' => '30'
                        ]
                    ],
                ]
            ]
        ]
    ];
}
