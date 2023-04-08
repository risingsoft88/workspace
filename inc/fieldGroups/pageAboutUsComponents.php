<?php

use ACFComposer\ACFComposer;
use Flynt\Components;

add_action('Flynt/afterRegisterComponents', function () {
    ACFComposer::registerFieldGroup([
        'name' => 'pageAboutUsComponents',
        'title' => 'Page About Us Components',
        'style' => 'seamless',
        'fields' => [
            [
                'name' => 'pageAboutUsComponents',
                'label' => 'Page About Us Components',
                'type' => 'flexible_content',
                'button_label' => 'Add Component',
                'layouts' => [
                    Components\HeroAboutUsSection\getACFLayout(),
                    Components\BlockContentSection\getACFLayout(),
                    Components\BlockImageText\getACFLayout(),
                    Components\BlockImageText5\getACFLayout(),
                    Components\NavigationSection\getACFLayout(),
                    Components\BlockTwoColumnContentSection\getACFLayout(),
                    Components\TeamSection\getACFLayout(),
                    Components\RequestDemoSection\getACFLayout(),
                    Components\FourColumnsInfoSection\getACFLayout(),
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
                    'value' => 'page-templates/page-about-us.php'
                ]
            ]
        ]
    ]);
});
