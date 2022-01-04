<?php
/**
 * WPCmedical engine room
 *
 * @package wpcmedical
 */

/**
 * Assign the WPCmedical version to a var
 */
$wpcmedical_theme   = wp_get_theme( 'wpcmedical' );
$wpcmedical_version = $wpcmedical_theme['Version'];

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 980; /* pixels */
}

$wpcmedical = (object) array(
	'version'    => $wpcmedical_version,
	'main'       => require 'inc/class-wpcmedical.php',
	'customizer' => require 'inc/customizer/class-wpcmedical-customizer.php',
);

require 'inc/wpcmedical-functions.php';
require 'inc/wpcmedical-template-hooks.php';
require 'inc/wpcmedical-template-functions.php';
require 'inc/wpcmedical-notice.php';
require 'inc/wordpress-shims.php';

if ( wpcmedical_is_woocommerce_activated() ) {
	$wpcmedical->woocommerce = require 'inc/woocommerce/class-wpcmedical-woocommerce.php';

	require 'inc/woocommerce/wpcmedical-woocommerce-template-hooks.php';
	require 'inc/woocommerce/wpcmedical-woocommerce-template-functions.php';
	require 'inc/woocommerce/wpcmedical-woocommerce-functions.php';
}