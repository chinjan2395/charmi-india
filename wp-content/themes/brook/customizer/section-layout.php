<?php
$section  = 'layout';
$priority = 1;
$prefix   = 'site_';

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => $prefix . 'layout',
	'label'       => esc_html__( 'Layout', 'brook' ),
	'description' => esc_html__( 'Controls the site layout.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 'wide',
	'choices'     => array(
		'boxed' => esc_html__( 'Boxed', 'brook' ),
		'wide'  => esc_html__( 'Wide', 'brook' ),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'dimension',
	'settings'    => $prefix . 'width',
	'label'       => esc_html__( 'Site Width', 'brook' ),
	'description' => esc_html__( 'Controls the overall site width. Enter value including any valid CSS unit. For e.g: 1200px.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '1200px',
) );
