<?php
$section  = 'light_gallery';
$priority = 1;
$prefix   = 'light_gallery_';

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'background',
	'label'    => esc_html__( 'Background', 'brook' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => 'custom',
	'choices'  => array(
		'primary'   => esc_html__( 'Primary', 'brook' ),
		'secondary' => esc_html__( 'Secondary', 'brook' ),
		'custom'    => esc_html__( 'Custom', 'brook' ),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'            => 'color',
	'settings'        => $prefix . 'custom_background',
	'label'           => esc_html__( 'Custom Background Color', 'brook' ),
	'section'         => $section,
	'priority'        => $priority ++,
	'transport'       => 'auto',
	'default'         => '#000',
	'active_callback' => array(
		array(
			'setting'  => 'light_gallery_background',
			'operator' => '==',
			'value'    => 'custom',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'auto_play',
	'label'    => esc_html__( 'Auto Play', 'brook' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '0',
	'choices'  => array(
		'0' => esc_html__( 'Off', 'brook' ),
		'1' => esc_html__( 'On', 'brook' ),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'download',
	'label'    => esc_html__( 'Download Button', 'brook' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '1',
	'choices'  => array(
		'0' => esc_html__( 'Off', 'brook' ),
		'1' => esc_html__( 'On', 'brook' ),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'full_screen',
	'label'    => esc_html__( 'Full Screen Button', 'brook' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '1',
	'choices'  => array(
		'0' => esc_html__( 'Off', 'brook' ),
		'1' => esc_html__( 'On', 'brook' ),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'share',
	'label'    => esc_html__( 'Share Button', 'brook' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '1',
	'choices'  => array(
		'0' => esc_html__( 'Off', 'brook' ),
		'1' => esc_html__( 'On', 'brook' ),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'zoom',
	'label'    => esc_html__( 'Zoom Buttons', 'brook' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '1',
	'choices'  => array(
		'0' => esc_html__( 'Off', 'brook' ),
		'1' => esc_html__( 'On', 'brook' ),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'thumbnail',
	'label'    => esc_html__( 'Thumbnail Gallery', 'brook' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '1',
	'choices'  => array(
		'0' => esc_html__( 'Off', 'brook' ),
		'1' => esc_html__( 'On', 'brook' ),
	),
) );
