<?php

/**
 * Template Name: About Us Page
 */

use Timber\Timber;
use Timber\Post;

$context = Timber::get_context();
$context['post'] = new Post();

Timber::render('templates/page-about-us.twig', $context);
