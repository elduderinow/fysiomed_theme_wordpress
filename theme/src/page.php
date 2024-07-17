<?php
/**
 * The template for displaying standard pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * To generate specific templates for your pages you can use:
 * /mytheme/views/page-mypage.twig
 * (which will still route through this PHP file)
 * OR
 * /mytheme/page-mypage.php
 * (in which case you'll want to duplicate this file and save to the above path)
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

use Classes\PostType\Page;
use Classes\Helper\ContentHelper;
use Classes\General\MetaData;

$context = Timber::get_context();
$current_post = get_queried_object();

$helper = new ContentHelper();
$context['page'] = new Page($current_post);
$context['metaData'] = MetaData::constructFromPost($current_post);



Timber::render('page.twig', $context);
