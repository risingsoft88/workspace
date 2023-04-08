<?php

namespace Flynt\Components\PostFourColumnSection;

function getACFLayout()
{
    return [
        'name' => 'postFourColumnSection',
        'label' => 'Post, Podcast or Case Study Four Column Section',
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
                'label' => 'Posts',
                'name' => 'posts',
                'type' => 'repeater',
                'min' => 4,
                'max' => 4,
                'layout' => 'table',
                'button_label' => 'Add Post',
                'sub_fields' => [
                    [
                        'label' => 'post',
                        'name' => 'post',
                        'type' => 'post_object',
                        'post_type' => [
                            'post',
                            'case-study',
                            'podcast',
                        ],
                        'return_format' => 'object',
                        'ui' => 1,
                    ]
                ]
            ]
        ]
    ];
}
