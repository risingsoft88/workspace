<?php

namespace Flynt\Components\SiteFooter;

use Timber;
use Flynt\Utils\Asset;
use Flynt\Utils\Options;

add_action('init', function () {
    register_nav_menus([
        'social_media_footer_menu' => __('Social Media Footer Menu', 'flynt'),
    ]);
});

add_action('widgets_init', function () {
    register_widget('Flynt\Widgets\WPSocialMediaNavMenuWidget');
    register_widget('Flynt\Widgets\WPCustomNavMenuWidget');

    $shared_args = array(
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
        'before_widget' => '<div class="widget %2$s"><div class="widget-content">',
        'after_widget'  => '</div></div>',
    );
    
    register_sidebar(
        array_merge(
            $shared_args,
            array(
                'name'        => __('Footer #1', 'flynt'),
                'id'          => 'sidebar-1',
                'description' => __('Widgets in this area will be displayed in the second column in the footer.', 'flynt'),
            )
        )
    );

    register_sidebar(
        array_merge(
            $shared_args,
            array(
                'name'        => __('Footer #2', 'flynt'),
                'id'          => 'sidebar-2',
                'description' => __('Widgets in this area will be displayed in the second column in the footer.', 'flynt'),
            )
        )
    );
    
    register_sidebar(
        array_merge(
            $shared_args,
            array(
                'name'        => __('Footer #3', 'flynt'),
                'id'          => 'sidebar-3',
                'description' => __('Widgets in this area will be displayed in the third column in the footer.', 'flynt'),
            )
        )
    );
    
    register_sidebar(
        array_merge(
            $shared_args,
            array(
                'name'        => __('Footer #4', 'flynt'),
                'id'          => 'sidebar-4',
                'description' => __('Widgets in this area will be displayed in the fourth column in the footer.', 'flynt'),
            )
        )
    );
});

add_filter('Flynt/addComponentData?name=SiteFooter', function ($data) {
    $data['footer_menu'] = new Timber\Menu('footer_menu');

    $data['footer_widget_1'] = Timber::get_widgets('sidebar-1');
    $data['footer_widget_2'] = Timber::get_widgets('sidebar-2');
    $data['footer_widget_3'] = Timber::get_widgets('sidebar-3');
    $data['footer_widget_4'] = Timber::get_widgets('sidebar-4');

    $data['footer_logo'] = [
        'src' => Asset::requireUrl('Components/SiteFooter/Assets/footer-logo.svg'),
        'alt' => get_bloginfo('name')
    ];

    $data['footer_title'] = Options::getGlobal('Footer Settings', 'footer_title');
    $data['footer_copyright'] = Options::getGlobal('Footer Settings', 'footer_copyright');
    $data['footer_links'] = Options::getGlobal('Footer Settings', 'footer_links');

    return $data;
});

if (function_exists('acf_add_local_field_group')) :
    acf_add_local_field_group(array(
        'key' => 'group_5f31326e1eafc',
        'title' => 'Social Media Footer Menu Metabox',
        'fields' => array(
            array(
                'key' => 'field_5f31327acc5b7',
                'label' => 'Icon',
                'name' => 'icon',
                'type' => 'image',
                'return_format' => 'url',
                'preview_size' => 'medium',
                'library' => 'all',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'nav_menu_item',
                    'operator' => '==',
                    'value' => 'location/social_media_footer_menu',
                ),
            ),
        ),
    ));
endif;
