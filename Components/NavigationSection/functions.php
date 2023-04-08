<?php

namespace Flynt\Components\NavigationSection;

function getACFLayout()
{
    return [
        'name' => 'navigationSection',
        'label' => 'Navigation Section',
        'sub_fields' => [
            [
                'label' => 'Navigations',
                'name' => 'navigations',
                'type' => 'repeater',
                'layout' => 'table',
                'button_label' => 'Add New Navigation',
                'sub_fields' => [
                    [
                        'label' => 'Section Name',
                        'name' => 'section_name',
                        'type' => 'text',
                    ],
                    [
                        'label' => 'Section ID',
                        'name' => 'section_id',
                        'type' => 'text',
                    ],
                ],
            ]
        ]
    ];
}
