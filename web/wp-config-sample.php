<?php

/** @desc this loads the composer autoload file */
require_once dirname( __FILE__ ) . '/vendor/autoload.php';
/** @desc this instantiates Dotenv and passes in our path to .env */
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__FILE__));
$dotenv->load();

// BEGIN iThemes Security - Do not modify or remove this line
// iThemes Security Config Details: 2
define( 'DISALLOW_FILE_EDIT', true ); // Disable File Editor - Security > Settings > WordPress Tweaks > File Editor
// END iThemes Security - Do not modify or remove this line
define( 'ITSEC_ENCRYPTION_KEY', 'Xit2eFhqTENWQCM9d1VYO31WQWpva2A9STE1TnFhUntUQUMrJnlqK3k7XiNDLjw2XWBTTSNvRjtkLntkSmhhYw==' );

/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

/**
 * MySQL settings
 * You can get this info from your web host
 */
defined('DB_NAME') or define('DB_NAME', $_ENV['DB_DATABASE_NAME']);
defined('DB_USER') or define('DB_USER', $_ENV['DB_USERNAME']);
defined('DB_PASSWORD') or define('DB_PASSWORD', $_ENV['DB_PASSWORD']);
defined('DB_HOST') or define('DB_HOST', $_ENV['DB_HOSTNAME']);
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', '');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '02 +$L0,mE{.E-qGy)d_kA^ZOxW-#9|!(PXR>r{L$jYv72).$U*i/+r 9q3/HakV');
define('SECURE_AUTH_KEY',  'LLZ!9%WG@IW6:phVE=U$M+JA-1]pi~-y[B-rQeGVu-MZPnsfnX>PGr(9+y)^[-[;');
define('LOGGED_IN_KEY',    'v$xmYJb;pM+E@iDSQIi{c$O%.^&VI>y_*Q-0I5U>=pG5SuLV:R`V?>}hC >Zzni)');
define('NONCE_KEY',        'QQQy*q@R];ro5?]OES>k)Ji]+ZZB DvIs(2t@5o8D>C_R8l/pakg>ib,9xM6An6F');
define('AUTH_SALT',        '+3e$8TxJKZqbV:A,0s)pt`[CrW.3KUJb,R(8anPu)u|;:0!l+J|- n+G<D-ZXyWn');
define('SECURE_AUTH_SALT', ')<Lq2>O -ugg |O;?R&6VNdu%}_+r@*>%dcj|)?>!e8L81KH|y:-gK|C0 !~$,A.');
define('LOGGED_IN_SALT',   'M0IL|grlI!]uyfPhO?:g(i0]fQQWG-|8h2*;y2AY!u~sww@8~71zB;X7!FJZE62*');
define('NONCE_SALT',       '|rZXlUPWW?5$V}c><)t9#$_3Xsq{d<z.]NJZ,D6&0-2v^+gE7[-Y,hzu~{QDAGJ?');

/**
 * WordPress Paths
 * Important - location of WP & WP-Content folder
*/

defined('WP_CONTENT_DIR') or define('WP_CONTENT_DIR', dirname(__FILE__) . '/wp-content');
defined('WP_CONTENT_URL') or define('WP_CONTENT_URL', $_ENV['WP_DOMAIN_NAME'] . '/wp-content');
defined('WP_HOME') or define('WP_HOME', $_ENV['WP_DOMAIN_NAME']);
defined('WP_SITEURL') or define('WP_SITEURL', $_ENV['WP_DOMAIN_NAME'] . '/wp/');

/**
 * Custom config keys for your theme
 * Declare own config-parameters in this section.
 * e.g. define('MY_CONFIG_KEY', 'value 1234');
 */

defined('GTM_ACTIVE') or define('GTM_ACTIVE', $_ENV['GTM_ACTIVE']);
defined('GTM_KEY') or define('GTM_KEY', $_ENV['GTM_KEY']);



/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */

defined('WP_DEBUG') or define('WP_DEBUG', $_ENV['DEBUG']);
defined('WP_DEBUG_LOG') or define('WP_DEBUG_LOG', $_ENV['DEBUG']);
defined('SAVEQUERIES') or define('SAVEQUERIES', $_ENV['DEBUG']);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
    define('ABSPATH', dirname(__FILE__) . '/');
	
/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
