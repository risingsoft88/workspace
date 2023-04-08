<?php

use ACFComposer\ACFComposer;
use Flynt\Components;

add_action('Flynt/afterRegisterComponents', function () {
    ACFComposer::registerFieldGroup([
        'name' => 'pageCareersComponents',
        'title' => 'Page Careers Components',
        'style' => 'seamless',
        'fields' => [
            [
                'name' => 'pageCareersComponents',
                'label' => 'Page Careers Components',
                'type' => 'flexible_content',
                'button_label' => 'Add Component',
                'layouts' => [
                    Components\HeroCareersSection\getACFLayout(),
                    Components\BlockCareersTwoColumnContentSection\getACFLayout(),
                    Components\BlueContentSection\getACFLayout(),
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
                    'value' => 'page-templates/page-careers.php'
                ]
            ]
        ]
    ]);
});
