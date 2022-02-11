<?php
$section  = 'archive_portfolio';
$priority = 1;
$prefix   = 'archive_portfolio_';

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'archive_portfolio_style',
	'label'       => esc_html__( 'Portfolio Style', 'brook' ),
	'description' => esc_html__( 'Select portfolio style that display for archive pages.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'grid',
	'choices'     => array(
		'grid'    => esc_attr__( 'Grid Classic', 'brook' ),
		'metro'   => esc_attr__( 'Grid Metro', 'brook' ),
		'masonry' => esc_attr__( 'Grid Masonry', 'brook' ),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'select',
	'settings' => 'archive_portfolio_thumbnail_size',
	'label'    => esc_html__( 'Thumbnail Size', 'brook' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '480x480',
	'choices'  => array(
		'480x480' => esc_attr( '480x480' ),
		'480x311' => esc_attr( '480x311' ),
		'481x325' => esc_attr( '481x325' ),
		'500x324' => esc_attr( '500x324' ),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'number',
	'settings' => 'archive_portfolio_gutter',
	'label'    => esc_html__( 'Gutter', 'brook' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => 30,
	'choices'  => array(
		'min'  => 0,
		'step' => 1,
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'text',
	'settings' => 'archive_portfolio_columns',
	'label'    => esc_html__( 'Columns', 'brook' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => 'xs:1;sm:2;md:3;lg:3',
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'select',
	'settings' => 'archive_portfolio_overlay_style',
	'label'    => esc_html__( 'Columns', 'brook' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => 'faded',
	'choices'  => array(
		'none'     => esc_attr__( 'None', 'brook' ),
		'faded'    => esc_attr__( 'Faded', 'brook' ),
		'faded-02' => esc_attr__( 'Faded 02', 'brook' ),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'archive_portfolio_animation',
	'label'       => esc_html__( 'CSS Animation', 'brook' ),
	'description' => esc_html__( 'Select type of animation for element to be animated when it "enters" the browsers viewport (Note: works only in modern browsers).', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'scale-up',
	'choices'     => array(
		'none'     => esc_attr__( 'None', 'brook' ),
		'fade-in'  => esc_attr__( 'Fade In', 'brook' ),
		'move-up'  => esc_attr__( 'Move Up', 'brook' ),
		'scale-up' => esc_attr__( 'Scale Up', 'brook' ),
		'fly'      => esc_attr__( 'Fly', 'brook' ),
		'flip'     => esc_attr__( 'Flip', 'brook' ),
		'helix'    => esc_attr__( 'Helix', 'brook' ),
		'pop-up'   => esc_attr__( 'Pop Up', 'brook' ),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => $prefix . 'external_url',
	'label'       => esc_html__( 'External Url', 'brook' ),
	'description' => esc_html__( 'Go to external url instead of go to single portfolio pages from archive portfolio pages.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '0',
	'choices'     => array(
		'0' => esc_html__( 'No', 'brook' ),
		'1' => esc_html__( 'Yes', 'brook' ),
	),
) );
