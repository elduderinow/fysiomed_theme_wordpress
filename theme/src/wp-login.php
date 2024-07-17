<?php

/**
 * Template Name: custom login
 * Description: custom password forget.
 */

use Classes\PostType\Page;
use Classes\Helper\ContentHelper;
use Classes\General\MetaData;

$context = Timber::get_context();
$current_post = get_queried_object();

$context['page'] = new Page($current_post);
$context['metaData'] = MetaData::constructFromPost($post);

foreach ($_GET as $param_name => $param_value) {
    $param_name = sanitize_text_field($param_name);
    $param_value = sanitize_text_field($param_value);

    $context['query'] = array(
        'name' => $param_name,
        'value' => $param_value
    );
}

Timber::render('wp-login.twig', $context);
