<?php

/**
 * Template Name: Account Registration pagina
 * Description: Pagina met registratie formullier.
 */

use Classes\PostType\Page;
use Classes\Helper\ContentHelper;
use Classes\General\MetaData;

$context = Timber::get_context();
$current_post = get_queried_object();

$helper = new ContentHelper();
$context['page'] = new Page($current_post);
$context['metaData'] = MetaData::constructFromPost($current_post);
Timber::render(array("page-account-registration.twig"), $context);
