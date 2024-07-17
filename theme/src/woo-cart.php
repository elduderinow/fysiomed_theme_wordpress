<?php

/**
 * Template Name: Woo Cart Page
 * Description: Woocommerce cart page.
 */


if (!class_exists('Timber')) {
    echo 'Timber not activated. Make sure you activate the plugin in <a href="/wp-admin/plugins.php#timber">/wp-admin/plugins.php</a>';
    return;
}

$context = Timber::context();
$context['wc'] = WC(); // Add WooCommerce instance to the context

if (is_cart()) {
    $context['cart'] = WC()->cart;
    $context['permalink'] = get_permalink();
    $context['slug'] = wp_make_link_relative(get_permalink());

    Timber::render('woocommerce/cart.twig', $context);
}
