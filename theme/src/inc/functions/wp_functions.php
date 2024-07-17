<?php
add_post_type_support('page', 'excerpt');

add_filter('timber/context', 'add_to_context');
function add_to_context($context)
{
	$context['wpml_languages'] = get_wpml_languages();
	$context['top_menu'] = new \Timber\Menu('top_menu');
	$context['main_menu'] = new \Timber\Menu('main_menu');
	$context['footer_menu'] = new \Timber\Menu('footer_menu');
	$context['customer_menu'] = new \Timber\Menu('customer_menu');
	$context['gdpr_menu'] = new \Timber\Menu('gdpr_menu');
	$context['global_search'] = \Timber::get_widgets('products_search');
	if (is_user_logged_in()) {
		$context['current_user'] = new \Timber\User();;
	}
	return $context;
}

// getWpml Languages
function get_wpml_languages()
{
	$existing_languages = apply_filters('wpml_active_languages', NULL, 'skip_missing=0&orderby=KEY&order=DIR');
	$mapped_lang = array_map(function ($value, $key) {
		return $value;
	}, $existing_languages, array_keys($existing_languages));
	$current_lang = apply_filters('wpml_current_language', NULL);
	$wpml_lang = ['languages' => $mapped_lang, 'current_lang' => $current_lang];

	return $wpml_lang;
}

//Add custom headings to TinyMCE
add_filter('mce_buttons_2', 'vv_add_headings');
function vv_add_headings($headings)
{
	array_unshift($headings, 'styleselect');
	return $headings;
}
add_filter('tiny_mce_before_init', 'vv_insert_headings');
function vv_insert_headings($init_array)
{
	$style_formats = array(
		array(
			'title' => 'Linkknop',
			'classes' => 'btn btn--primary',
			'selector' => 'a',
		)
	);
	$init_array['style_formats'] = json_encode($style_formats);
	return $init_array;
}

function fysio_widgets_init()
{

	register_sidebar(array(
		'name' => 'zoeken',
		'id' => 'products_search',
		'before_widget' => '<div class="global--search-bar">',
		'after_widget' => '</div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	));

	register_sidebar(array(
		'name' => 'products filter',
		'id' => 'products_filter',
		'before_widget' => '<div class="products_filter">',
		'after_widget' => '</div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	));
}

add_action('widgets_init', 'fysio_widgets_init');

function custom_login_redirect()
{
	if (!is_user_logged_in() && is_admin()) {
		wp_redirect(site_url('/wp-login'));
		exit;
	}

	if (isset($_GET['checkemail']) && $_GET['checkemail'] === 'confirm') {
		wp_redirect(site_url('/wp-login?checkemail=confirm'));
	}

	if (isset($_GET['action']) && $_GET['action'] === 'lostpassword') {
		wp_redirect(site_url('/wp-login/?action=lostpassword'));
	}
}
add_action('init', 'custom_login_redirect');

add_role('export_customer', 'Export klant', array(
	'read' => true
));
