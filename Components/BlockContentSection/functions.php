<?php

namespace Flynt\Components\BlockContentSection;

use Flynt\FieldVariables;

function getACFLayout()
{
    return [
        'name' => 'blockContentSection',
        'label' => 'Block Content Section',
        'sub_fields' => [
            [
                'label' => 'Full Width',
                'name' => 'full_width',
                'type' => 'true_false',
                'wrapper' => [
                    'width' => '25'
                ]
            ],
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
                'label' => 'Section Width (% or px)',
                'name' => 'sectio_width',
                'type' => 'text',
                'default_value' => '900px',
                'wrapper' => [
                    'width' => '25'
                ]
            ],

            [
                'label' => 'Alignment',
                'label' => 'Section Padding',
                'name' => 'section_padding',
                'type' => 'select',
                'choices' => [
                    'none' => 'None',
                    'remove-top-padding' => 'Remove Top Padding',
                    'remove-bottom-padding' => 'Remove Bottom Padding',
                ],
                'default_value' => 'none',
                'multiple' => 0,
                'ui' => 0,
                'return_format' => 'value',
                'ajax' => 0,
                'placeholder' => '',
                'wrapper' => [
                    'width' => '25'
                ]
            ],
            [
                'label' => 'Position',
                'name' => 'position',
                'type' => 'select',
                'choices' => [
                    'left' => 'Left',
                    'center' => 'Center',
                ],
                'default_value' => 'center',
                'multiple' => 0,
                'ui' => 0,
                'return_format' => 'value',
                'ajax' => 0,
                'placeholder' => '',
                'wrapper' => [
                    'width' => '25'
                ]
            ],
            [
                'label' => 'Display Mode',
                'name' => 'display_mode',
                'type' => 'select',
                'choices' => [
                    'normal' => 'Normal',
                    'mobile-show' => 'Mobile Show',
                    'mobile-hide' => 'Mobile Hide',
                ],
                'default_value' => 'normal',
                'multiple' => 0,
                'ui' => 0,
                'return_format' => 'value',
                'ajax' => 0,
                'placeholder' => '',
                'wrapper' => [
                    'width' => '25'
                ]
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
                'label' => 'Link Title',
                'name' => 'link_title',
                'type' => 'text',
                'default_value' => '',
            ],
            [
                'label' => 'Link URL',
                'name' => 'link_url',
                'type' => 'text',
                'default_value' => '',
            ],
        ]
    ];
}
