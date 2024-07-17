<?php
/**
 * Template Name: Homepage
 * Description: Homepage.
 */
use Classes\Template\Homepage;
use Classes\General\MetaData;
use Classes\Helper\BaseContentHelper;
use Classes\Helper\WooHelper;

//Init context
$context = Timber::get_context();
$current_post = get_queried_object();
$context['wc'] = WC();

$baseHelper = new BaseContentHelper();
$wooHelper = new WooHelper();

//Add data to context
$context['homepage'] = new Homepage($current_post);
$context['metaData'] = MetaData::constructFromPost($current_post);
$context['newProducts'] = $baseHelper->getEntities('Article',  get_term_by('slug', 'new-product', 'category'), 2);
$context['featuredProducts'] = $wooHelper->getFeaturedProducts(4);

//Render
Timber::render('front-page.twig', $context);
