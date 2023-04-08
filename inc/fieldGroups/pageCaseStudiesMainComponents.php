<?php

use ACFComposer\ACFComposer;
use Flynt\Components;

add_action('Flynt/afterRegisterComponents', function () {
    ACFComposer::registerFieldGroup([
        'name' => 'pageCaseStudiesMainComponents',
        'title' => 'Page Case Studies Main Components',
        'style' => 'seamless',
        'fields' => [
            [
                'name' => 'pageCaseStudiesMainComponents',
                'label' => 'Page Case Studies Main Components',
                'type' => 'flexible_content',
                'button_label' => 'Add Component',
                'layouts' => [
                    Components\HeroCaseStudiesMainSection\getACFLayout(),
                    Components\CaseStudyListSection\getACFLayout(),
                    Components\QuoteSection\getACFLayout(),
                    Components\RequestDemoSection\getACFLayout(),
                    Components\EmptySection\getACFLayout(),
                    Components\PostOneColumnSection\getACFLayout(),
                ]
            ]
        ],
        'location' => [
            [
                [
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'page-templates/page-case-studies-main.php'
                ]
            ]
        ]
    ]);
});
