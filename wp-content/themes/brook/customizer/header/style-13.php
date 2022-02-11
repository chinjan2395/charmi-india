<?php
$section  = 'header_style_13';
$priority = 1;
$prefix   = 'header_style_13_';

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'overlay',
	'label'    => esc_html__( 'Header Overlay', 'brook' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '0',
	'choices'  => array(
		'0' => esc_html__( 'No', 'brook' ),
		'1' => esc_html__( 'Yes', 'brook' ),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'logo',
	'label'    => esc_html__( 'Logo', 'brook' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => 'light',
	'choices'  => array(
		'light' => esc_html__( 'Light', 'brook' ),
		'dark'  => esc_html__( 'Dark', 'brook' ),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'search_enable',
	'label'    => esc_html__( 'Search', 'brook' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '0',
	'choices'  => array(
		'0' => esc_html__( 'Hide', 'brook' ),
		'1' => esc_html__( 'Show', 'brook' ),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'cart_enable',
	'label'    => esc_html__( 'Mini Cart', 'brook' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '0',
	'choices'  => array(
		'0'             => esc_html__( 'Hide', 'brook' ),
		'1'             => esc_html__( 'Show', 'brook' ),
		'hide_on_empty' => esc_html__( 'Hide On Empty', 'brook' ),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'textarea',
	'settings'    => $prefix . 'text',
	'label'       => esc_html__( 'Text', 'brook' ),
	'description' => esc_html__( 'Controls the text that display on right side', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => wp_kses( __( '<h6><span class="fa fa-heart"></span> Hello, we are brook studio</h6>', 'brook' ), 'brook-default' ),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'border_width',
	'label'     => esc_html__( 'Border Bottom Width', 'brook' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => 0,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 0,
		'max'  => 50,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.header-13 .page-header-inner',
			'property' => 'border-bottom-width',
			'units'    => 'px',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'border_color',
	'label'       => esc_html__( 'Border Color', 'brook' ),
	'description' => esc_html__( 'Controls the border color.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#222',
	'output'      => array(
		array(
			'element'  => '.header-13 .page-header-inner',
			'property' => 'border-color',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'box_shadow',
	'label'       => esc_html__( 'Box Shadow', 'brook' ),
	'description' => esc_html__( 'Input box shadow for header. For e.g: 0 0 5px #ccc', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'output'      => array(
		array(
			'element'  => '.header-13 .page-header-inner',
			'property' => 'box-shadow',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'background',
	'settings'    => $prefix . 'left_background',
	'label'       => esc_html__( 'Header Left Background', 'brook' ),
	'description' => esc_html__( 'Controls the background of header.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => array(
		'background-color'      => '#222',
		'background-image'      => '',
		'background-repeat'     => 'no-repeat',
		'background-size'       => 'cover',
		'background-attachment' => 'scroll',
		'background-position'   => 'center center',
	),
	'output'      => array(
		array(
			'element' => '.header-13 .page-header-inner .header-left-wrap',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'background',
	'settings'    => $prefix . 'right_background',
	'label'       => esc_html__( 'Header Left Background', 'brook' ),
	'description' => esc_html__( 'Controls the background of header.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => array(
		'background-color'      => '#19d2a8',
		'background-image'      => '',
		'background-repeat'     => 'no-repeat',
		'background-size'       => 'cover',
		'background-attachment' => 'scroll',
		'background-position'   => 'center center',
	),
	'output'      => array(
		array(
			'element' => '.header-13 .page-header-inner .header-right-wrap',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'header_icon_color',
	'label'       => esc_html__( 'Icon Color', 'brook' ),
	'description' => esc_html__( 'Controls the color of icons on header.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#fff',
	'output'      => array(
		array(
			'element'  => '
			.header-13 .page-open-mobile-menu,
			.header-13 .page-open-main-menu,
			.header-13 .popup-search-wrap i,
			.header-13 .mini-cart .mini-cart-icon',
			'property' => 'color',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'header_icon_hover_color',
	'label'       => esc_html__( 'Icon Hover Color', 'brook' ),
	'description' => esc_html__( 'Controls the color when hover of icons on header.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#fff',
	'output'      => array(
		array(
			'element'  => '
			.header-13 .page-open-main-menu:hover,
			.header-13 .page-open-mobile-menu:hover i,
			.header-13 .popup-search-wrap:hover i,
			.header-13 .mini-cart .mini-cart-icon:hover
			',
			'property' => 'color',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'cart_badge_background_color',
	'label'       => esc_html__( 'Cart Badge Background Color', 'brook' ),
	'description' => esc_html__( 'Controls the background color of cart badge.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#fff',
	'output'      => array(
		array(
			'element'  => '.header-13 .mini-cart .mini-cart-icon:after',
			'property' => 'background-color',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'cart_badge_color',
	'label'       => esc_html__( 'Cart Badge Color', 'brook' ),
	'description' => esc_html__( 'Controls the color of cart badge.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#222',
	'output'      => array(
		array(
			'element'  => '.header-13 .mini-cart .mini-cart-icon:after',
			'property' => 'color',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Header Sticky', 'brook' ) . '</div>',
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'background',
	'settings'    => $prefix . 'sticky_background',
	'label'       => esc_html__( 'Background', 'brook' ),
	'description' => esc_html__( 'Controls the background of header when sticky.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => array(
		'background-color'      => '#fff',
		'background-image'      => '',
		'background-repeat'     => 'no-repeat',
		'background-size'       => 'cover',
		'background-attachment' => 'scroll',
		'background-position'   => 'center center',
	),
	'output'      => array(
		array(
			'element' => '.header-13.headroom--not-top .page-header-inner',
		),
	),
) );
