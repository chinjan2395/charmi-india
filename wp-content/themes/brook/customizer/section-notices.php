<?php
$section  = 'notices';
$priority = 1;
$prefix   = 'notice_';

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'toggle',
	'settings'    => 'notice_cookie_enable',
	'label'       => esc_html__( 'Cookie Notice', 'brook' ),
	'description' => esc_html__( 'The notice about cookie auto show when a user visits the site.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 0,
) );
