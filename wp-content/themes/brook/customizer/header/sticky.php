<?php
$section  = 'header_sticky';
$priority = 1;
$prefix   = 'header_sticky_';

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'toggle',
	'settings'    => $prefix . 'enable',
	'label'       => esc_html__( 'Enable', 'brook' ),
	'description' => esc_html__( 'Enable this option to turn on header sticky feature.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 1,
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => $prefix . 'behaviour',
	'label'       => esc_html__( 'Behaviour', 'brook' ),
	'description' => esc_html__( 'Controls the behaviour of header sticky when you scroll down to page', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'both',
	'choices'     => array(
		'both' => esc_html__( 'Sticky on scroll up/down', 'brook' ),
		'up'   => esc_html__( 'Sticky on scroll up', 'brook' ),
		'down' => esc_html__( 'Sticky on scroll down', 'brook' ),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'height',
	'label'     => esc_html__( 'Height', 'brook' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => 80,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 50,
		'max'  => 200,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.headroom--not-top .page-header-inner .header-wrap',
			'property' => 'min-height',
			'units'    => 'px',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'padding_top',
	'label'     => esc_html__( 'Padding top', 'brook' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => 0,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 0,
		'max'  => 200,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.headroom--not-top .page-header-inner',
			'property' => 'padding-top',
			'units'    => 'px',
			'suffix'   => '!important',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'padding_bottom',
	'label'     => esc_html__( 'Padding bottom', 'brook' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => 0,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 0,
		'max'  => 200,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.headroom--not-top .page-header-inner',
			'property' => 'padding-bottom',
			'units'    => 'px',
			'suffix'   => '!important',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'spacing',
	'settings'    => $prefix . 'item_padding',
	'label'       => esc_html__( 'Item Padding', 'brook' ),
	'description' => esc_html__( 'Controls the navigation item level 1 padding of navigation when sticky.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => array(
		'top'    => '31px',
		'bottom' => '31px',
		'left'   => '18px',
		'right'  => '18px',
	),
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element'  => array(
				'.desktop-menu .headroom--not-top.headroom--not-top .menu--primary .menu__container > li > a',
				'.desktop-menu .headroom--not-top.headroom--not-top .menu--primary .menu__container > ul > li >a',
			),
			'property' => 'padding',
		),
	),
) );
