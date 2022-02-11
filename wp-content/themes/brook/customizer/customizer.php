<?php
/**
 * Theme Customizer
 *
 * @package Brook
 * @since   1.0
 */

/**
 * Setup configuration
 */
Brook_Kirki::add_config( 'theme', array(
	'option_type' => 'theme_mod',
	'capability'  => 'edit_theme_options',
) );

/**
 * Add sections
 */
$priority = 1;

Brook_Kirki::add_section( 'layout', array(
	'title'    => esc_html__( 'Layout', 'brook' ),
	'priority' => $priority++,
) );

Brook_Kirki::add_section( 'color_', array(
	'title'    => esc_html__( 'Colors', 'brook' ),
	'priority' => $priority++,
) );

Brook_Kirki::add_section( 'background', array(
	'title'    => esc_html__( 'Background', 'brook' ),
	'priority' => $priority++,
) );

Brook_Kirki::add_section( 'typography', array(
	'title'    => esc_html__( 'Typography', 'brook' ),
	'priority' => $priority++,
) );

Brook_Kirki::add_panel( 'top_bar', array(
	'title'    => esc_html__( 'Top bar', 'brook' ),
	'priority' => $priority++,
) );

Brook_Kirki::add_panel( 'header', array(
	'title'    => esc_html__( 'Header', 'brook' ),
	'priority' => $priority++,
) );

Brook_Kirki::add_section( 'logo', array(
	'title'       => esc_html__( 'Logo', 'brook' ),
	'description' => '<div class="desc">
			<strong class="insight-label insight-label-info">' . esc_html__( 'IMPORTANT NOTE: ', 'brook' ) . '</strong>
			<p>' . esc_html__( 'These settings can be overridden by settings from Page Options Box in separator page.', 'brook' ) . '</p>
			<p><img src="' . BROOK_THEME_IMAGE_URI . '/customize/logo-settings.jpg" alt="' . esc_attr__( 'logo-settings', 'brook' ) . '"/></p>
		</div>',
	'priority'    => $priority++,
) );

Brook_Kirki::add_panel( 'navigation', array(
	'title'    => esc_html__( 'Navigation', 'brook' ),
	'priority' => $priority++,
) );

Brook_Kirki::add_section( 'sliders', array(
	'title'    => esc_html__( 'Sliders', 'brook' ),
	'priority' => $priority++,
) );

Brook_Kirki::add_panel( 'title_bar', array(
	'title'    => esc_html__( 'Page Title Bar', 'brook' ),
	'priority' => $priority++,
) );

Brook_Kirki::add_section( 'sidebars', array(
	'title'    => esc_html__( 'Sidebars', 'brook' ),
	'priority' => $priority++,
) );

Brook_Kirki::add_panel( 'footer', array(
	'title'    => esc_html__( 'Footer', 'brook' ),
	'priority' => $priority++,
) );

Brook_Kirki::add_panel( 'blog', array(
	'title'    => esc_html__( 'Blog', 'brook' ),
	'priority' => $priority++,
) );

Brook_Kirki::add_panel( 'portfolio', array(
	'title'    => esc_html__( 'Portfolio', 'brook' ),
	'priority' => $priority++,
) );

Brook_Kirki::add_panel( 'shop', array(
	'title'    => esc_html__( 'Shop', 'brook' ),
	'priority' => $priority++,
) );

Brook_Kirki::add_section( 'socials', array(
	'title'    => esc_html__( 'Social Networks', 'brook' ),
	'priority' => $priority++,
) );

Brook_Kirki::add_section( 'social_sharing', array(
	'title'    => esc_html__( 'Social Sharing', 'brook' ),
	'priority' => $priority++,
) );

Brook_Kirki::add_panel( 'search', array(
	'title'    => esc_html__( 'Search & Popup Search', 'brook' ),
	'priority' => $priority++,
) );

Brook_Kirki::add_section( 'error404_page', array(
	'title'    => esc_html__( 'Error 404 Page', 'brook' ),
	'priority' => $priority++,
) );

Brook_Kirki::add_panel( 'maintenance', array(
	'title'    => esc_html__( 'Coming Soon & Maintenance', 'brook' ),
	'priority' => $priority++,
) );

