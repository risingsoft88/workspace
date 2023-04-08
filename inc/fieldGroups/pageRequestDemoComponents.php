<?php

use ACFComposer\ACFComposer;
use Flynt\Components;

add_action('Flynt/afterRegisterComponents', function () {
    ACFComposer::registerFieldGroup([
        'name' => 'pageRequestDemoComponents',
        'title' => 'Page Request Demo Components',
        'style' => 'seamless',
        'fields' => [
            [
                'name' => 'pageRequestDemoComponents',
                'label' => 'Page Request Demo Components',
                'type' => 'flexible_content',
                'button_label' => 'Add Component',
                'layouts' => [
                    Components\HeroTextBackgroundSection\getACFLayout(),
                    Components\BlockContentSection\getACFLayout(),
                    Components\BlockImageText\getACFLayout(),
                    Components\BlockFormText\getACFLayout(),
                    Components\QuoteSection\getACFLayout(),
                    Components\RequestDemoSection\getACFLayout(),
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
                    'value' => 'page-templates/page-request-demo.php'
                ]
            ]
        ]
    ]);
});
