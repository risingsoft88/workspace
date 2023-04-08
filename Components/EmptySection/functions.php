<?php

namespace Flynt\Components\EmptySection;

function getACFLayout()
{
    return [
        'name' => 'emptySection',
        'label' => 'Empty Section',
        'sub_fields' => [
            [
                'label' => 'Desktop height (in px or %)',
                'name' => 'desktop_height',
                'type' => 'text',
                'required' => 1,
                'wrapper' => [
                    'width' => '50',
                ]

            ],
            [
                'label' => 'Mobile height (in px or %)',
                'name' => 'mobile_height',
                'type' => 'text',
                'default_value' => '',
                'wrapper' => [
                    'width' => '50',
                ]
            ],
        ]
    ];
}
