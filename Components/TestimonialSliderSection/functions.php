<?php

namespace Flynt\Components\TestimonialSliderSection;

// add_filter('Flynt/addComponentData?name=TestimonialSliderSection', function ($data) {
//     print_r($data);
//     return $data;
// });

function getACFLayout()
{
    return [
        'name' => 'testimonialSliderSection',
        'label' => 'Testimonial Slider Section',
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
                'label' => 'Testimonials',
                'name' => 'testimonials',
                'type' => 'repeater',
                'layout' => 'table',
                'button_label' => 'Add Testimonial',
                'sub_fields' => [
                    [
                        'label' => 'Testimonial',
                        'name' => 'testimonial',
                        'type' => 'post_object',
                        'post_type' => [
                            0 => 'testimonial',
                        ],
                        'return_format' => 'object',
                        'ui' => 1,
                    ]
                ]
            ]
        ]
    ];
}
