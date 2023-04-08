<?php

use Timber\Timber;
use Timber\Post;
use Flynt\Utils\Options;

$context = Timber::get_context();
$context['post'] = new Post();

$context['benefit_footer_form_background_image'] = Options::getGlobal('Benefit Settings', 'benefit_footer_form_background_image');
$context['benefit_footer_form_content'] = Options::getGlobal('Benefit Settings', 'benefit_footer_form_content');
$context['benefit_footer_gravity_form_shortcode'] = Options::getGlobal('Benefit Settings', 'benefit_footer_gravity_form_shortcode');

Timber::render('templates/single-benefit.twig', $context);
