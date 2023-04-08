<?php

use ACFComposer\ACFComposer;
use Flynt\Components;

add_action('Flynt/afterRegisterComponents', function () {
    ACFComposer::registerFieldGroup([
        'name' => 'postRoleFooterComponents',
        'title' => 'Post Role Footer Components',
        'style' => 'seamless',
        'fields' => [
            [
                'name' => 'postRoleFooterComponents',
                'label' => 'Post Role Footer Components',
                'type' => 'flexible_content',
                'button_label' => 'Add Component',
                'layouts' => [
                    Components\BlockContentSection\getACFLayout(),
                ]
            ]
        ],
        'location' => [
            [
                [
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'role'
                ]
            ]
        ]
    ]);
});
