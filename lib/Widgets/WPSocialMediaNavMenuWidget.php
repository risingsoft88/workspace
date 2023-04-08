<?php

namespace Flynt\Widgets;

use WP_Widget;

class WPSocialMediaNavMenuWidget extends WP_Widget
{

    public function __construct()
    {
        $widget_ops = array(
            'description'                 => __('Add a social media navigation menu to your sidebar.'),
            'customize_selective_refresh' => true,
        );
        parent::__construct('social_media_nav_menu', __('Social Media Navigation Menu'), $widget_ops);
    }

    public function widget($args, $instance)
    {
        $nav_menu = ! empty($instance['nav_menu']) ? wp_get_nav_menu_object($instance['nav_menu']) : false;

        if (! $nav_menu) {
            return;
        }

        $title = ! empty($instance['title']) ? $instance['title'] : '';

        $title = apply_filters('widget_title', $title, $instance, $this->id_base);

        echo $args['before_widget'];

        if ($title) {
            echo $args['before_title'] . $title . $args['after_title'];
        }
        
        echo '<div class="footer-social-media-list"><ul>';
        $array_menu = wp_get_nav_menu_items($nav_menu);
        foreach ($array_menu as $menu) {
            $image = get_field('icon', $menu->ID);
            echo "<li><a href=\"{$menu->url}\" target=\"{$menu->target}\"><img src=\"{$image}\" /></a></li>";
        }
        echo '</ul></div>';

        echo $args['after_widget'];
    }

    public function update($new_instance, $old_instance)
    {
        $instance = array();
        if (! empty($new_instance['title'])) {
            $instance['title'] = sanitize_text_field($new_instance['title']);
        }
        if (! empty($new_instance['nav_menu'])) {
            $instance['nav_menu'] = (int) $new_instance['nav_menu'];
        }
        return $instance;
    }

    public function form($instance)
    {
        global $wp_customize;
        $title    = isset($instance['title']) ? $instance['title'] : '';
        $nav_menu = isset($instance['nav_menu']) ? $instance['nav_menu'] : '';

        // Get menus.
        $menus = wp_get_nav_menus();

        $empty_menus_style     = '';
        $not_empty_menus_style = '';
        if (empty($menus)) {
            $empty_menus_style = ' style="display:none" ';
        } else {
            $not_empty_menus_style = ' style="display:none" ';
        }

        $nav_menu_style = '';
        if (! $nav_menu) {
            $nav_menu_style = 'display: none;';
        }

        ?>
        <div class="nav-menu-widget-form-controls" <?php echo $empty_menus_style; ?>>
            <p>
                <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
                <input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr($title); ?>"/>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('nav_menu'); ?>"><?php _e('Select Menu:'); ?></label>
                <select id="<?php echo $this->get_field_id('nav_menu'); ?>" name="<?php echo $this->get_field_name('nav_menu'); ?>">
                    <option value="0"><?php _e('&mdash; Select &mdash;'); ?></option>
                    <?php foreach ($menus as $menu) : ?>
                        <option value="<?php echo esc_attr($menu->term_id); ?>" <?php selected($nav_menu, $menu->term_id); ?>>
                            <?php echo esc_html($menu->name); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </p>
            <?php if ($wp_customize instanceof WP_Customize_Manager) : ?>
                <p class="edit-selected-nav-menu" style="<?php echo $nav_menu_style; ?>">
                    <button type="button" class="button"><?php _e('Edit Menu'); ?></button>
                </p>
            <?php endif; ?>
        </div>
        <?php
    }
}
