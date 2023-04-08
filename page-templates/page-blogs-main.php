<?php

/**
 * Template Name: Blogs Main Page
 */

use Timber\Timber;
use Timber\Post;

$context = Timber::get_context();
$context['post'] = new Post();

Timber::render('templates/page-blogs-main.twig', $context);
