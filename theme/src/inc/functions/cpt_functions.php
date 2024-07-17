<?php
//TODO: Enable the correct cpt's & taxonomies for your project

//add_action( 'init', 'cpt_event', 1 );
//add_action( 'init', 'cpt_location', 1 );
//add_action( 'init', 'cpt_person', 1 );
//add_action( 'init', 'cpt_company', 1 );
//add_action( 'init', 'cpt_job', 1 );
//add_action( 'init', 'cpt_testimonial', 1 );
//add_action( 'init', 'cpt_faq', 1 );
//add_action( 'init', 'cpt_project', 1 );

//add_action( 'init', 'tax_job_contract', 0 );
//add_action( 'init', 'tax_job_regime', 0 );
//add_action( 'init', 'tax_faq_topic', 0 );

/* CUSTOM POSTTYPES */
function cpt_event() {
    $labels = array(
        'name'                => _x( 'Event', 'Post Type General Name', 'vv-theme-01' ),
        'singular_name'       => _x( 'Event', 'Post Type Singular Name', 'vv-theme-01' ),
        'menu_name'           => __( 'Events', 'vv-theme-01' ),
        'parent_item_colon'   => __( 'Hoofditem:', 'vv-theme-01' ),
        'all_items'           => __( 'Alle events', 'vv-theme-01' ),
        'view_item'           => __( 'Bekijk event', 'vv-theme-01' ),
        'add_new_item'        => __( 'Nieuw event', 'vv-theme-01' ),
        'add_new'             => __( 'Voeg event toe', 'vv-theme-01' ),
        'edit_item'           => __( 'Bewerk event', 'vv-theme-01' ),
        'update_item'         => __( 'Bewerk event', 'vv-theme-01' ),
        'search_items'        => __( 'Zoeken', 'vv-theme-01' ),
        'not_found'           => __( 'Niet gevonden', 'vv-theme-01' ),
        'not_found_in_trash'  => __( 'Niet gevonden in prullenbak', 'vv-theme-01' ),
    );
    $args = array(
        'label'               => __( 'Event', 'vv-theme-01' ),
        'description'         => __( 'Event', 'vv-theme-01' ),
        'labels'              => $labels,
        'supports'            => array( 'title','thumbnail', 'editor', 'excerpt'),
        'hierarchical'        => true,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => __('events', 'vv-theme-01'),
        'menu_icon'   		  => 'dashicons-calendar',
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',
    );
    register_post_type( 'event', $args );
}

function cpt_location() {
    $labels = array(
        'name'                => _x( 'Locatie', 'Post Type General Name', 'vv-theme-01' ),
        'singular_name'       => _x( 'Locatie', 'Post Type Singular Name', 'vv-theme-01' ),
        'menu_name'           => __( 'Locaties', 'vv-theme-01' ),
        'parent_item_colon'   => __( 'Hoofditem:', 'vv-theme-01' ),
        'all_items'           => __( 'Alle locaties', 'vv-theme-01' ),
        'view_item'           => __( 'Bekijk locatie', 'vv-theme-01' ),
        'add_new_item'        => __( 'Nieuwe locatie', 'vv-theme-01' ),
        'add_new'             => __( 'Voeg locatie toe', 'vv-theme-01' ),
        'edit_item'           => __( 'Bewerk locatie', 'vv-theme-01' ),
        'update_item'         => __( 'Bewerk locatie', 'vv-theme-01' ),
        'search_items'        => __( 'Zoeken', 'vv-theme-01' ),
        'not_found'           => __( 'Niet gevonden', 'vv-theme-01' ),
        'not_found_in_trash'  => __( 'Niet gevonden in prullenbak', 'vv-theme-01' ),
    );
    $args = array(
        'label'               => __( 'Locatie', 'vv-theme-01' ),
        'description'         => __( 'Locatie', 'vv-theme-01' ),
        'labels'              => $labels,
        'supports'            => array( 'title','thumbnail','excerpt'),
        'hierarchical'        => true,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => __('locations', 'vv-theme-01'),
        'menu_icon'   		  => 'dashicons-building',
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',
    );
    register_post_type( 'location', $args );
}

