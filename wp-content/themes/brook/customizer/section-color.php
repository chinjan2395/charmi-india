<?php
$section  = 'color_';
$priority = 1;
$prefix   = 'color_';

Brook_Kirki::add_field( 'theme', array(
	'type'      => 'color',
	'settings'  => 'primary_color',
	'label'     => esc_html__( 'Primary Color', 'brook' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'auto',
	'default'   => Brook::PRIMARY_COLOR,
) );

Brook_Kirki::add_field( 'theme', array(
	'type'      => 'color',
	'settings'  => 'secondary_color',
	'label'     => esc_html__( 'Secondary Color', 'brook' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'auto',
	'default'   => Brook::SECONDARY_COLOR,
) );
