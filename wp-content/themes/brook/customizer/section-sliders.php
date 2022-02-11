<?php
$section  = 'sliders';
$priority = 1;
$prefix   = 'sliders_';

$revolution_sliders = array();

if ( is_customize_preview() ) {
	$revolution_sliders = Brook_Helper::get_list_revslider();
}

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Search Page', 'brook' ) . '</div>',
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'search_page_rev_slider',
	'label'       => esc_html__( 'Revolution Slider', 'brook' ),
	'description' => esc_html__( 'Select the unique name of the slider.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '',
	'choices'     => $revolution_sliders,
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'search_page_slider_position',
	'label'    => esc_html__( 'Slider Position', 'brook' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => 'below',
	'choices'  => array(
		'above' => esc_html__( 'Above Header', 'brook' ),
		'below' => esc_html__( 'Below Header', 'brook' ),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Front Latest Posts Page', 'brook' ) . '</div>',
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'home_page_rev_slider',
	'label'       => esc_html__( 'Revolution Slider', 'brook' ),
	'description' => esc_html__( 'Select the unique name of the slider.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '',
	'choices'     => $revolution_sliders,
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'home_page_slider_position',
	'label'    => esc_html__( 'Slider Position', 'brook' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => 'below',
	'choices'  => array(
		'above' => esc_html__( 'Above Header', 'brook' ),
		'below' => esc_html__( 'Below Header', 'brook' ),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Blog Archive', 'brook' ) . '</div>',
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'blog_archive_page_rev_slider',
	'label'       => esc_html__( 'Revolution Slider', 'brook' ),
	'description' => esc_html__( 'Select the unique name of the slider.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '',
	'choices'     => $revolution_sliders,
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'blog_archive_page_slider_position',
	'label'    => esc_html__( 'Slider Position', 'brook' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => 'below',
	'choices'  => array(
		'above' => esc_html__( 'Above Header', 'brook' ),
		'below' => esc_html__( 'Below Header', 'brook' ),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Portfolio Archive', 'brook' ) . '</div>',
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'portfolio_archive_page_rev_slider',
	'label'       => esc_html__( 'Revolution Slider', 'brook' ),
	'description' => esc_html__( 'Select the unique name of the slider.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '',
	'choices'     => $revolution_sliders,
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'portfolio_archive_page_slider_position',
	'label'    => esc_html__( 'Slider Position', 'brook' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => 'below',
	'choices'  => array(
		'above' => esc_html__( 'Above Header', 'brook' ),
		'below' => esc_html__( 'Below Header', 'brook' ),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Product Archive', 'brook' ) . '</div>',
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'product_archive_page_rev_slider',
	'label'       => esc_html__( 'Revolution Slider', 'brook' ),
	'description' => esc_html__( 'Select the unique name of the slider.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '',
	'choices'     => $revolution_sliders,
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'product_archive_page_slider_position',
	'label'    => esc_html__( 'Slider Position', 'brook' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => 'below',
	'choices'  => array(
		'above' => esc_html__( 'Above Header', 'brook' ),
		'below' => esc_html__( 'Below Header', 'brook' ),
	),
) );