function cpt_person() {
    $labels = array(
        'name'                => _x( 'Persoon', 'Post Type General Name', 'vv-theme-01' ),
        'singular_name'       => _x( 'Persoon', 'Post Type Singular Name', 'vv-theme-01' ),
        'menu_name'           => __( 'Personen', 'vv-theme-01' ),
        'parent_item_colon'   => __( 'Hoofditem:', 'vv-theme-01' ),
        'all_items'           => __( 'Alle personen', 'vv-theme-01' ),
        'view_item'           => __( 'Bekijk persoon', 'vv-theme-01' ),
        'add_new_item'        => __( 'Nieuwe persoon', 'vv-theme-01' ),
        'add_new'             => __( 'Voeg persoon toe', 'vv-theme-01' ),
        'edit_item'           => __( 'Bewerk persoon', 'vv-theme-01' ),
        'update_item'         => __( 'Bewerk persoon', 'vv-theme-01' ),
        'search_items'        => __( 'Zoeken', 'vv-theme-01' ),
        'not_found'           => __( 'Niet gevonden', 'vv-theme-01' ),
        'not_found_in_trash'  => __( 'Niet gevonden in prullenbak', 'vv-theme-01' ),
    );
    $args = array(
        'label'               => __( 'Persoon', 'vv-theme-01' ),
        'description'         => __( 'Persoon', 'vv-theme-01' ),
        'labels'              => $labels,
        'supports'            => array( 'title','thumbnail', 'editor', 'excerpt'),
        'hierarchical'        => true,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => __('locations', 'vv-theme-01'),
        'menu_icon'   		  => 'dashicons-businessman',
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',
    );
    register_post_type( 'person', $args );
}

function cpt_company() {
    $labels = array(
        'name'                => _x( 'Partner', 'Post Type General Name', 'vv-theme-01' ),
        'singular_name'       => _x( 'Partner', 'Post Type Singular Name', 'vv-theme-01' ),
        'menu_name'           => __( 'Partners', 'vv-theme-01' ),
        'parent_item_colon'   => __( 'Hoofditem:', 'vv-theme-01' ),
        'all_items'           => __( 'Alle partners', 'vv-theme-01' ),
        'view_item'           => __( 'Bekijk partner', 'vv-theme-01' ),
        'add_new_item'        => __( 'Nieuwe partner', 'vv-theme-01' ),
        'add_new'             => __( 'Voeg partner toe', 'vv-theme-01' ),
        'edit_item'           => __( 'Bewerk partner', 'vv-theme-01' ),
        'update_item'         => __( 'Bewerk partner', 'vv-theme-01' ),
        'search_items'        => __( 'Zoeken', 'vv-theme-01' ),
        'not_found'           => __( 'Niet gevonden', 'vv-theme-01' ),
        'not_found_in_trash'  => __( 'Niet gevonden in prullenbak', 'vv-theme-01' ),
    );
    $args = array(
        'label'               => __( 'Partner', 'vv-theme-01' ),
        'description'         => __( 'Partner', 'vv-theme-01' ),
        'labels'              => $labels,
        'supports'            => array( 'title','thumbnail', 'excerpt'),
        'hierarchical'        => true,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => __('locations', 'vv-theme-01'),
        'menu_icon'   		  => 'dashicons-store',
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',
    );
    register_post_type( 'company', $args );
}

