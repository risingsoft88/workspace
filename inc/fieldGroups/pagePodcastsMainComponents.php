<?php

use ACFComposer\ACFComposer;
use Flynt\Components;

add_action('Flynt/afterRegisterComponents', function () {
    ACFComposer::registerFieldGroup([
        'name' => 'pagePodcastsMainComponents',
        'title' => 'Page Podcasts Main Components',
        'style' => 'seamless',
        'fields' => [
            [
                'name' => 'pagePodcastsMainComponents',
                'label' => 'Page Podcasts Main Components',
                'type' => 'flexible_content',
                'button_label' => 'Add Component',
                'layouts' => [
                    Components\HeroBlogsMainSection\getACFLayout(),
                    Components\AllPodcastsSection\getACFLayout(),
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
                    'value' => 'page-templates/page-podcasts-main.php'
                ]
            ]
        ]
    ]);
});
