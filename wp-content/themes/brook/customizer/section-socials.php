<?php
$section  = 'socials';
$priority = 1;
$prefix   = 'social_';

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'social_link_target',
	'label'    => esc_html__( 'Open link in a new tab.', 'brook' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '1',
	'choices'  => array(
		'0' => esc_html__( 'No', 'brook' ),
		'1' => esc_html__( 'Yes', 'brook' ),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'      => 'repeater',
	'settings'  => 'social_link',
	'section'   => $section,
	'priority'  => $priority ++,
	'choices'   => array(
		'labels' => array(
			'add-new-row' => esc_html__( 'Add new social network', 'brook' ),
		),
	),
	'row_label' => array(
		'type'  => 'field',
		'field' => 'tooltip',
	),
	'default'   => array(
		array(
			'tooltip'    => esc_html__( 'Facebook', 'brook' ),
			'icon_class' => 'fab fa-facebook-square',
			'link_url'   => 'https://facebook.com',
		),
		array(
			'tooltip'    => esc_html__( 'Twitter', 'brook' ),
			'icon_class' => 'fab fa-twitter',
			'link_url'   => 'https://twitter.com',
		),
		array(
			'tooltip'    => esc_html__( 'Instagram', 'brook' ),
			'icon_class' => 'fab fa-instagram',
			'link_url'   => 'https://instagram.com',
		),
	),
	'fields'    => array(
		'tooltip'    => array(
			'type'        => 'text',
			'label'       => esc_html__( 'Tooltip', 'brook' ),
			'description' => esc_html__( 'Enter your hint text for your icon', 'brook' ),
			'default'     => '',
		),
		'icon_class' => array(
			'type'        => 'text',
			'label'       => esc_html__( 'Icon Class', 'brook' ),
			'description' => esc_html__( 'This will be the icon class for your link', 'brook' ),
			'default'     => '',
		),
		'link_url'   => array(
			'type'        => 'text',
			'label'       => esc_html__( 'Link URL', 'brook' ),
			'description' => esc_html__( 'This will be the link URL', 'brook' ),
			'default'     => '',
		),
	),
) );
