<?php
$panel    = 'shop';
$priority = 1;

Brook_Kirki::add_section( 'shop_general', array(
	'title'    => esc_html__( 'General', 'brook' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );

Brook_Kirki::add_section( 'shop_archive', array(
	'title'    => esc_html__( 'Shop Archive', 'brook' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );

Brook_Kirki::add_section( 'shop_single', array(
	'title'    => esc_html__( 'Shop Single', 'brook' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );

Brook_Kirki::add_section( 'shopping_cart', array(
	'title'    => esc_html__( 'Shopping Cart', 'brook' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );
