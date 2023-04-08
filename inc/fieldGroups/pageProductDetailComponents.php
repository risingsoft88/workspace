<?php

use ACFComposer\ACFComposer;
use Flynt\Components;

add_action('Flynt/afterRegisterComponents', function () {
    ACFComposer::registerFieldGroup([
        'name' => 'pageProductDetailComponents',
        'title' => 'Page Product Detail Components',
        'style' => 'seamless',
        'fields' => [
            [
                'name' => 'pageProductDetailComponents',
                'label' => 'Page Product Detail Components',
                'type' => 'flexible_content',
                'button_label' => 'Add Component',
                'layouts' => [
                    Components\HeroProductDetailSection\getACFLayout(),
                    Components\NavigationSection\getACFLayout(),
                    Components\BlockImageText3\getACFLayout(),
                    Components\BlockImageText\getACFLayout(),
                    Components\PostOneColumnSection\getACFLayout(),
                    Components\CompareTableSection\getACFLayout(),
                    Components\EmptySection\getACFLayout(),
                    Components\RequestDemoSection\getACFLayout(),
                ]
            ]
        ],
        'location' => [
            [
                [
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'page-templates/page-product-detail.php'
                ]
            ]
        ]
    ]);
});
