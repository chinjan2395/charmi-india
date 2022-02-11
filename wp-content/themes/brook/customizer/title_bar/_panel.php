<?php
$panel    = 'title_bar';
$priority = 1;

Brook_Kirki::add_section( 'title_bar', array(
	'title'    => esc_html__( 'General', 'brook' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );

Brook_Kirki::add_section( 'title_bar_01', array(
	'title'    => esc_html__( 'Style 01', 'brook' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );

Brook_Kirki::add_section( 'title_bar_02', array(
	'title'    => esc_html__( 'Style 02', 'brook' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );

Brook_Kirki::add_section( 'title_bar_03', array(
	'title'    => esc_html__( 'Style 03', 'brook' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );

Brook_Kirki::add_section( 'title_bar_04', array(
	'title'    => esc_html__( 'Style 04', 'brook' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );

Brook_Kirki::add_section( 'title_bar_05', array(
	'title'    => esc_html__( 'Style 05', 'brook' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );
