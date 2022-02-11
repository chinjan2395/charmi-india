<?php
$section  = 'advanced';
$priority = 1;
$prefix   = 'advanced_';

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'toggle',
	'settings'    => 'smooth_scroll_enable',
	'label'       => esc_html__( 'Smooth Scroll', 'brook' ),
	'description' => esc_html__( 'Smooth scrolling experience for websites.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 1,
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'toggle',
	'settings'    => 'scroll_top_enable',
	'label'       => esc_html__( 'Go To Top Button', 'brook' ),
	'description' => esc_html__( 'Turn on to show go to top button.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 1,
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'one_page_scroll_enable',
	'label'    => esc_html__( 'Disable One Page Scroll on Mobile', 'brook' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '0',
	'choices'  => array(
		'1' => esc_html__( 'Yes', 'brook' ),
		'0' => esc_html__( 'None', 'brook' ),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => 'google_api_key',
	'label'       => esc_html__( 'Google Api Key', 'brook' ),
	'description' => sprintf( wp_kses( __( 'Follow <a href="%s" target="_blank">this link</a> and click <strong>GET A KEY</strong> button.', 'brook' ), array(
		'a'      => array(
			'href'   => array(),
			'target' => array(),
		),
		'strong' => array(),
	) ), esc_url( 'https://developers.google.com/maps/documentation/javascript/get-api-key#get-an-api-key' ) ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'AIzaSyD_lQl7ix2cmCXnkpYWn1mpgsyQDKjFcTM',
	'transport'   => 'postMessage',
) );
