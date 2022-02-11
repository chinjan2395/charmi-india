<?php
$section  = 'pre_loader';
$priority = 1;
$prefix   = 'pre_loader_';

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'enable',
	'label'    => esc_html__( 'Enable Preloader', 'brook' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '1',
	'choices'  => array(
		'0' => esc_html__( 'No', 'brook' ),
		'1' => esc_html__( 'Yes', 'brook' ),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'select',
	'settings' => $prefix . 'style',
	'label'    => esc_html__( 'Style', 'brook' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => 'brook-loader',
	'choices'  => Brook_Helper::get_preloader_list(),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'background_color',
	'label'       => esc_html__( 'Background Color', 'brook' ),
	'description' => esc_html__( 'Controls the background color for pre loader', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#fff',
	'output'      => array(
		array(
			'element'  => '.page-loading',
			'property' => 'background-color',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'            => 'color-alpha',
	'settings'        => $prefix . 'shape_color',
	'label'           => esc_html__( 'Shape Color', 'brook' ),
	'description'     => esc_html__( 'Controls the background color for pre loader', 'brook' ),
	'section'         => $section,
	'priority'        => $priority++,
	'transport'       => 'auto',
	'default'         => '#0038E3',
	'output'          => array(
		array(
			'element'  => '
			.page-loading .sk-bg-self,
			.page-loading .sk-bg-child > div,
			.page-loading .sk-bg-child-before > div:before
			',
			'property' => 'background-color',
			'suffix'   => '!important',
		),
	),
	'active_callback' => array(
		array(
			'setting'  => 'pre_loader_style',
			'operator' => '!=',
			'value'    => 'brook-loader',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'image',
	'settings' => 'pre_loader_image',
	'label'    => esc_html__( 'Loader Gif Image', 'brook' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => BROOK_THEME_IMAGE_URI . '/brook-preloader.gif',
	'active_callback' => array(
		array(
			'setting'  => 'pre_loader_style',
			'operator' => '==',
			'value'    => 'brook-loader',
		),
	),
) );
