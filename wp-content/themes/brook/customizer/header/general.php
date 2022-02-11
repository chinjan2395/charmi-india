<?php
$section  = 'header';
$priority = 1;
$prefix   = 'header_';

$header_default_text = esc_html__( 'Use Global Header', 'brook' );
$headers             = Brook_Helper::get_header_list( true, $header_default_text );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'global_header',
	'label'       => esc_html__( 'Global Header', 'brook' ),
	'description' => esc_html__( 'Select default header type for your site.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '01',
	'choices'     => Brook_Helper::get_header_list(),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'single_page_header_type',
	'label'       => esc_html__( 'Single Page', 'brook' ),
	'description' => esc_html__( 'Select default header type that displays on all single pages.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '',
	'choices'     => $headers,
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'archive_blog_header_type',
	'label'       => esc_html__( 'Blog Archive', 'brook' ),
	'description' => esc_html__( 'Select header type that displays on blog archive pages.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '02',
	'choices'     => $headers,
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'single_post_header_type',
	'label'       => esc_html__( 'Single Blog', 'brook' ),
	'description' => esc_html__( 'Select default header type that displays on all single blog post pages.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '',
	'choices'     => $headers,
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'archive_portfolio_header_type',
	'label'       => esc_html__( 'Archive Portfolio', 'brook' ),
	'description' => esc_html__( 'Select default header type that displays on archive portfolio page.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '',
	'choices'     => $headers,
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'single_portfolio_header_type',
	'label'       => esc_html__( 'Single Portfolio', 'brook' ),
	'description' => esc_html__( 'Select default header type that displays on all single portfolio pages.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '',
	'choices'     => $headers,
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'archive_product_header_type',
	'label'       => esc_html__( 'Archive Product', 'brook' ),
	'description' => esc_html__( 'Select default header type that displays on archive product page.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '',
	'choices'     => $headers,
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'single_product_header_type',
	'label'       => esc_html__( 'Single Product', 'brook' ),
	'description' => esc_html__( 'Select default header type that displays on all single product pages.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '',
	'choices'     => $headers,
) );
