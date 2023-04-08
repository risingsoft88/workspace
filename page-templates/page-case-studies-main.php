<?php

/**
 * Template Name: Case Studies Main Page
 */

use Timber\Timber;
use Timber\Post;

$context = Timber::get_context();
$context['post'] = new Post();

Timber::render('templates/page-case-studies-main.twig', $context);
