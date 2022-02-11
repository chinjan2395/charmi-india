<?php
$section  = 'performance';
$priority = 1;
$prefix   = 'performance_';

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'toggle',
	'settings'    => 'use_minify_scripts',
	'label'       => esc_html__( 'Use Minify Scripts', 'brook' ),
	'description' => esc_html__( 'Make your website smaller and faster to load', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 1,
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'toggle',
	'settings'    => 'disable_emoji',
	'label'       => esc_html__( 'Disable Emojis', 'brook' ),
	'description' => esc_html__( 'Remove Wordpress Emojis functionality.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 1,
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'toggle',
	'settings'    => 'disable_embeds',
	'label'       => esc_html__( 'Disable Embeds', 'brook' ),
	'description' => esc_html__( 'Remove Wordpress Embeds functionality.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 1,
) );
