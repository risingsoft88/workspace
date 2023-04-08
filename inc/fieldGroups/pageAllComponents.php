<?php

use ACFComposer\ACFComposer;
use Flynt\Components;

add_action('Flynt/afterRegisterComponents', function () {
    ACFComposer::registerFieldGroup([
        'name' => 'pageAllComponents',
        'title' => 'All Page Components',
        'style' => 'seamless',
        'fields' => [
            [
                'name' => 'pageAllComponents',
                'label' => __('All Page Components', 'flynt'),
                'type' => 'flexible_content',
                'button_label' => __('Add Component', 'flynt'),
                'layouts' => [
                    Components\AllBlogSection\getACFLayout(),
                    Components\AllPodcastsSection\getACFLayout(),
                    Components\BlockCareersTwoColumnContentSection\getACFLayout(),
                    Components\BlockContentSection\getACFLayout(),
                    Components\BlockImageText\getACFLayout(),
                    Components\BlockImageText2\getACFLayout(),
                    Components\BlockImageText3\getACFLayout(),
                    Components\BlockImageText4\getACFLayout(),
                    Components\BlockImageText5\getACFLayout(),
                    Components\BlockTwoColumnContentSection\getACFLayout(),
                    Components\BlueContentFormSection\getACFLayout(),
                    Components\BlueContentSection\getACFLayout(),
                    Components\CaseStudyDetailBlockImageText\getACFLayout(),
                    Components\CaseStudyListSection\getACFLayout(),
                    Components\CompareTableSection\getACFLayout(),
                    Components\FourColumnsInfoSection\getACFLayout(),
                    Components\HeroAboutUsSection\getACFLayout(),
                    Components\HeroBlogsMainSection\getACFLayout(),
                    Components\HeroCareersSection\getACFLayout(),
                    Components\HeroCaseStudiesMainSection\getACFLayout(),
                    Components\HeroCaseStudyDetailSection\getACFLayout(),
                    Components\HeroExecutiveTeamsSection\getACFLayout(),
                    Components\HeroProductDetailSection\getACFLayout(),
                    Components\HeroResourcesSection\getACFLayout(),
                    Components\HeroTextBackgroundSection\getACFLayout(),
                    Components\HeroTextImageSection\getACFLayout(),
                    Components\LogoListSection\getACFLayout(),
                    Components\NavigationSection\getACFLayout(),
                    Components\PostFourColumnSection\getACFLayout(),
                    Components\QuoteSection\getACFLayout(),
                    Components\RequestDemoSection\getACFLayout(),
                    Components\TeamMemberListSection\getACFLayout(),
                    Components\TeamSection\getACFLayout(),
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
                    'value' => 'page-templates/page-all-components.php'
                ],
            ]
        ]
    ]);
});
