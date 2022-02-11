<?php
$section  = 'footer';
$priority = 1;
$prefix   = 'footer_';

$footers = array();

if ( is_customize_preview() ) {
	$footers = Brook_Footer::get_list_footers( true );
}

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => $prefix . 'page',
	'label'       => esc_html__( 'Footer', 'brook' ),
	'description' => esc_html__( 'Select a default footer for all pages.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'footer-22',
	'choices'     => $footers,
) );
