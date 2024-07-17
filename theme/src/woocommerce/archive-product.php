<?php
/**
 * Template Name: Shop
 * Description: Overview page for products
 */
use Classes\Helper\WooHelper;
use Classes\PostType\Page;
use Classes\General\MetaData;
use Classes\Helper\ContentHelper;

$wooHelper = new WooHelper();
$contentHelper = new ContentHelper();
$context = Timber::get_context();

$current_object = get_queried_object();
$posts = Timber::get_posts();
$products = $contentHelper->createEntitiesFromPosts('Product', $posts);

$title = __("Alle producten", "fysiomed");
if (is_product_category() || is_product_tag()) {
	$queried_object = get_queried_object();
	$term_id = $current_object->term_id;
	$term = get_term($term_id, $queried_object->taxonomy);
	$context['term'] = $term;
	$title = single_term_title('', false);
}

$context['products'] = $products['items'];
$context['title'] = $title;
$context['sidebar'] = Timber::get_widgets('main_sidebar');
$context['metaData'] = MetaData::constructFromData($title, $current_object->description, "","","","");
$context['products_filter'] = \Timber::get_widgets('products_filter');

Timber::render('woocommerce/archive.twig', $context);
?>