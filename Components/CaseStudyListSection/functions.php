<?php

namespace Flynt\Components\CaseStudyListSection;

use Timber;

add_filter('Flynt/addComponentData?name=CaseStudyListSection', function ($data) {

    $data['cats'] = Timber::get_terms(
        'case-study-category',
        [
            'hide_empty' => false,
        ]
    );

    $args = [
        'post_type' => 'case-study',
        'orderby' => 'date',
        'order' => 'DESC',
        'posts_per_page' => -1,
        'offset' => 0,
    ];

    $data['case_study_list'] = Timber::get_posts($args);

    return $data;
});

function getACFLayout()
{
    return [
        'name' => 'caseStudyListSection',
        'label' => 'Case Study List Section',
        'sub_fields' => [
            [
                'label' => 'Case Study Category List',
                'name' => 'case_study_category_list',
                'type' => 'repeater',
                'layout' => 'table',
                'button_label' => 'Add Category',
                'sub_fields' => [
                    [
                        'label' => 'Case Study Category',
                        'name' => 'case_study_category',
                        'type' => 'taxonomy',
                        'taxonomy' => 'case-study-category',
                        'field_type' => 'select',
                        'allow_null' => 0,
                        'add_term' => 0,
                        'save_terms' => 0,
                        'load_terms' => 0,
                        'return_format' => 'object',
                        'multiple' => 0,
                    ]
                ]
            ]
        ]
    ];
}
