<?php

use ACFComposer\ACFComposer;
use Flynt\Components;

add_action('Flynt/afterRegisterComponents', function () {
    ACFComposer::registerFieldGroup([
        'name' => 'pageWhyWorkspaceComponents',
        'title' => 'Page Why Workspace Components',
        'style' => 'seamless',
        'fields' => [
            [
                'name' => 'pageWhyWorkspaceComponents',
                'label' => 'Page Why Workspace Components',
                'type' => 'flexible_content',
                'button_label' => 'Add Component',
                'layouts' => [
                    Components\HeroTextImageSection\getACFLayout(),
                    Components\BlockContentSection\getACFLayout(),
                    Components\FourColumnsInfoSection\getACFLayout(),
                    Components\BlockImageText2\getACFLayout(),
                    Components\CompareTableSection\getACFLayout(),
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
                    'value' => 'page-templates/page-why-workspace.php'
                ]
            ]
        ]
    ]);
});