function cpt_job() {
    $labels = array(
        'name'                => _x( 'Vacature', 'Post Type General Name', 'vv-theme-01' ),
        'singular_name'       => _x( 'Vacature', 'Post Type Singular Name', 'vv-theme-01' ),
        'menu_name'           => __( 'Vacatures', 'vv-theme-01' ),
        'parent_item_colon'   => __( 'Hoofditem:', 'vv-theme-01' ),
        'all_items'           => __( 'Alle vacatures', 'vv-theme-01' ),
        'view_item'           => __( 'Bekijk vacature', 'vv-theme-01' ),
        'add_new_item'        => __( 'Nieuwe vacature', 'vv-theme-01' ),
        'add_new'             => __( 'Voeg vacature toe', 'vv-theme-01' ),
        'edit_item'           => __( 'Bewerk vacature', 'vv-theme-01' ),
        'update_item'         => __( 'Bewerk vacature', 'vv-theme-01' ),
        'search_items'        => __( 'Zoeken', 'vv-theme-01' ),
        'not_found'           => __( 'Niet gevonden', 'vv-theme-01' ),
        'not_found_in_trash'  => __( 'Niet gevonden in prullenbak', 'vv-theme-01' ),
    );
    $args = array(
        'label'               => __( 'Vacature', 'vv-theme-01' ),
        'description'         => __( 'Vacature', 'vv-theme-01' ),
        'labels'              => $labels,
        'supports'            => array( 'title','thumbnail', 'excerpt'),
        'hierarchical'        => true,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 4,
        'can_export'          => true,
        'has_archive'         => __('vacatures', 'vv-theme-01'),
        'menu_icon'   		  => 'dashicons-id-alt',
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',
    );
    register_post_type( 'job', $args );
}

function cpt_testimonial() {
    $labels = array(
        'name'                => _x( 'Getuigenis', 'Post Type General Name', 'vv-theme-01' ),
        'singular_name'       => _x( 'Getuigenis', 'Post Type Singular Name', 'vv-theme-01' ),
        'menu_name'           => __( 'Getuigenissen', 'vv-theme-01' ),
        'parent_item_colon'   => __( 'Hoofditem:', 'vv-theme-01' ),
        'all_items'           => __( 'Alle getuigenissen', 'vv-theme-01' ),
        'view_item'           => __( 'Bekijk getuigenis', 'vv-theme-01' ),
        'add_new_item'        => __( 'Nieuwe getuigenis', 'vv-theme-01' ),
        'add_new'             => __( 'Voeg getuigenis toe', 'vv-theme-01' ),
        'edit_item'           => __( 'Bewerk getuigenis', 'vv-theme-01' ),
        'update_item'         => __( 'Bewerk getuigenis', 'vv-theme-01' ),
        'search_items'        => __( 'Zoeken', 'vv-theme-01' ),
        'not_found'           => __( 'Niet gevonden', 'vv-theme-01' ),
        'not_found_in_trash'  => __( 'Niet gevonden in prullenbak', 'vv-theme-01' ),
    );
    $args = array(
        'label'               => __( 'Getuigenis', 'vv-theme-01' ),
        'description'         => __( 'Getuigenis', 'vv-theme-01' ),
        'labels'              => $labels,
        'supports'            => array( 'title','thumbnail', 'editor', 'excerpt'),
        'hierarchical'        => true,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => __('testimonials', 'vv-theme-01'),
        'menu_icon'   		  => 'dashicons-megaphone',
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',
    );
    register_post_type( 'testimonial', $args );
}

function cpt_faq() {
    $labels = array(
        'name'                => _x( 'Faq', 'Post Type General Name', 'vv-theme-01' ),
        'singular_name'       => _x( 'Faq', 'Post Type Singular Name', 'vv-theme-01' ),
        'menu_name'           => __( 'Faq', 'vv-theme-01' ),
        'parent_item_colon'   => __( 'Hoofditem:', 'vv-theme-01' ),
        'all_items'           => __( 'Alle faq items', 'vv-theme-01' ),
        'view_item'           => __( 'Bekijk faq item', 'vv-theme-01' ),
        'add_new_item'        => __( 'Nieuwe faq item', 'vv-theme-01' ),
        'add_new'             => __( 'Voeg faq item toe', 'vv-theme-01' ),
        'edit_item'           => __( 'Bewerk faq item', 'vv-theme-01' ),
        'update_item'         => __( 'Bewerk faq item', 'vv-theme-01' ),
        'search_items'        => __( 'Zoeken', 'vv-theme-01' ),
        'not_found'           => __( 'Niet gevonden', 'vv-theme-01' ),
        'not_found_in_trash'  => __( 'Niet gevonden in prullenbak', 'vv-theme-01' ),
    );
    $args = array(
        'label'               => __( 'Faq', 'vv-theme-01' ),
        'description'         => __( 'Faq', 'vv-theme-01' ),
        'labels'              => $labels,
        'supports'            => array( 'title','thumbnail', 'editor', 'excerpt'),
        'hierarchical'        => true,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => __('faq', 'vv-theme-01'),
        'menu_icon'   		  => 'dashicons-editor-help',
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',
    );
    register_post_type( 'faq', $args );
}

