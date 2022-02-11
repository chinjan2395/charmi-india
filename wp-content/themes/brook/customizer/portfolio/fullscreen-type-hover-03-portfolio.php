<?php
$section  = 'portfolio_fullscreen_type_hover_03';
$priority = 1;
$prefix   = 'portfolio_fullscreen_type_hover_03_';

$categories = array();
$tags       = array();

if ( is_customize_preview() ) {
	$categories = Brook_Portfolio::get_categories();
	$tags       = Brook_Portfolio::get_tags();
}

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => $prefix . 'categories',
	'label'       => esc_html__( 'Filter By Cats', 'brook' ),
	'description' => esc_html__( 'Select categories to filter by.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'multiple'    => 1000,
	'choices'     => $categories,
	'default'     => array(),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => $prefix . 'tags',
	'label'       => esc_html__( 'Filter By Tags', 'brook' ),
	'description' => esc_html__( 'Select tags to filter by.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'multiple'    => 1000,
	'choices'     => $tags,
	'default'     => array( 'hover-type-03' ),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'number',
	'settings'    => $prefix . 'number',
	'label'       => esc_html__( 'Number portfolios', 'brook' ),
	'description' => esc_html__( 'Controls the number of portfolios display on this template.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 5,
	'choices'     => array(
		'min'  => 3,
		'max'  => 30,
		'step' => 1,
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'textarea',
	'settings' => $prefix . 'left_text',
	'label'    => esc_html__( 'Left Text', 'brook' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => esc_html__( '&copy; 2019 Brook. All Rights Reserved.', 'brook' ),
) );

Brook_Customize::field_social_networks_enable( array(
	'settings' => $prefix . 'social_networks_enable',
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '1',
) );
