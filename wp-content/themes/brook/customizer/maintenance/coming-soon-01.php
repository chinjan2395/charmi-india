<?php
$section  = 'coming_soon_01';
$priority = 1;
$prefix   = 'coming_soon_01_';

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'background',
	'settings'    => $prefix . 'background',
	'label'       => esc_html__( 'Background', 'brook' ),
	'description' => esc_html__( 'Controls the background of coming soon template.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => array(
		'background-color'      => '#000',
		'background-image'      => '',
		'background-repeat'     => 'no-repeat',
		'background-size'       => 'cover',
		'background-attachment' => 'scroll',
		'background-position'   => 'center center',
	),
	'output'      => array(
		array(
			'element' => '.page-template-coming-soon-01',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'background',
	'settings'    => $prefix . 'left_background',
	'label'       => esc_html__( 'Left Background', 'brook' ),
	'description' => esc_html__( 'Controls the left background of coming soon template.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => array(
		'background-color'      => '',
		'background-image'      => BROOK_THEME_IMAGE_URI . '/coming-soon-bg.jpg',
		'background-repeat'     => 'no-repeat',
		'background-size'       => 'cover',
		'background-attachment' => 'scroll',
		'background-position'   => 'center center',
	),
	'output'      => array(
		array(
			'element' => '.page-template-coming-soon-01 .coming-soon-bg',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'image',
	'settings' => $prefix . 'logo',
	'label'    => esc_html__( 'Logo', 'brook' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => BROOK_THEME_IMAGE_URI . '/simple-logo.png',
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'dimension',
	'settings'    => $prefix . 'width',
	'label'       => esc_html__( 'Logo Width', 'brook' ),
	'description' => esc_html__( 'For e.g: 200px', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '51px',
	'output'      => array(
		array(
			'element'  => '.cs-logo',
			'property' => 'width',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'text',
	'settings' => $prefix . 'title',
	'label'    => esc_html__( 'Title', 'brook' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => esc_html__( 'Something awesome is in the works.', 'brook' ),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'date',
	'settings' => $prefix . 'countdown',
	'label'    => esc_html__( 'Countdown', 'brook' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => Brook_Helper::get_sample_countdown_date(),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'mailchimp_enable',
	'label'    => esc_html__( 'Mailchimp Form', 'brook' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '1',
	'choices'  => array(
		'0' => esc_html__( 'Hide', 'brook' ),
		'1' => esc_html__( 'Show', 'brook' ),
	),
) );

Brook_Customize::field_social_networks_enable( array(
	'settings' => $prefix . 'social_networks_enable',
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '1',
) );
