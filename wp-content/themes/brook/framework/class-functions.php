<?php
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( '__return_zero_string' ) ) {
	function __return_zero_string() {
		return '0';
	}
}

if ( ! function_exists( '__return_none_string' ) ) {
	function __return_none_string() {
		return 'none';
	}
}

/**
 * Admin notice waning minimum plugin version required.
 *
 * @param $plugin_name
 * @param $plugin_version
 */
function brook_notice_required_plugin_version( $plugin_name, $plugin_version ) {
	if ( isset( $_GET['activate'] ) ) {
		unset( $_GET['activate'] );
	}

	$message = sprintf(
		esc_html__( '%1$s requires %2$s plugin version %3$s or greater!', 'brook' ),
		'<strong>' . BROOK_THEME_NAME . '</strong>',
		'<strong>' . $plugin_name . '</strong>',
		$plugin_version
	);

	printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
}
