<?php
$section  = 'shop_archive';
$priority = 1;
$prefix   = 'shop_archive_';

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'preset',
	'settings' => 'shop_archive_preset',
	'label'    => esc_html__( 'Shop Layout Preset', 'brook' ),
	'section'  => $section,
	'default'  => '-1',
	'priority' => $priority++,
	'multiple' => 3,
	'choices'  => array(
		'-1'      => array(
			'label'    => esc_html__( 'None', 'brook' ),
			'settings' => array(),
		),
		'minimal' => array(
			'label'    => esc_html__( 'Shop Minimal', 'brook' ),
			'settings' => array(
				'archive_product_header_type'           => '02',
				'product_archive_page_title_bar_layout' => '04',
				'product_archive_page_sidebar_1'        => 'none',
				'shop_archive_number_item'              => 9,
				'shop_archive_lg_columns'               => 3,
				'shop_archive_sorting'                  => '1',
			),
		),
		'wide'    => array(
			'label'    => esc_html__( 'Shop Wide', 'brook' ),
			'settings' => array(
				'shop_archive_layout'      => 'wide',
				'shop_archive_number_item' => 8,
				'shop_archive_lg_columns'  => 3,
			),
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'shop_archive_layout',
	'label'    => esc_html__( 'Layout', 'brook' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => 'boxed',
	'choices'  => array(
		'boxed' => esc_html__( 'Boxed', 'brook' ),
		'wide'  => esc_html__( 'Wide', 'brook' ),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'shop_archive_hover_image',
	'label'       => esc_html__( 'Hover Image', 'brook' ),
	'description' => esc_html__( 'Turn on to show first gallery image when hover', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'None', 'brook' ),
		'1' => esc_html__( 'Yes', 'brook' ),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'shop_archive_compare',
	'label'       => esc_html__( 'Compare', 'brook' ),
	'description' => esc_html__( 'Turn on to display compare button', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'brook' ),
		'1' => esc_html__( 'On', 'brook' ),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'shop_archive_wishlist',
	'label'       => esc_html__( 'Wishlist', 'brook' ),
	'description' => esc_html__( 'Turn on to display love button', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'brook' ),
		'1' => esc_html__( 'On', 'brook' ),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'shop_archive_sorting',
	'label'       => esc_html__( 'Sorting', 'brook' ),
	'description' => esc_html__( 'Turn on to show sorting select options that displays above products list.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '0',
	'choices'     => array(
		'0' => esc_html__( 'Hide', 'brook' ),
		'1' => esc_html__( 'Show', 'brook' ),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'number',
	'settings'    => 'shop_archive_number_item',
	'label'       => esc_html__( 'Number items', 'brook' ),
	'description' => esc_html__( 'Controls the number of products display on shop archive page', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 8,
	'choices'     => array(
		'min'  => 1,
		'max'  => 50,
		'step' => 1,
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => 'shop_archive_lg_columns',
	'label'     => esc_html__( 'Number of columns on Large device', 'brook' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => 2,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 0,
		'max'  => 6,
		'step' => 1,
	),
) );
