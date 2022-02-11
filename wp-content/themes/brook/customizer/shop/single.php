<?php
$section  = 'shop_single';
$priority = 1;
$prefix   = 'single_product_';

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'single_product_feature_style',
	'label'    => esc_html__( 'Image & Gallery Style', 'brook' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => 'list',
	'choices'  => array(
		'list'   => esc_html__( 'List', 'brook' ),
		'slider' => esc_html__( 'Slider', 'brook' ),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_product_sticky_enable',
	'label'       => esc_html__( 'Sticky Feature/Details Columns', 'brook' ),
	'description' => esc_html__( 'Turn on to enable sticky of product feature & details columns.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'brook' ),
		'1' => esc_html__( 'On', 'brook' ),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'single_product_nav_links',
	'label'    => esc_html__( 'Nav Links', 'brook' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '1',
	'choices'  => array(
		'0' => esc_html__( 'Hide', 'brook' ),
		'1' => esc_html__( 'Show', 'brook' ),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'single_product_categories_enable',
	'label'    => esc_html__( 'Categories', 'brook' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '1',
	'choices'  => array(
		'0' => esc_html__( 'Hide', 'brook' ),
		'1' => esc_html__( 'Show', 'brook' ),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'single_product_tags_enable',
	'label'    => esc_html__( 'Tags', 'brook' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '1',
	'choices'  => array(
		'0' => esc_html__( 'Hide', 'brook' ),
		'1' => esc_html__( 'Show', 'brook' ),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'single_product_sharing_enable',
	'label'    => esc_html__( 'Sharing', 'brook' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '1',
	'choices'  => array(
		'0' => esc_html__( 'Hide', 'brook' ),
		'1' => esc_html__( 'Show', 'brook' ),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'single_product_up_sells_enable',
	'label'    => esc_html__( 'Up-sells products', 'brook' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '1',
	'choices'  => array(
		'0' => esc_html__( 'Hide', 'brook' ),
		'1' => esc_html__( 'Show', 'brook' ),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'single_product_related_enable',
	'label'    => esc_html__( 'Related products', 'brook' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '1',
	'choices'  => array(
		'0' => esc_html__( 'Hide', 'brook' ),
		'1' => esc_html__( 'Show', 'brook' ),
	),
) );
