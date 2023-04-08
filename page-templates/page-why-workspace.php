<?php

/**
 * Template Name: Why Wrokspace Page
 */

use Timber\Timber;
use Timber\Post;

$context = Timber::get_context();
$context['post'] = new Post();

Timber::render('templates/page-why-workspace.twig', $context);
