<?php
$panel    = 'top_bar';
$priority = 1;

Brook_Kirki::add_section( 'top_bar', array(
	'title'    => esc_html__( 'General', 'brook' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );

Brook_Kirki::add_section( 'top_bar_style_01', array(
	'title'    => esc_html__( 'Top Bar Style 01', 'brook' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );
