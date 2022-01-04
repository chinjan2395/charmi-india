<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'charmiindia' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         's5!(A$xdhnQVPoYT]0RBL7^I&;4JS#V7m7}5)fCc3X,n44H_^t]j[&#vLW)zu[Tu' );
define( 'SECURE_AUTH_KEY',  'D;[*SgJU6u.1Is4_8Siuh:)Tji/q^_ }UuNcWT+H>`g*e^hd|QM9#ws<v#sU.@8(' );
define( 'LOGGED_IN_KEY',    'A+g%.Wh!Mr)yo}7QLKR5@eenjuNM=wyyW>ov`5whKU(S27<aCjC4@Nq7QS>PR@,B' );
define( 'NONCE_KEY',        'ui#8?3S2nTmOKxW<T^ c)2FIVS=NS@/ACM~&VvS-/X<bk(~}x]^/T8J/ivF<:!NG' );
define( 'AUTH_SALT',        'V#>R7cGWVsCp:]G{ejQI3[[;pP>l7cu5OdB<GUW`Ma^2#nDsnL+Il&^KqHk]&_>|' );
define( 'SECURE_AUTH_SALT', 'cM1!NKkab3N<8z*hGM+nuABmW_X5czmh|_lc1bZ=<yO04cW8#dmJ<_P:_|om6xG8' );
define( 'LOGGED_IN_SALT',   'Ax;h+]yR1Yrb+^a)A*RcR,rKqi*OsWPp(.7>xUx+Cxnj9J.`4`qf}I8N7*%_o<2$' );
define( 'NONCE_SALT',       'Y&TPF3eQo}7`&hVV8JyF6WA_`I9x[.(;(4~jBS.YozJ(iypVUJ;RL*Mlyp;3|.7e' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', true );
// Disable display of errors and warnings
define( 'WP_DEBUG_DISPLAY', true );
@ini_set( 'display_errors', 1 );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
