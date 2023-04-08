<?php

namespace Flynt\Components\LogoListSection;

use Flynt\FieldVariables;

function getACFLayout()
{
    return [
        'name' => 'logoListSection',
        'label' => 'Logo List Section',
        'sub_fields' => [
            [
                'label' => 'Section Title',
                'name' => 'section_title',
                'type' => 'text',
                'default_value' => '',
            ],
            [
                'label' => 'Logo Setting',
                'name' => 'logo_setting',
                'type' => 'group',
                'layout' => 'table',
                'sub_fields' => [
                    [
                        'label' => 'Desktop',
                        'name' => 'desktop',
                        'type' => 'group',
                        'sub_fields' => [
                            [
                                'label' => 'Logos',
                                'name' => 'logos',
                                'type' => 'repeater',
                                'layout' => 'table',
                                'button_label' => 'Add Logo',
                                'sub_fields' => [
                                    [
                                        'label' => 'Retina Image',
                                        'name' => 'image',
                                        'type' => 'image',
                                        'preview_size' => 'full',
                                    ],
                                    [
                                        'label' => 'Width (px)',
                                        'name' => 'width',
                                        'type' => 'text',
                                        'wrapper' => [
                                            'width' => '20',
                                        ]
                                    ],
                                ]
                            ]
                        ],
                    ],
                    [
                        'label' => 'Mobile',
                        'name' => 'mobile',
                        'type' => 'group',
                        'sub_fields' => [
                            [
                                'label' => 'Logos',
                                'name' => 'logos',
                                'type' => 'repeater',
                                'layout' => 'table',
                                'button_label' => 'Add Logo',
                                'sub_fields' => [
                                    [
                                        'label' => 'Line Break?',
                                        'name' => 'line_break',
                                        'type' => 'true_false',
                                        'wrapper' => array(
                                            'width' => '15',
                                        ),
                                    ],
                                    [
                                        'label' => 'Retina Image',
                                        'name' => 'image',
                                        'type' => 'image',
                                        'preview_size' => 'full',
                                    ],
                                    [
                                        'label' => 'Width (px)',
                                        'name' => 'width',
                                        'type' => 'text',
                                        'wrapper' => [
                                            'width' => '20',
                                        ]
                                    ],
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ]
    ];
}
