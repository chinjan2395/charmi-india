<?php
$section  = 'social_sharing';
$priority = 1;
$prefix   = 'social_sharing_';

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'select',
	'settings' => $prefix . 'type',
	'label'    => esc_html__( 'Type', 'brook' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => 'standard',
	'choices'  => array(
		'standard' => esc_html__( 'By Brook', 'brook' ),
		'addtoany' => esc_html__( 'Use "AddToAny Share Buttons" plugin', 'brook' ),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'            => 'multicheck',
	'settings'        => $prefix . 'item_enable',
	'label'           => esc_attr__( 'Sharing Links', 'brook' ),
	'description'     => esc_html__( 'Check to the box to enable social share links.', 'brook' ),
	'section'         => $section,
	'priority'        => $priority++,
	'default'         => array( 'facebook', 'twitter', 'linkedin', 'tumblr' ),
	'choices'         => array(
		'facebook' => esc_attr__( 'Facebook', 'brook' ),
		'twitter'  => esc_attr__( 'Twitter', 'brook' ),
		'linkedin' => esc_attr__( 'Linkedin', 'brook' ),
		'tumblr'   => esc_attr__( 'Tumblr', 'brook' ),
		'email'    => esc_attr__( 'Email', 'brook' ),
	),
	'active_callback' => array(
		array(
			'setting'  => 'social_sharing_type',
			'operator' => '==',
			'value'    => 'standard',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'            => 'sortable',
	'settings'        => $prefix . 'order',
	'label'           => esc_attr__( 'Order', 'brook' ),
	'description'     => esc_html__( 'Controls the order of social share links.', 'brook' ),
	'section'         => $section,
	'priority'        => $priority++,
	'default'         => array(
		'facebook',
		'twitter',
		'linkedin',
		'tumblr',
		'email',
	),
	'choices'         => array(
		'facebook' => esc_attr__( 'Facebook', 'brook' ),
		'twitter'  => esc_attr__( 'Twitter', 'brook' ),
		'linkedin' => esc_attr__( 'Linkedin', 'brook' ),
		'tumblr'   => esc_attr__( 'Tumblr', 'brook' ),
		'email'    => esc_attr__( 'Email', 'brook' ),
	),
	'active_callback' => array(
		array(
			'setting'  => 'social_sharing_type',
			'operator' => '==',
			'value'    => 'standard',
		),
	),
) );
