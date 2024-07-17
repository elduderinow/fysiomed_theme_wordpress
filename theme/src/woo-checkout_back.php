<?php

/**
 * Template Name: Woo Checkout Page
 * Description: Woocommerce checkout page.
 */


if (!class_exists('Timber')) {
    echo 'Timber not activated. Make sure you activate the plugin in <a href="/wp-admin/plugins.php#timber">/wp-admin/plugins.php</a>';
    return;
}

$context = Timber::context();

if (is_checkout()) {
    $context['checkout'] = WC()->checkout;
    $context['permalink'] = get_permalink();
    $context['slug'] = wp_make_link_relative(get_permalink());

    //get billing fields
    $billing_fields = WC()->checkout->get_checkout_fields('billing');
    $posted_data = WC()->checkout->get_posted_data();

    $context['billing_fields'] = array();
    $fields = WC()->checkout()->get_checkout_fields('billing');

    foreach ($fields as $key => $field) {
        if ($key === 'billing_country') {
            $field['type'] = 'select';
            $field['options'] = WC()->countries->get_countries();
        }

        $context['billing_fields'][$key] = $field;
    }

    //get shipping fields
    $context['shipping_fields'] = array();
    $fields = WC()->checkout()->get_checkout_fields('shipping');

    foreach ($fields as $key => $field) {
        if ($key === 'shipping_country') {
            $field['type'] = 'select';
            $field['options'] = WC()->countries->get_countries();
        }

        $field['value'] = isset($posted_data['ship_to_different_address']) ? $posted_data['ship_to_different_address'] : '';
        $context['shipping_fields'][$key] = $field;
    }


    // Check if the 'shipping' checkbox is selected
    if (isset($_POST['shipping']) && $_POST['shipping'] == 'shipping') {
        // Set the billing fields' values equal to the shipping fields' values
        $billing_fields['billing_address_1']['value'] = $_POST['shipping_address_1'];
        $billing_fields['billing_address_2']['value'] = $_POST['shipping_address_2'];
        $billing_fields['billing_address_3']['value'] = $_POST['shipping_address_3'];
        $billing_fields['billing_city']['value'] = $_POST['shipping_city'];
        $billing_fields['billing_postcode']['value'] = $_POST['shipping_postcode'];
        $billing_fields['billing_country']['value'] = $_POST['shipping_country'];
    }


    //get order summary
    $order = wc_create_order();
    $cart = WC()->cart;

    foreach ($cart->get_cart() as $cart_item) {
        $product = $cart_item['data'];
        $order->add_product($product, $cart_item['quantity']);
    }

    $order->calculate_totals();

    $context['order_review'] = wc_get_template_html('checkout/review-order.php', array('order' => $order));

    Timber::render('woocommerce/checkout.twig', $context);
}
