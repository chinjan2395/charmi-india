<?php
$panel    = 'shortcode';
$priority = 1;

Brook_Kirki::add_section( 'shortcode_animation', array(
	'title'    => esc_html__( 'CSS Animation', 'brook' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );
