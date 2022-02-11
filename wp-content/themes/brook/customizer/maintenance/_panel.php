<?php
$panel    = 'maintenance';
$priority = 1;

Brook_Kirki::add_section( 'general', array(
	'title'    => esc_html__( 'General', 'brook' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );

Brook_Kirki::add_section( 'maintenance', array(
	'title'    => esc_html__( 'Maintenance', 'brook' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );

Brook_Kirki::add_section( 'coming_soon_01', array(
	'title'    => esc_html__( 'Coming Soon 01', 'brook' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );
