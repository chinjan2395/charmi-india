<?php
$panel    = 'navigation';
$priority = 1;

Brook_Kirki::add_section( 'navigation', array(
	'title'    => esc_html__( 'Desktop Menu', 'brook' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );

Brook_Kirki::add_section( 'navigation_minimal_01', array(
	'title'    => esc_html__( 'Off Canvas Menu', 'brook' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );

Brook_Kirki::add_section( 'navigation_mobile', array(
	'title'    => esc_html__( 'Mobile Menu', 'brook' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );
