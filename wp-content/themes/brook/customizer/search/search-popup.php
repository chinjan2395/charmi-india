<?php
$section  = 'search_popup';
$priority = 1;
$prefix   = 'search_popup_';

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'header_bg',
	'label'       => esc_html__( 'Header Background Color', 'brook' ),
	'description' => esc_html__( 'Controls the background color of search popup header', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#fff',
	'output'      => array(
		array(
			'element'  => '.page-search-popup-header',
			'property' => 'background',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'multicolor',
	'settings'    => $prefix . 'close_button_color',
	'label'       => esc_html__( 'Close Button Color', 'brook' ),
	'description' => esc_html__( 'Controls the color of close button.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'choices'     => array(
		'default' => esc_attr__( 'Default Color', 'brook' ),
		'hover'   => esc_attr__( 'Hover Color', 'brook' ),
	),
	'output'      => array(
		array(
			'choice'   => 'default',
			'element'  => '.page-close-search',
			'property' => 'color',
		),
		array(
			'choice'   => 'hover',
			'element'  => '.page-close-search',
			'property' => 'color',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'bg_color',
	'label'       => esc_html__( 'Background Color', 'brook' ),
	'description' => esc_html__( 'Controls the background color of the search popup content.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#000000',
	'output'      => array(
		array(
			'element'  => '.page-search-popup > .inner',
			'property' => 'background',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'text_color',
	'label'       => esc_html__( 'Text Color', 'brook' ),
	'description' => esc_html__( 'Controls the text color search field.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#fff',
	'output'      => array(
		array(
			'element'  => '
			.page-search-popup .search-form,
			.page-search-popup .search-field:focus
			',
			'property' => 'color',
		),
		array(
			'element'  => '.page-search-popup .search-field:-webkit-autofill',
			'property' => '-webkit-text-fill-color',
			'suffix'   => '!important',
		),
	),
) );
