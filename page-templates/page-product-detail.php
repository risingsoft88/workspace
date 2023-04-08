<?php

/**
 * Template Name: Product Detail Page
 */

use Timber\Timber;
use Timber\Post;

$context = Timber::get_context();
$context['post'] = new Post();

Timber::render('templates/page-product-detail.twig', $context);
