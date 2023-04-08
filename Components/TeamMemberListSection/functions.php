<?php

namespace Flynt\Components\TeamMemberListSection;

function getACFLayout()
{
    return [
        'name' => 'teamMemberListSection',
        'label' => 'Team Member List Section',
        'sub_fields' => [
            
            [
                'label' => 'Leadership Team List Title',
                'name' => 'leadership_list_title',
                'default_value' => 'Leadership Team',
                'type' => 'text',
            ],
            [
                'label' => 'Leadership Team Sub-title',
                'name' => 'leadership_list_subtitle',
                'type' => 'text',
            ],
            
            [
                'label' => 'Leadership Team Members',
                'name' => 'leadership_team',
                'type' => 'repeater',
                'layout' => 'table',
                'button_label' => 'Add Member',
                'sub_fields' => [
                   
                    [
                        'label' => 'Select Team Member',
                        'name' => 'team_member',
                        'type' => 'post_object',
                        'post_type' => 'team-member',
                        'return_format' => 'object',
                        'ui' => 1,
                    ]
                ]
            ],

            [
                'label' => 'Teammates List Title',
                'name' => 'teammates_list_title',
                'default_value' => 'Teammates',
                'type' => 'text',
            ],

            [
                'label' => 'Teammates List Sub-title',
                'name' => 'teammates_list_subtitle',
                'type' => 'text',
            ],

            [
                'label' => 'Teammates',
                'name' => 'teammates',
                'type' => 'repeater',
                'layout' => 'table',
                'button_label' => 'Add Member',
                'sub_fields' => [

                    
                    [
                        'label' => 'Select Team Member',
                        'name' => 'team_member',
                        'type' => 'post_object',
                        'post_type' => 'team-member',
                        'return_format' => 'object',
                        'ui' => 1,
                    ]
                ]
            ]
        ]
    ];
}
