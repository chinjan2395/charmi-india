<?php
$section  = 'background';
$priority = 1;
$prefix   = 'site_background_';

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="big_title">' . esc_html__( 'Boxed Mode Background', 'brook' ) . '</div>',
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'background',
	'settings'    => $prefix . 'body',
	'label'       => esc_html__( 'Background', 'brook' ),
	'description' => esc_html__( 'Controls outer background area in boxed mode.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => array(
		'background-color'      => '#ffffff',
		'background-image'      => '',
		'background-repeat'     => 'no-repeat',
		'background-size'       => 'cover',
		'background-attachment' => 'fixed',
		'background-position'   => 'center center',
	),
	'output'      => array(
		array(
			'element' => 'body',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="big_title">' . esc_html__( 'Main Content Background', 'brook' ) . '</div>',
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'background',
	'settings'    => $prefix . 'main_content',
	'label'       => esc_html__( 'Background', 'brook' ),
	'description' => esc_html__( 'Controls background of the main content area.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => array(
		'background-color'      => '',
		'background-image'      => '',
		'background-repeat'     => 'no-repeat',
		'background-size'       => 'cover',
		'background-attachment' => 'fixed',
		'background-position'   => 'center center',
	),
	'output'      => array(
		array(
			'element' => '.site',
		),
	),
) );
