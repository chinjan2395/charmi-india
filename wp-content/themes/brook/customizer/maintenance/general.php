<?php
$section  = 'general';
$priority = 1;
$prefix   = 'general_';

$maintenance_pages = array();
if ( is_customize_preview() ) {
	$maintenance_pages = Brook_Maintenance::get_maintenance_pages();
}

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'toggle',
	'settings' => 'maintenance_mode_enable',
	'label'    => esc_html__( 'Maintenance Mode', 'brook' ),
	'description' => esc_html__( 'Turn on to activate maintenance mode for unauthenticated users.', 'brook' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => 0,
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'select',
	'settings' => 'maintenance_page',
	'label'    => esc_html__( 'Maintenance Page', 'brook' ),
	'description' => esc_html__( 'Choose a maintenance or coming soon template. If you haven\'t any pages then please add new page & choose Page Template is Coming Soon or Maintenance.', 'brook' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '',
	'choices'  => $maintenance_pages,
) );
