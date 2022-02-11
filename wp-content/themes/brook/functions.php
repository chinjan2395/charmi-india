<?php
/**
 * Define constant
 */
$theme = wp_get_theme();

if ( ! empty( $theme['Template'] ) ) {
	$theme = wp_get_theme( $theme['Template'] );
}

if ( ! defined( 'DS' ) ) {
	define( 'DS', DIRECTORY_SEPARATOR );
}

define( 'BROOK_THEME_NAME', $theme['Name'] );
define( 'BROOK_THEME_VERSION', $theme['Version'] );
define( 'BROOK_THEME_DIR', get_template_directory() );
define( 'BROOK_THEME_URI', get_template_directory_uri() );
define( 'BROOK_THEME_IMAGE_DIR', get_template_directory() . DS . 'assets' . DS . 'images' );
define( 'BROOK_THEME_IMAGE_URI', get_template_directory_uri() . '/assets/images' );
define( 'BROOK_CHILD_THEME_URI', get_stylesheet_directory_uri() );
define( 'BROOK_CHILD_THEME_DIR', get_stylesheet_directory() );
define( 'BROOK_FRAMEWORK_DIR', get_template_directory() . DS . 'framework' );
define( 'BROOK_CUSTOMIZER_DIR', BROOK_THEME_DIR . DS . 'customizer' );
define( 'BROOK_WIDGETS_DIR', BROOK_THEME_DIR . DS . 'widgets' );
define( 'BROOK_VC_MAPS_DIR', BROOK_THEME_DIR . DS . 'vc-extend' . DS . 'vc-maps' );
define( 'BROOK_VC_PARAMS_DIR', BROOK_THEME_DIR . DS . 'vc-extend' . DS . 'vc-params' );
define( 'BROOK_VC_SHORTCODE_CATEGORY', esc_html__( 'By', 'brook' ) . ' ' . BROOK_THEME_NAME );
define( 'BROOK_PROTOCOL', is_ssl() ? 'https' : 'http' );

require_once BROOK_FRAMEWORK_DIR . '/class-static.php';

$files = array(
	BROOK_FRAMEWORK_DIR . '/class-init.php',
	BROOK_FRAMEWORK_DIR . '/class-helper.php',
	BROOK_FRAMEWORK_DIR . '/class-functions.php',
	BROOK_FRAMEWORK_DIR . '/class-global.php',
	BROOK_FRAMEWORK_DIR . '/class-actions-filters.php',
	BROOK_FRAMEWORK_DIR . '/class-admin.php',
	BROOK_FRAMEWORK_DIR . '/class-compatible.php',
	BROOK_FRAMEWORK_DIR . '/class-customize.php',
	BROOK_FRAMEWORK_DIR . '/class-nav-menu.php',
	BROOK_FRAMEWORK_DIR . '/class-enqueue.php',
	BROOK_FRAMEWORK_DIR . '/class-image.php',
	BROOK_FRAMEWORK_DIR . '/class-minify.php',
	BROOK_FRAMEWORK_DIR . '/class-color.php',
	BROOK_FRAMEWORK_DIR . '/class-maintenance.php',
	BROOK_FRAMEWORK_DIR . '/class-import.php',
	BROOK_FRAMEWORK_DIR . '/class-instagram.php',
	BROOK_FRAMEWORK_DIR . '/class-kirki.php',
	BROOK_FRAMEWORK_DIR . '/class-metabox.php',
	BROOK_FRAMEWORK_DIR . '/class-plugins.php',
	BROOK_FRAMEWORK_DIR . '/class-custom-css.php',
	BROOK_FRAMEWORK_DIR . '/class-templates.php',
	BROOK_FRAMEWORK_DIR . '/class-aqua-resizer.php',
	BROOK_FRAMEWORK_DIR . '/class-visual-composer.php',
	BROOK_FRAMEWORK_DIR . '/class-visual-composer-templates.php',
	BROOK_FRAMEWORK_DIR . '/class-vc-icon-fontawesome5.php',
	BROOK_FRAMEWORK_DIR . '/class-vc-icon-ion.php',
	BROOK_FRAMEWORK_DIR . '/class-vc-icon-linea.php',
	BROOK_FRAMEWORK_DIR . '/class-vc-icon-linea-svg.php',
	BROOK_FRAMEWORK_DIR . '/class-walker-nav-menu.php',
	BROOK_FRAMEWORK_DIR . '/class-widget.php',
	BROOK_FRAMEWORK_DIR . '/class-widgets.php',
	BROOK_FRAMEWORK_DIR . '/class-footer.php',
	BROOK_FRAMEWORK_DIR . '/class-post-type-blog.php',
	BROOK_FRAMEWORK_DIR . '/class-post-type-portfolio.php',
	BROOK_FRAMEWORK_DIR . '/class-woo.php',
	BROOK_FRAMEWORK_DIR . '/tgm-plugin-activation.php',
	BROOK_FRAMEWORK_DIR . '/tgm-plugin-registration.php',
	BROOK_FRAMEWORK_DIR . '/class-performance.php',
	BROOK_FRAMEWORK_DIR . '/class-tha.php',
);

/**
 * Load Framework.
 */
Brook::require_files( $files );

/**
 * Init the theme
 */
Brook_Init::instance();
