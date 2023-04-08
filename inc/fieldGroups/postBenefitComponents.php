<?php

use ACFComposer\ACFComposer;
use Flynt\Components;

add_action('Flynt/afterRegisterComponents', function () {
    ACFComposer::registerFieldGroup([
        'name' => 'postBenefitComponents',
        'title' => 'Post Benefit Feature Components',
        'style' => 'seamless',
        'fields' => [
            [
                'name' => 'postBenefitComponents',
                'label' => 'Post Benefit Feature Components',
                'type' => 'flexible_content',
                'button_label' => 'Add Component',
                'layouts' => [
                    Components\HeroTextBackgroundSection\getACFLayout(),
                    Components\BlockContentSection\getACFLayout(),
                    Components\BlockImageText4\getACFLayout(),
                    Components\RequestDemoSection\getACFLayout(),
                    Components\PostOneColumnSection\getACFLayout(),
                    Components\EmptySection\getACFLayout(),
                ]
            ]
        ],
        'location' => [
            [
                [
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'benefit'
                ]
            ]
        ]
    ]);
});
