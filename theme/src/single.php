<?php
/**
 * The Template for displaying a single article
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

use Classes\PostType\Article;
use Classes\Helper\ContentHelper;
use Classes\General\MetaData;

$helper = new ContentHelper();
$context = Timber::get_context();
$current_post = get_queried_object();

$context['article'] = new Article($current_post);
$context['metaData'] = MetaData::constructFromPost($current_post);

Timber::render( array('single.twig'), $context);
