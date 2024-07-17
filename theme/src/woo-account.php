<?php
/**
 * Template Name: Woo Account Page
 * Description: Woocommerce account page.
 */


 if (!class_exists('Timber')) {
    echo 'Timber not activated. Make sure you activate the plugin in <a href="/wp-admin/plugins.php#timber">/wp-admin/plugins.php</a>';
    return;
}

use Classes\PostType\Location;

$context = Timber::get_context();
$context['wc'] = WC(); // Add WooCommerce instance to the context

Timber::render( array('woocommerce/account.twig'), $context);
