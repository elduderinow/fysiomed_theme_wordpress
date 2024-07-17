<?php
function theme_add_woocommerce_support()
{
    add_theme_support('woocommerce');
}
function timber_set_product($post)
{
    global $product;

    $product = $post;
}

// Register the custom Twig extension
add_filter('twig_apply_filters', 'register_custom_twig_extensions');
function register_custom_twig_extensions($twig)
{
    $twig->addFunction(new \Twig\TwigFunction('wc_get_product', 'custom_wc_get_product'));
    $twig->addFunction(new \Twig\TwigFunction('wc_get_cart_count', 'vv_get_cart_count'));
    $twig->addFunction(new \Twig\TwigFunction('wc_get_cart_url', 'vv_get_cart_url'));

    return $twig;
}

function vv_get_cart_url()
{
    return wc_get_cart_url();
}

function vv_get_cart_count()
{
    $cart = WC()->cart;
    return $cart->get_cart_contents_count();
}

// Custom implementation of wc_get_product
function custom_wc_get_product($product_id)
{
    return wc_get_product($product_id);
}


function get_product_upsell_ids($product_id)
{
    $product = wc_get_product($product_id);
    $upsell_ids = $product->get_upsell_ids();
    return $upsell_ids;
}

// Add extra content to the after loop items
function after_shop_loop_extra_content()
{
    global $product;
    $product_url = $product->get_permalink();
    echo '<a class="button button__secondary" href="' . $product_url . '">' . $product->add_to_cart_text() . '</a>';
}

add_action('woocommerce_after_shop_loop_item', 'after_shop_loop_extra_content', 10);

// Add custom classes to add to cart button
add_filter('woocommerce_loop_add_to_cart_link', 'my_custom_loop_button_classes', 10, 2);
function my_custom_loop_button_classes($button, $product)
{
    $classes = 'button__primary'; // Replace with your desired classes
    $button = str_replace('button', 'button ' . $classes, $button);
    return $button;
}

// Add custom classes to view button (not working in your original code)
add_filter('woocommerce_loop_product_link', 'my_custom_loop_product_classes', 10, 2);
function my_custom_loop_product_classes($link, $product)
{
    $classes = 'tertiary'; // Replace with your desired classes
    $link = str_replace('class="', 'class="' . $classes . ' ', $link);
    return $link;
}

add_action('after_setup_theme', 'theme_add_woocommerce_support');

remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);

function woocommerce_breadcrumb($args = array())
{
    $args = wp_parse_args(
        $args,
        apply_filters(
            'woocommerce_breadcrumb_defaults',
            array(
                'delimiter'   => '<span>&#47</span>',
                'wrap_before' => '<nav class="woocommerce-breadcrumb">',
                'wrap_after'  => '</nav>',
                'before'      => '',
                'after'       => '',
                'home'        => _x('Home', 'breadcrumb', 'woocommerce'),
            )
        )
    );

    $breadcrumbs = new WC_Breadcrumb();

    if (!empty($args['home'])) {
        $breadcrumbs->add_crumb($args['home'], apply_filters('woocommerce_breadcrumb_home_url', home_url()));
    }

    $args['breadcrumb'] = $breadcrumbs->generate();

    /**
     * WooCommerce Breadcrumb hook
     *
     * @hooked WC_Structured_Data::generate_breadcrumblist_data() - 10
     */
    do_action('woocommerce_breadcrumb', $breadcrumbs, $args);

    wc_get_template('global/breadcrumb.php', $args);
}


/**
 * Hide shipping rates when free shipping is available.
 * Updated to support WooCommerce 2.6 Shipping Zones.
 *
 * @param array $rates Array of rates found for the package.
 * @return array
 */
function my_hide_shipping_when_free_is_available( $rates ) {
	$free = array();
	foreach ( $rates as $rate_id => $rate ) {
        
		if ( 'free_shipping' === $rate->method_id ) {
			$free[ $rate_id ] = $rate;
			break;
		}
	}
	return ! empty( $free ) ? $free : $rates;
}
add_filter( 'woocommerce_package_rates', 'my_hide_shipping_when_free_is_available', 100 );