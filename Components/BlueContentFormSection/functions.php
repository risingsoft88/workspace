<?php

namespace Flynt\Components\BlueContentFormSection;

function getACFLayout()
{
    return [
        'name' => 'blueContentFormSection',
        'label' => 'Blue Content Form Section',
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
                'label' => 'Gravity From Shortcode',
                'name' => 'gravity_grom_shortcode',
                'type' => 'text',
                'default_value' => '',
            ],
        ]
    ];
}
