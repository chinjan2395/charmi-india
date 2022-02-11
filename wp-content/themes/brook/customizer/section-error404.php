<?php
$section  = 'error404_page';
$priority = 1;
$prefix   = 'error404_page_';

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'image',
	'settings' => 'error404_page_image',
	'label'    => esc_html__( 'Image', 'brook' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => BROOK_THEME_IMAGE_URI . '/image_404.png',
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => 'error404_page_title',
	'label'       => esc_html__( 'Title', 'brook' ),
	'description' => esc_html__( 'Controls the title that display on error 404 page.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'Looks like you are lost.', 'brook' ),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'textarea',
	'settings'    => 'error404_page_text',
	'label'       => esc_html__( 'Text', 'brook' ),
	'description' => esc_html__( 'Controls the text that display below title', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'It looks like nothing was found at this location. You can either go back to the last page or go to homepage.', 'brook' ),
) );
