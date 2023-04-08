<?php

use ACFComposer\ACFComposer;
use Flynt\Components;

add_action('Flynt/afterRegisterComponents', function () {
    ACFComposer::registerFieldGroup([
        'name' => 'pageProductsComponents',
        'title' => 'Page Products Components',
        'style' => 'seamless',
        'fields' => [
            [
                'name' => 'pageProductsComponents',
                'label' => 'Page Products Components',
                'type' => 'flexible_content',
                'button_label' => 'Add Component',
                'layouts' => [
                    Components\HeroTextImageSection\getACFLayout(),
                    Components\BlockImageText3\getACFLayout(),
                    Components\BlockImageText\getACFLayout(),
                    Components\BlockContentSection\getACFLayout(),
                    Components\PostOneColumnSection\getACFLayout(),
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
                    'value' => 'page-templates/page-products.php'
                ]
            ]
        ]
    ]);
});
