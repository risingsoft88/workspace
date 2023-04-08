<?php

use ACFComposer\ACFComposer;
use Flynt\Components;

add_action('Flynt/afterRegisterComponents', function () {
    ACFComposer::registerFieldGroup([
        'name' => 'pageHomeComponents',
        'title' => 'Page Home Components',
        'style' => 'seamless',
        'fields' => [
            [
                'name' => 'pageHomeComponents',
                'label' => 'Page Home Components',
                'type' => 'flexible_content',
                'button_label' => 'Add Component',
                'layouts' => [
                    Components\RequestDemoSection\getACFLayout(),
                    Components\LogoListSection\getACFLayout(),
                    Components\BlockContentSection\getACFLayout(),
                    Components\BlockImageText\getACFLayout(),
                    Components\BlueContentSection\getACFLayout(),
                    Components\PostFourColumnSection\getACFLayout(),
                    Components\TestimonialSliderSection\getACFLayout(),
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
                    'value' => 'page-templates/page-home.php'
                ]
            ]
        ]
    ]);
});
