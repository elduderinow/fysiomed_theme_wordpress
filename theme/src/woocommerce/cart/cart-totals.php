<?php

/**
 * Cart totals
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-totals.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.3.6
 */

defined('ABSPATH') || exit;

?>
<div class="space-y-8 cart_totals <?php echo (WC()->customer->has_calculated_shipping()) ? 'calculated_shipping' : ''; ?>">

	<?php do_action('woocommerce_before_cart_totals'); ?>

	<!-- subtotal -->
	<div class="subtotal flex justify-between items-start">
		<p><?php esc_html_e('Subtotal', 'woocommerce'); ?></p>
		<p data-title="<?php esc_attr_e('Subtotal', 'woocommerce'); ?>" class=" p-text"><?php wc_cart_totals_subtotal_html(); ?>
			<span class="p-small">incl. recupel</span>
		</p>
	</div>
	<!-- subtotal -->

	<!-- discount -->
	<?php foreach (WC()->cart->get_coupons() as $code => $coupon) : ?>
		<div class="discount flex justify-between items-start coupon-<?php echo esc_attr(sanitize_title($code)); ?>">
			<p><?php wc_cart_totals_coupon_label($coupon); ?></p>
			<p data-title="<?php echo esc_attr(wc_cart_totals_coupon_label($coupon, false)); ?>" class=" p-text"><?php wc_cart_totals_coupon_html($coupon); ?>
			</p>
		</div>
	<?php endforeach; ?>
	<!-- discount -->

	<!-- shipping -->
	<?php if (WC()->cart->needs_shipping() && WC()->cart->show_shipping()) : ?>

		<?php do_action('woocommerce_cart_totals_before_shipping'); ?>

		<?php wc_cart_totals_shipping_html(); ?>

		<?php do_action('woocommerce_cart_totals_after_shipping'); ?>

	<?php elseif (WC()->cart->needs_shipping() && 'yes' === get_option('woocommerce_enable_shipping_calc')) : ?>

		<div class="delivery flex flex-col justify-between items-start">
			<p class="p-text -mb-2" data-title="<?php esc_attr_e('Shipping', 'woocommerce'); ?>"><?php esc_html_e('Shipping', 'woocommerce'); ?></p>
			<?php woocommerce_shipping_calculator(); ?>
		</div>
	<?php endif; ?>
	<!-- shipping -->

	<!-- fee ??? -->
	<?php foreach (WC()->cart->get_fees() as $fee) : ?>
		<div class="fee flex justify-between items-start">
			<p><?php echo esc_html($fee->name); ?></p>
			<p data-title="<?php echo esc_attr($fee->name); ?>" class="p-text"><?php wc_cart_totals_fee_html($fee); ?></p>
		</div>
	<?php endforeach; ?>
	<!-- fee -->

	<!-- tax -->
	<?php
	if (wc_tax_enabled() && !WC()->cart->display_prices_including_tax()) {
		$taxable_address = WC()->customer->get_taxable_address();
		$estimated_text  = '';

		if (WC()->customer->is_customer_outside_base() && !WC()->customer->has_calculated_shipping()) {
			/* translators: %s location. */
			$estimated_text = sprintf(' <small>' . esc_html__('(estimated for %s)', 'woocommerce') . '</small>', WC()->countries->estimated_for_prefix($taxable_address[0]) . WC()->countries->countries[$taxable_address[0]]);
		}

		if ('itemized' === get_option('woocommerce_tax_total_display')) {
			foreach (WC()->cart->get_tax_totals() as $code => $tax) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
	?>
				<div class="tax-rate tax-rate-<?php echo esc_attr(sanitize_title($code)); ?> flex justify-between items-start">
					<p><?php echo esc_html($tax->label) . $estimated_text; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
						?></p>
					<p data-title="<?php echo esc_attr($tax->label); ?>" class="p-text"><?php echo wp_kses_post($tax->formatted_amount); ?></p>
				</div>
			<?php
			}
		} else {
			?>
			<div class="tax-total flex justify-between items-start">
				<p><?php echo esc_html(WC()->countries->tax_or_vat()) . $estimated_text; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
					?></p>
				<p data-title="<?php echo esc_attr(WC()->countries->tax_or_vat()); ?>" class="p-text"><?php wc_cart_totals_taxes_total_html(); ?></p>
			</div>
	<?php
		}
	}
	?>
	<!-- tax -->


	<?php do_action('woocommerce_cart_totals_before_order_total'); ?>

	<div class="total flex justify-between items-start">
		<p><?php esc_html_e('Total', 'woocommerce'); ?></p>
		<p data-title="<?php esc_attr_e('Total', 'woocommerce'); ?>" class="p-text"><?php wc_cart_totals_order_total_html(); ?>
			<span class="p-small">excl. btw</span>
		</p>
	</div>

	<?php do_action('woocommerce_cart_totals_after_order_total'); ?>


	<div class="wc-proceed-to-checkout">
		<?php do_action('woocommerce_proceed_to_checkout'); ?>
	</div>


	<?php do_action('woocommerce_after_cart_totals'); ?>

</div>