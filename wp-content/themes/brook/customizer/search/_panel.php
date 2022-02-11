<?php
$panel    = 'search';
$priority = 1;

Brook_Kirki::add_section( 'search_page', array(
	'title'    => esc_html__( 'Search Page', 'brook' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );

Brook_Kirki::add_section( 'search_popup', array(
	'title'    => esc_html__( 'Search Popup', 'brook' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );
