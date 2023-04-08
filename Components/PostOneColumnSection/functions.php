<?php

namespace Flynt\Components\PostOneColumnSection;

function getACFLayout()
{
    return [
        'name' => 'postOneColumnSection',
        'label' => 'Post One Column Section',
        'sub_fields' => [
            [
                'label' => 'Post or Case Study:',
                'name' => 'selected_post',
                'type' => 'post_object',
                'post_type' => ['post','case-study'],
                'return_format' => 'object',
                'ui' => 1,
            ]
        ]
    ];
}