function cpt_project() {
    $labels = array(
        'name'                => _x( 'Project', 'Post Type General Name', 'vv-theme-01' ),
        'singular_name'       => _x( 'Project', 'Post Type Singular Name', 'vv-theme-01' ),
        'menu_name'           => __( 'Project', 'vv-theme-01' ),
        'parent_item_colon'   => __( 'Hoofditem:', 'vv-theme-01' ),
        'all_items'           => __( 'Alle projecten', 'vv-theme-01' ),
        'view_item'           => __( 'Bekijk project', 'vv-theme-01' ),
        'add_new_item'        => __( 'Nieuw project', 'vv-theme-01' ),
        'add_new'             => __( 'Voeg project toe', 'vv-theme-01' ),
        'edit_item'           => __( 'Bewerk project', 'vv-theme-01' ),
        'update_item'         => __( 'Bewerk project', 'vv-theme-01' ),
        'search_items'        => __( 'Zoeken', 'vv-theme-01' ),
        'not_found'           => __( 'Niet gevonden', 'vv-theme-01' ),
        'not_found_in_trash'  => __( 'Niet gevonden in prullenbak', 'vv-theme-01' ),
    );
    $args = array(
        'label'               => __( 'Project', 'vv-theme-01' ),
        'description'         => __( 'Project', 'vv-theme-01' ),
        'labels'              => $labels,
        'supports'            => array( 'title','thumbnail', 'editor', 'excerpt'),
        'hierarchical'        => true,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => __('projects', 'vv-theme-01'),
        'menu_icon'   		  => 'dashicons-portfolio',
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',
    );
    register_post_type( 'project', $args );
}

/* CUSTOM TAXONOMIES */
function tax_job_contract() {
    $labels = array(
        'name'          => _x( 'Contract', 'taxonomy general name', 'vv-theme-01'),
        'singular_name' => _x( 'Contract', 'taxonomy singular name', 'vv-theme-01'),
        'menu_name'     => __( 'Contract', 'vv-theme-01'),
    );

    register_taxonomy( 'contract', ['job'], array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'publicly_queryable'=> true,
        'rewrite'           => array( 'slug' => 'contract' ),
    ) );
}

function tax_job_regime() {
    $labels = array(
        'name'          => _x( 'Regime', 'taxonomy general name', 'vv-theme-01'),
        'singular_name' => _x( 'Regime', 'taxonomy singular name', 'vv-theme-01'),
        'menu_name'     => __( 'Regime', 'vv-theme-01'),
    );

    register_taxonomy( 'regime', ['job'], array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'publicly_queryable'=> true,
        'rewrite'           => array( 'slug' => 'regime' ),
    ) );
}

function tax_faq_topic() {
    $labels = array(
        'name'          => _x( 'Topic', 'taxonomy general name', 'vv-theme-01'),
        'singular_name' => _x( 'Topic', 'taxonomy singular name', 'vv-theme-01'),
        'menu_name'     => __( 'Topic', 'vv-theme-01'),
    );

    register_taxonomy( 'topic', ['faq'], array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'publicly_queryable'=> true,
        'rewrite'           => array( 'slug' => 'topic' ),
    ) );
}