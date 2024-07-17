<?php

/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

do_action('woocommerce_before_customer_login_form'); ?>

<?php if ('yes' === get_option('woocommerce_enable_myaccount_registration')) : ?>
	<div class="col-span-12 lg:col-span-5">
		<div class="login-wrapper mt-20">
			<h2 class="title"><?php esc_html_e('Login', 'woocommerce'); ?></h2>
			<p>Dit is nodig omdat wij onze prijzen enkel beschikbaar stellen voor onze geregistreerde klanten. Zo kunnen wij u ook een gepersonaliseerde ervaring bieden en u beter van dienst zijn.</p>
			<form class="space-y-6 my-6" method="post">

				<?php do_action('woocommerce_login_form_start'); ?>

				<div class="flex flex-col">
					<label class="p-text" for="username"><?php esc_html_e('Username or email address', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
					<input type="text" class="" name="username" id="username" autocomplete="username" value="<?php echo (!empty($_POST['username'])) ? esc_attr(wp_unslash($_POST['username'])) : ''; ?>" /><?php // @codingStandardsIgnoreLine 
																																																			?>
				</div>
				<div class="flex flex-col">
					<label class="p-text" for="password"><?php esc_html_e('Password', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
					<input class="" type="password" name="password" id="password" autocomplete="current-password" />
				</div>

				<?php do_action('woocommerce_login_form'); ?>

				<div class="flex flex-col">
					<label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
						<input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span class="p-text"><?php esc_html_e('Remember me', 'woocommerce'); ?></span>
						<span class="checkmark"></span>
					</label>
				</div>
				<div class="submit">
					<?php wp_nonce_field('woocommerce-login', 'woocommerce-login-nonce'); ?>
					<button type="submit" class="button--main button__secondary woocommerce-form-login__submit<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>" name="login" value="<?php esc_attr_e('Log in', 'woocommerce'); ?>"><?php esc_html_e('Log in', 'woocommerce'); ?></button>
				</div>

				<?php do_action('woocommerce_login_form_end'); ?>

			</form>
		</div>

	<?php endif; ?>

	<!--
	<?php if ('yes' === get_option('woocommerce_enable_myaccount_registration')) : ?>


		<div class="registration-wrapper mt-20 hidden">

			<h2 class="title"><?php esc_html_e('Register', 'woocommerce'); ?></h2>

			<form method="post" class="space-y-6 my-6" <?php do_action('woocommerce_register_form_tag'); ?>>

				<?php do_action('woocommerce_register_form_start'); ?>

				<?php if ('no' === get_option('woocommerce_registration_generate_username')) : ?>

					<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
						<label for="reg_username"><?php esc_html_e('Username', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
						<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" autocomplete="username" value="<?php echo (!empty($_POST['username'])) ? esc_attr(wp_unslash($_POST['username'])) : ''; ?>" /><?php // @codingStandardsIgnoreLine 
																																																																		?>
					</p>

				<?php endif; ?>

				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
					<label for="reg_email"><?php esc_html_e('Email address', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
					<input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" autocomplete="email" value="<?php echo (!empty($_POST['email'])) ? esc_attr(wp_unslash($_POST['email'])) : ''; ?>" /><?php // @codingStandardsIgnoreLine 
																																																														?>
				</p>

				<?php if ('no' === get_option('woocommerce_registration_generate_password')) : ?>

					<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
						<label for="reg_password"><?php esc_html_e('Password', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
						<input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" autocomplete="new-password" />
					</p>

				<?php else : ?>

					<p><?php esc_html_e('A link to set a new password will be sent to your email address.', 'woocommerce'); ?></p>

				<?php endif; ?>

				<?php do_action('woocommerce_register_form'); ?>

				<div class="submit">
					<?php wp_nonce_field('woocommerce-register', 'woocommerce-register-nonce'); ?>
					<button type="submit" class="button--main button__secondary <?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?> woocommerce-form-register__submit" name="register" value="<?php esc_attr_e('Register', 'woocommerce'); ?>"><?php esc_html_e('Register', 'woocommerce'); ?></button>
				</div>

				<?php do_action('woocommerce_register_form_end'); ?>

			</form>

		</div>
			-->

	<div class="alternate-login flex gap-x-40">
		<div class="woocommerce-LostPassword lost_password">
			<a class="button--main button__arrow text-bold" href="<?php echo esc_url(wp_lostpassword_url()); ?>"><?php esc_html_e('Lost your password?', 'woocommerce'); ?></a>
		</div>
		<div class="register_account">
			<a class="button--main button__arrow text-bold" href="/registreer-account">Nog geen account?</a>
		</div>
	</div>

	</div>
<?php endif; ?>


<div class="account-image col-span-12 lg:col-span-6 lg:col-start-7">
	<div style="aspect-ratio:5/4" class="media--comp">
		<div class="image-wrapper">
			<picture>
				<source media="(max-width:600px)" srcset="">
				<source media="(max-width:1199px)" srcset="">
				<source media="(min-width:1200px)" srcset="">
				<img style="object-position:center center" src="https://images.unsplash.com/photo-1687205931274-a28f08a015b5?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1887&q=80" alt="" />
			</picture>
		</div>
	</div>
</div>

<?php do_action('woocommerce_after_customer_login_form'); ?>