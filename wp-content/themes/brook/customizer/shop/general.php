<?php
$section  = 'shop_general';
$priority = 1;
$prefix   = 'shop_general_';

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'shop_badge_hot',
	'label'    => esc_html__( 'Hot Badge', 'brook' ),
	'tooltip'  => esc_html__( 'Show a "hot" label when product set featured.', 'brook' ),
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
	'settings' => 'shop_badge_sale',
	'label'    => esc_html__( 'Sale Badge', 'brook' ),
	'tooltip'  => esc_html__( 'Show a "sale" or "sale percent" label when product on sale.', 'brook' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '1',
	'choices'  => array(
		'0' => esc_html__( 'Hide', 'brook' ),
		'1' => esc_html__( 'Show', 'brook' ),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Colors', 'brook' ) . '</div>',
) );

Brook_Kirki::add_field( 'theme', array(
	'type'      => 'multicolor',
	'settings'  => 'shop_badge_hot_color',
	'label'     => esc_html__( 'Hot Badge Color', 'brook' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'auto',
	'choices'   => array(
		'color'      => esc_attr__( 'Color', 'brook' ),
		'background' => esc_attr__( 'Background', 'brook' ),
	),
	'default'   => array(
		'color'      => '#fff',
		'background' => '#d31129',
	),
	'output'    => array(
		array(
			'choice'   => 'color',
			'element'  => '.woocommerce .product-badges .hot',
			'property' => 'color',
		),
		array(
			'choice'   => 'background',
			'element'  => '.woocommerce .product-badges .hot',
			'property' => 'background-color',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'      => 'multicolor',
	'settings'  => 'shop_badge_sale_color',
	'label'     => esc_html__( 'Sale Badge Color', 'brook' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'auto',
	'choices'   => array(
		'color'      => esc_attr__( 'Color', 'brook' ),
		'background' => esc_attr__( 'Background', 'brook' ),
	),
	'default'   => array(
		'color'      => '#fff',
		'background' => '#d5382c',
	),
	'output'    => array(
		array(
			'choice'   => 'color',
			'element'  => '.woocommerce .product-badges .onsale',
			'property' => 'color',
		),
		array(
			'choice'   => 'background',
			'element'  => '.woocommerce .product-badges .onsale',
			'property' => 'background-color',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'      => 'multicolor',
	'settings'  => 'shop_price_color',
	'label'     => esc_html__( 'Price Color', 'brook' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'auto',
	'choices'   => array(
		'regular' => esc_attr__( 'Regular Price', 'brook' ),
		'sale'    => esc_attr__( 'Sale Price', 'brook' ),
	),
	'default'   => array(
		'regular' => '#ccc',
		'sale'    => '#d5382c',
	),
	'output'    => array(
		array(
			'choice'   => 'regular',
			'element'  => '.woocommerce .price del',
			'property' => 'color',
			'suffix'   => '!important',
		),
		array(
			'choice'   => 'sale',
			'element'  => '.woocommerce ins .amount',
			'property' => 'color',
		),
	),
) );
