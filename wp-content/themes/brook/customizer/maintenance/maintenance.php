<?php
$section  = 'maintenance';
$priority = 1;
$prefix   = 'maintenance_';

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'background',
	'settings'    => $prefix . 'background',
	'label'       => esc_html__( 'Background', 'brook' ),
	'description' => esc_html__( 'Controls the background of maintenance template.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => array(
		'background-color'      => '',
		'background-image'      => BROOK_THEME_IMAGE_URI . '/maintenance-bg.jpg',
		'background-repeat'     => 'no-repeat',
		'background-size'       => 'cover',
		'background-attachment' => 'scroll',
		'background-position'   => 'center center',
	),
	'output'      => array(
		array(
			'element' => '.page-template-maintenance',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'textarea',
	'settings' => $prefix . 'title',
	'label'    => esc_html__( 'Title', 'brook' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => esc_html__( '&lt;Undergoing
maintenance/&gt;', 'brook' ),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'textarea',
	'settings'    => $prefix . 'text',
	'label'       => esc_html__( 'Text', 'brook' ),
	'description' => esc_html__( 'Controls the text that display below title.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'We sincerely apologize for the inconvenience. <br/>
Our site is currently undergoing maintenance and upgrades, but will return shortly after.', 'brook' ),
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
