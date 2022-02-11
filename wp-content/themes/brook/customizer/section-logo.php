<?php
$section  = 'logo';
$priority = 1;
$prefix   = 'logo_';

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'logo',
	'label'       => esc_html__( 'Default Logo', 'brook' ),
	'description' => esc_html__( 'Choose default logo.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'logo_dark',
	'choices'     => array(
		'logo_dark'  => esc_html__( 'Dark Logo', 'brook' ),
		'logo_light' => esc_html__( 'Light Logo', 'brook' ),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'image',
	'settings' => 'logo_dark',
	'label'    => esc_html__( 'Dark Version', 'brook' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => BROOK_THEME_IMAGE_URI . '/dark-retina-logo.png',
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'image',
	'settings' => 'logo_light',
	'label'    => esc_html__( 'Light Version', 'brook' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => BROOK_THEME_IMAGE_URI . '/light-retina-logo.png',
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'dimension',
	'settings'    => $prefix . 'width',
	'label'       => esc_html__( 'Logo Width', 'brook' ),
	'description' => esc_html__( 'For e.g: 200px', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '170px',
	'output'      => array(
		array(
			'element'  => '.branding__logo img,
			.error404--header .branding__logo img
			',
			'property' => 'width',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'spacing',
	'settings'    => $prefix . 'padding',
	'label'       => esc_html__( 'Logo Padding', 'brook' ),
	'description' => esc_html__( 'For e.g: 30px 0px 30px 0px', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => array(
		'top'    => '15px',
		'right'  => '0px',
		'bottom' => '15px',
		'left'   => '0px',
	),
	'output'      => array(
		array(
			'element'  => '.branding__logo img',
			'property' => 'padding',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Sticky Logo', 'brook' ) . '</div>',
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'dimension',
	'settings'    => 'sticky_logo_width',
	'label'       => esc_html__( 'Logo Width', 'brook' ),
	'description' => esc_html__( 'Controls the width of sticky header logo. For e.g: 120px', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '150px',
	'output'      => array(
		array(
			'element'  => '
			.header-sticky-both .headroom.headroom--not-top .branding img,
			.header-sticky-up .headroom.headroom--not-top.headroom--pinned .branding img,
			.header-sticky-down .headroom.headroom--not-top.headroom--unpinned .branding img
			',
			'property' => 'width',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'spacing',
	'settings'    => 'sticky_logo_padding',
	'label'       => esc_html__( 'Logo Padding', 'brook' ),
	'description' => esc_html__( 'Controls the padding of sticky header logo.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => array(
		'top'    => '0',
		'right'  => '0',
		'bottom' => '0',
		'left'   => '0',
	),
	'output'      => array(
		array(
			'element'  => '.headroom--not-top .branding__logo .sticky-logo',
			'property' => 'padding',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Mobile Menu Logo', 'brook' ) . '</div>',
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'image',
	'settings'    => 'mobile_menu_logo',
	'label'       => esc_html__( 'Logo', 'brook' ),
	'description' => esc_html__( 'Select an image file for mobile menu logo.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => BROOK_THEME_IMAGE_URI . '/mobile-menu-logo.png',
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'dimension',
	'settings'    => 'mobile_logo_width',
	'label'       => esc_html__( 'Logo Width', 'brook' ),
	'description' => esc_html__( 'Controls the width of mobile menu logo. For e.g: 120px', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '115px',
	'output'      => array(
		array(
			'element'  => '.page-mobile-popup-logo img',
			'property' => 'width',
		),
	),
) );
