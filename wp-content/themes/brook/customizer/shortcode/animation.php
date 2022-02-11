<?php
$section  = 'shortcode_animation';
$priority = 1;
$prefix   = 'shortcode_animation_';

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => $prefix . 'enable',
	'label'       => esc_html__( 'Css Animation', 'brook' ),
	'description' => esc_html__( 'Controls the css animations on mobile & tablet.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'desktop',
	'choices'     => array(
		'none'    => esc_html__( 'None', 'brook' ),
		'mobile'  => esc_html__( 'Only Mobile', 'brook' ),
		'desktop' => esc_html__( 'Only Desktop', 'brook' ),
		'both'    => esc_html__( 'All Devices', 'brook' ),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'dimension',
	'settings'    => 'shortcode_animation_svg_duration',
	'label'       => esc_html__( 'SVG Animation Duration', 'brook' ),
	'description' => esc_html__( 'Leave blank to use default: 150 (ms). Ex: 300', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
) );
