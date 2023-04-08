<?php

use Timber\Timber;
use Timber\Post;
use Flynt\Utils\Options;

$context = Timber::get_context();
$context['post'] = new Post();

$context['role_footer_form_background_image'] = Options::getGlobal('Role Settings', 'role_footer_form_background_image');
$context['role_footer_form_content'] = Options::getGlobal('Role Settings', 'role_footer_form_content');
$context['role_footer_gravity_form_shortcode'] = Options::getGlobal('Role Settings', 'role_footer_gravity_form_shortcode');

Timber::render('templates/single-role.twig', $context);
