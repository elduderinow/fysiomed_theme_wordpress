<?php

/**
 * My Account navigation
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/navigation.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.6.0
 */

if (!defined('ABSPATH')) {
	exit;
}

do_action('woocommerce_before_account_navigation');
?>
<div class="col-span-12 md:col-span-3">
	<nav class="woocommerce-MyAccount-navigation account-web-nav hidden md:block mt-20">
		<ul>
			<?php foreach (wc_get_account_menu_items() as $endpoint => $label) : ?>
				<li class="<?php echo wc_get_account_menu_item_classes($endpoint); ?>">
					<a href="<?php echo esc_url(wc_get_account_endpoint_url($endpoint)); ?>"><?php echo esc_html($label); ?></a>
				</li>
			<?php endforeach; ?>
		</ul>
	</nav>
	<div class="dropdown account-mobile-nav block md:hidden">
		<label class="hidden" for="account--options">Select:</label>
		<select name="account--options" id="account--options">
			<?php foreach (wc_get_account_menu_items() as $endpoint => $label) : ?>
				<option data-href="<?php echo esc_url(wc_get_account_endpoint_url($endpoint)); ?>" class="<?php echo wc_get_account_menu_item_classes($endpoint); ?>" value="<?php echo esc_html($label); ?>"><?php echo esc_html($label); ?></option>
			<?php endforeach; ?>
		</select>
	</div>
</div>

<?php do_action('woocommerce_after_account_navigation'); ?>