<?php

/**
 * Template Name: Request Demo Page
 */

use Timber\Timber;
use Timber\Post;

$context = Timber::get_context();
$context['post'] = new Post();

Timber::render('templates/page-request-demo.twig', $context);
