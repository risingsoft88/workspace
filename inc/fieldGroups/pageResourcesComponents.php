<?php

use ACFComposer\ACFComposer;
use Flynt\Components;

add_action('Flynt/afterRegisterComponents', function () {
    ACFComposer::registerFieldGroup([
        'name' => 'pageResourcesComponents',
        'title' => 'Page Resources Components',
        'style' => 'seamless',
        'fields' => [
            [
                'name' => 'pageResourcesComponents',
                'label' => 'Page Resources Components',
                'type' => 'flexible_content',
                'button_label' => 'Add Component',
                'layouts' => [
                    Components\HeroResourcesSection\getACFLayout(),
                    Components\BlockImageText\getACFLayout(),
                    Components\RequestDemoSection\getACFLayout(),
                    Components\PostFourColumnSection\getACFLayout(),
                    Components\PostOneColumnSection\getACFLayout(),
                    Components\EmptySection\getACFLayout(),
                ]
            ]
        ],
        'location' => [
            [
                [
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'page-templates/page-resources.php'
                ]
            ]
        ]
    ]);
});
