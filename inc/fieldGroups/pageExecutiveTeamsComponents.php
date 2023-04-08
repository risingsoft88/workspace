<?php

use ACFComposer\ACFComposer;
use Flynt\Components;

add_action('Flynt/afterRegisterComponents', function () {
    ACFComposer::registerFieldGroup([
        'name' => 'pageExecutiveTeamsComponents',
        'title' => 'Page Executive Teams Components',
        'style' => 'seamless',
        'fields' => [
            [
                'name' => 'pageExecutiveTeamsComponents',
                'label' => 'Page Executive Teams Components',
                'type' => 'flexible_content',
                'button_label' => 'Add Component',
                'layouts' => [
                    Components\HeroExecutiveTeamsSection\getACFLayout(),
                    Components\TeamMemberListSection\getACFLayout(),
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
                    'value' => 'page-templates/page-executive-teams.php'
                ]
            ]
        ]
    ]);
});
