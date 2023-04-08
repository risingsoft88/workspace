<?php

/**
 * Template Name: Executive Teams Page
 */

use Timber\Timber;
use Timber\Post;

$context = Timber::get_context();
$context['post'] = new Post();

Timber::render('templates/page-executive-teams.twig', $context);
