<?php
$panel    = 'advanced';
$priority = 1;

Brook_Kirki::add_section( 'advanced', array(
	'title'    => esc_html__( 'Advanced', 'brook' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );

Brook_Kirki::add_section( 'pre_loader', array(
	'title'    => esc_html__( 'Pre Loader', 'brook' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );

Brook_Kirki::add_section( 'light_gallery', array(
	'title'    => esc_html__( 'Light Gallery', 'brook' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );
