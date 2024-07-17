<?php

/**
 * Template Name: password reset
 * Description: custom password reset.
 */

use Classes\PostType\Page;
use Classes\Helper\ContentHelper;
use Classes\General\MetaData;

$context = Timber::get_context();
$current_post = get_queried_object();

$context['page'] = new Page($current_post);
$context['metaData'] = MetaData::constructFromPost($post);

Timber::render('wp-password-reset.twig', $context);
