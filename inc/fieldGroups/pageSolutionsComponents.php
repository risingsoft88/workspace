<?php

use ACFComposer\ACFComposer;
use Flynt\Components;

add_action('Flynt/afterRegisterComponents', function () {
    ACFComposer::registerFieldGroup([
        'name' => 'pageSolutionsComponents',
        'title' => 'Page Solutions Components',
        'style' => 'seamless',
        'fields' => [
            [
                'name' => 'pageSolutionsComponents',
                'label' => 'Page Solutions Components',
                'type' => 'flexible_content',
                'button_label' => 'Add Component',
                'layouts' => [
                    Components\HeroTextImageSection\getACFLayout(),
                    Components\BlockContentSection\getACFLayout(),
                    Components\BlockImageText\getACFLayout(),
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
                    'value' => 'page-templates/page-solutions.php'
                ]
            ]
        ]
    ]);
});
