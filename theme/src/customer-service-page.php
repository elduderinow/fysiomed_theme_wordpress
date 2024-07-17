<?php

/**
 * Template Name: Customer Service Page
 * Description: Customer Service Page.
 */


if (!class_exists('Timber')) {
    echo 'Timber not activated. Make sure you activate the plugin in <a href="/wp-admin/plugins.php#timber">/wp-admin/plugins.php</a>';
    return;
}

use Classes\PostType\Page;
use Classes\Helper\ContentHelper;
use Classes\General\MetaData;

$context = Timber::get_context();
$current_post = get_queried_object();

$helper = new ContentHelper();
$context['page'] = new Page($current_post);
$context['metaData'] = MetaData::constructFromPost($current_post);

Timber::render('customer-service-page.twig', $context);
