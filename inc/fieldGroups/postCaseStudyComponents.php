<?php

use ACFComposer\ACFComposer;
use Flynt\Components;

add_action('Flynt/afterRegisterComponents', function () {
    ACFComposer::registerFieldGroup([
        'name' => 'postCaseStudyComponents',
        'title' => 'Post Case Study Components',
        'style' => 'seamless',
        'fields' => [
            [
                'name' => 'postCaseStudyComponents',
                'label' => 'Post Case Study Components',
                'type' => 'flexible_content',
                'button_label' => 'Add Component',
                'layouts' => [
                    Components\HeroCaseStudyDetailSection\getACFLayout(),
                    Components\CaseStudyDetailBlockImageText\getACFLayout(),
                    Components\BlueContentFormSection\getACFLayout(),
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
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'case-study'
                ]
            ]
        ]
    ]);
});
