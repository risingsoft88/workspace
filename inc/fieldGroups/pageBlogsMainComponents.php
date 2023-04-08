<?php

use ACFComposer\ACFComposer;
use Flynt\Components;

add_action('Flynt/afterRegisterComponents', function () {
    ACFComposer::registerFieldGroup([
        'name' => 'pageBlogsMainComponents',
        'title' => 'Page Blogs Main Components',
        'style' => 'seamless',
        'fields' => [
            [
                'name' => 'pageBlogsMainComponents',
                'label' => 'Page Blogs Main Components',
                'type' => 'flexible_content',
                'button_label' => 'Add Component',
                'layouts' => [
                    Components\HeroBlogsMainSection\getACFLayout(),
                    Components\AllBlogSection\getACFLayout(),
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
                    'value' => 'page-templates/page-blogs-main.php'
                ]
            ]
        ]
    ]);
});
