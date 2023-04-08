<?php

/**
 * Template Name: All Components Page
 */

use Timber\Timber;
use Timber\Post;

$context = Timber::get_context();
$context['post'] = new Post();

Timber::render('templates/page-all-components.twig', $context);
