<?php
$panel    = 'portfolio';
$priority = 1;

Brook_Kirki::add_section( 'archive_portfolio', array(
	'title'    => esc_html__( 'Portfolio Archive', 'brook' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );

Brook_Kirki::add_section( 'single_portfolio', array(
	'title'    => esc_html__( 'Portfolio Single', 'brook' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );

Brook_Kirki::add_section( 'portfolio_fullscreen_type_hover', array(
	'title'    => esc_html__( 'Fullscreen Type Hover', 'brook' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );

Brook_Kirki::add_section( 'portfolio_fullscreen_type_hover_02', array(
	'title'    => esc_html__( 'Fullscreen Type Hover 02', 'brook' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );

Brook_Kirki::add_section( 'portfolio_fullscreen_type_hover_03', array(
	'title'    => esc_html__( 'Fullscreen Type Hover 03', 'brook' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );
