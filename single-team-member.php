<?php

use Timber\Timber;
use Timber\Post;
use Flynt\Utils\Options;

$context = Timber::get_context();
$context['post'] = new Post();

$context['hero_background_element_image'] = Options::getGlobal('Team Member Settings', 'hero_background_element_image');
$context['team_member_footer_link_title'] = Options::getGlobal('Team Member Settings', 'team_member_footer_link_title');
$context['team_member_footer_link_url'] = Options::getGlobal('Team Member Settings', 'team_member_footer_link_url');

Timber::render('templates/single-team-member.twig', $context);