Brook_Kirki::add_panel( 'shortcode', array(
	'title'    => esc_html__( 'Shortcodes', 'brook' ),
	'priority' => $priority++,
) );

Brook_Kirki::add_panel( 'advanced', array(
	'title'    => esc_html__( 'Advanced', 'brook' ),
	'priority' => $priority++,
) );

Brook_Kirki::add_panel( 'notices', array(
	'title'    => esc_html__( 'Notices', 'brook' ),
	'priority' => $priority++,
) );

Brook_Kirki::add_section( 'custom_code', array(
	'title'    => esc_html__( 'Custom Code', 'brook' ),
	'priority' => $priority++,
) );

Brook_Kirki::add_section( 'settings_preset', array(
	'title'    => esc_html__( 'Settings Preset', 'brook' ),
	'priority' => $priority++,
) );

Brook_Kirki::add_section( 'performance', array(
	'title'    => esc_html__( 'Performance', 'brook' ),
	'priority' => $priority++,
) );

/**
 * Load panel & section files
 */
$files = array(
	BROOK_CUSTOMIZER_DIR . '/section-color.php',

	BROOK_CUSTOMIZER_DIR . '/top_bar/_panel.php',
	BROOK_CUSTOMIZER_DIR . '/top_bar/general.php',
	BROOK_CUSTOMIZER_DIR . '/top_bar/style-01.php',

	BROOK_CUSTOMIZER_DIR . '/header/_panel.php',
	BROOK_CUSTOMIZER_DIR . '/header/general.php',
	BROOK_CUSTOMIZER_DIR . '/header/sticky.php',
	BROOK_CUSTOMIZER_DIR . '/header/style-01.php',
	BROOK_CUSTOMIZER_DIR . '/header/style-02.php',
	BROOK_CUSTOMIZER_DIR . '/header/style-03.php',
	BROOK_CUSTOMIZER_DIR . '/header/style-04.php',
	BROOK_CUSTOMIZER_DIR . '/header/style-05.php',
	BROOK_CUSTOMIZER_DIR . '/header/style-06.php',
	BROOK_CUSTOMIZER_DIR . '/header/style-07.php',
	BROOK_CUSTOMIZER_DIR . '/header/style-08.php',
	BROOK_CUSTOMIZER_DIR . '/header/style-09.php',
	BROOK_CUSTOMIZER_DIR . '/header/style-10.php',
	BROOK_CUSTOMIZER_DIR . '/header/style-11.php',
	BROOK_CUSTOMIZER_DIR . '/header/style-12.php',
	BROOK_CUSTOMIZER_DIR . '/header/style-13.php',
	BROOK_CUSTOMIZER_DIR . '/header/style-14.php',
	BROOK_CUSTOMIZER_DIR . '/header/style-15.php',
	BROOK_CUSTOMIZER_DIR . '/header/style-16.php',
	BROOK_CUSTOMIZER_DIR . '/header/style-17.php',
	BROOK_CUSTOMIZER_DIR . '/header/style-18.php',
	BROOK_CUSTOMIZER_DIR . '/header/style-19.php',
	BROOK_CUSTOMIZER_DIR . '/header/style-20.php',
	BROOK_CUSTOMIZER_DIR . '/header/style-21.php',
	BROOK_CUSTOMIZER_DIR . '/header/style-22.php',

	BROOK_CUSTOMIZER_DIR . '/navigation/_panel.php',
	BROOK_CUSTOMIZER_DIR . '/navigation/desktop-menu.php',
	BROOK_CUSTOMIZER_DIR . '/navigation/off-canvas-menu.php',
	BROOK_CUSTOMIZER_DIR . '/navigation/mobile-menu.php',

	BROOK_CUSTOMIZER_DIR . '/section-sliders.php',

	BROOK_CUSTOMIZER_DIR . '/title_bar/_panel.php',
	BROOK_CUSTOMIZER_DIR . '/title_bar/general.php',
	BROOK_CUSTOMIZER_DIR . '/title_bar/style-01.php',
	BROOK_CUSTOMIZER_DIR . '/title_bar/style-02.php',
	BROOK_CUSTOMIZER_DIR . '/title_bar/style-03.php',
	BROOK_CUSTOMIZER_DIR . '/title_bar/style-04.php',
	BROOK_CUSTOMIZER_DIR . '/title_bar/style-05.php',

	BROOK_CUSTOMIZER_DIR . '/footer/_panel.php',
	BROOK_CUSTOMIZER_DIR . '/footer/general.php',
	BROOK_CUSTOMIZER_DIR . '/footer/simple.php',
	BROOK_CUSTOMIZER_DIR . '/footer/style-01.php',
	BROOK_CUSTOMIZER_DIR . '/footer/style-02.php',
	BROOK_CUSTOMIZER_DIR . '/footer/style-03.php',
	BROOK_CUSTOMIZER_DIR . '/footer/style-04.php',
	BROOK_CUSTOMIZER_DIR . '/footer/style-05.php',
	BROOK_CUSTOMIZER_DIR . '/footer/style-06.php',

	BROOK_CUSTOMIZER_DIR . '/advanced/_panel.php',
	BROOK_CUSTOMIZER_DIR . '/advanced/advanced.php',
	BROOK_CUSTOMIZER_DIR . '/advanced/pre-loader.php',
	BROOK_CUSTOMIZER_DIR . '/advanced/light-gallery.php',

	BROOK_CUSTOMIZER_DIR . '/section-notices.php',

	BROOK_CUSTOMIZER_DIR . '/shortcode/_panel.php',
	BROOK_CUSTOMIZER_DIR . '/shortcode/animation.php',

	BROOK_CUSTOMIZER_DIR . '/section-background.php',
	BROOK_CUSTOMIZER_DIR . '/section-custom.php',
	BROOK_CUSTOMIZER_DIR . '/section-error404.php',
	BROOK_CUSTOMIZER_DIR . '/section-layout.php',
	BROOK_CUSTOMIZER_DIR . '/section-logo.php',

	BROOK_CUSTOMIZER_DIR . '/blog/_panel.php',
	BROOK_CUSTOMIZER_DIR . '/blog/single.php',

	BROOK_CUSTOMIZER_DIR . '/portfolio/_panel.php',
	BROOK_CUSTOMIZER_DIR . '/portfolio/archive.php',
	BROOK_CUSTOMIZER_DIR . '/portfolio/single.php',
	BROOK_CUSTOMIZER_DIR . '/portfolio/fullscreen-type-hover-portfolio.php',
	BROOK_CUSTOMIZER_DIR . '/portfolio/fullscreen-type-hover-02-portfolio.php',
	BROOK_CUSTOMIZER_DIR . '/portfolio/fullscreen-type-hover-03-portfolio.php',

	BROOK_CUSTOMIZER_DIR . '/shop/_panel.php',
	BROOK_CUSTOMIZER_DIR . '/shop/general.php',
	BROOK_CUSTOMIZER_DIR . '/shop/archive.php',
	BROOK_CUSTOMIZER_DIR . '/shop/single.php',
	BROOK_CUSTOMIZER_DIR . '/shop/cart.php',

	BROOK_CUSTOMIZER_DIR . '/search/_panel.php',
	BROOK_CUSTOMIZER_DIR . '/search/search-page.php',
	BROOK_CUSTOMIZER_DIR . '/search/search-popup.php',

	BROOK_CUSTOMIZER_DIR . '/maintenance/_panel.php',
	BROOK_CUSTOMIZER_DIR . '/maintenance/general.php',
	BROOK_CUSTOMIZER_DIR . '/maintenance/maintenance.php',
	BROOK_CUSTOMIZER_DIR . '/maintenance/coming-soon-01.php',

	BROOK_CUSTOMIZER_DIR . '/section-sharing.php',
	BROOK_CUSTOMIZER_DIR . '/section-sidebars.php',
	BROOK_CUSTOMIZER_DIR . '/section-socials.php',
	BROOK_CUSTOMIZER_DIR . '/section-typography.php',

	BROOK_CUSTOMIZER_DIR . '/section-preset.php',

	BROOK_CUSTOMIZER_DIR . '/section-performance.php',
);

Brook::require_files( $files );
