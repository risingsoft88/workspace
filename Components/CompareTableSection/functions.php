<?php

namespace Flynt\Components\CompareTableSection;

use Flynt\FieldVariables;

function getACFLayout()
{
    return [
        'name' => 'compareTableSection',
        'label' => 'Compare Table Section',
        'sub_fields' => [
            [
                'label' => 'Content',
                'name' => 'content_tab',
                'type' => 'tab',
                'placement' => 'top',
            ],
            [
                'label' => 'Title',
                'name' => 'title',
                'type' => 'text',
            ],
            [
                'label' => 'Table Header',
                'name' => 'table_header',
                'type' => 'repeater',
                'layout' => 'table',
                'button_label' => 'Add New Header',
                'sub_fields' => [
                    [
                        'label' => 'Header Content',
                        'name' => 'header_content',
                        'type' => 'text',
                    ],
                    [
                        'label' => 'Blue Border',
                        'name' => 'blue_bound',
                        'type' => 'true_false',
                    ]
                ],
            ],
            [
                'label' => 'Table Body',
                'name' => 'table_body',
                'type' => 'repeater',
                'layout' => 'table',
                'button_label' => 'Add New Body',
                'sub_fields' => [
                    [
                        'label' => 'First Col',
                        'name' => 'first_col',
                        'type' => 'group',
                        'layout' => 'row',
                        'sub_fields' => [
                            [
                                'label' => 'Title',
                                'name' => 'title',
                                'type' => 'text',
                            ],
                            [
                                'label' => 'Content',
                                'name' => 'content',
                                'type' => 'textarea',
                                'rows' => 3,
                            ]
                        ]
                    ],
                    [
                        'label' => 'Other Cols',
                        'name' => 'other_cols',
                        'type' => 'repeater',
                        'layout' => 'table',
                        'button_label' => 'Add New Body',
                        'sub_fields' => [
                            [
                                'label' => 'Icon Style',
                                'name' => 'icon_style',
                                'type' => 'select',
                                'choices' => [
                                    'yes' => 'Yes',
                                    'no' => 'No',
                                    'maybe' => 'Maybe',
                                ],
                                'default_value' => 'yes',
                                'wrapper' => [
                                    'width' => '33.33333'
                                ]
                            ],
                            [
                                'label' => 'Info',
                                'name' => 'info',
                                'type' => 'text',
                            ],
                            [
                                'label' => 'Blue Border',
                                'name' => 'blue_bound',
                                'type' => 'true_false',
                            ]
                        ]
                    ]
                ],
            ],
            [
                'label' => 'Options',
                'name' => 'options_tab',
                'type' => 'tab',
                'placement' => 'top',
            ],
            [
                'label' => 'Section ID',
                'name' => 'section_id',
                'type' => 'text',
            ],
        ]
    ];
}
