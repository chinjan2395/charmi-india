<?php
$section  = 'title_bar_03';
$priority = 1;
$prefix   = 'title_bar_03_';

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'background',
	'settings'    => $prefix . 'background',
	'label'       => esc_html__( 'Background', 'brook' ),
	'description' => esc_html__( 'Controls the background of title bar.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => array(
		'background-color'      => '',
		'background-image'      => BROOK_THEME_IMAGE_URI . '/title-bar-03-bg.jpg',
		'background-repeat'     => 'no-repeat',
		'background-size'       => 'cover',
		'background-attachment' => 'scroll',
		'background-position'   => 'center center',
	),
	'output'      => array(
		array(
			'element' => '.page-title-bar-03 .page-title-bar-inner',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'bg_overlay_color',
	'label'       => esc_html__( 'Background Overlay Color', 'brook' ),
	'description' => esc_html__( 'Controls the background overlay color of title bar.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => 'rgba(0, 0, 0, 0)',
	'output'      => array(
		array(
			'element'  => '.page-title-bar-03 .page-title-bar-overlay',
			'property' => 'background-color',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'border_width',
	'label'     => esc_html__( 'Border Bottom Width', 'brook' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => 0,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 0,
		'max'  => 50,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.page-title-bar-03 .page-title-bar-inner',
			'property' => 'border-bottom-width',
			'units'    => 'px',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'border_color',
	'label'       => esc_html__( 'Border Color', 'brook' ),
	'description' => esc_html__( 'Controls the border bottom color of the page title bar.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => 'rgba(0, 0, 0, 0)',
	'output'      => array(
		array(
			'element'  => '.page-title-bar-03 .page-title-bar-inner',
			'property' => 'border-bottom-color',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'padding_top',
	'label'     => esc_html__( 'Padding Bottom', 'brook' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => 405,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 50,
		'max'  => 500,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.page-title-bar-03 .page-title-bar-inner',
			'property' => 'padding-top',
			'units'    => 'px',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'padding_bottom',
	'label'     => esc_html__( 'Padding Bottom', 'brook' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => 100,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 50,
		'max'  => 500,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.page-title-bar-03 .page-title-bar-inner',
			'property' => 'padding-bottom',
			'units'    => 'px',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Heading', 'brook' ) . '</div>',
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'kirki_typography',
	'settings'    => $prefix . 'heading_typography',
	'label'       => esc_html__( 'Font Family', 'brook' ),
	'description' => esc_html__( 'Controls the font family for the page title heading.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => array(
		'font-family'    => '',
		'variant'        => '600',
		'line-height'    => '1.41',
		'letter-spacing' => '',
		'text-transform' => '',
		'color'          => '#fff',
	),
	'output'      => array(
		array(
			'element' => '.page-title-bar-03 .heading',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'heading_font_size',
	'label'     => esc_html__( 'Font Size', 'brook' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => 32,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 10,
		'max'  => 100,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.page-title-bar-03 .heading',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Breadcrumb', 'brook' ) . '</div>',
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'kirki_typography',
	'settings'    => $prefix . 'breadcrumb_typography',
	'label'       => esc_html__( 'Typography', 'brook' ),
	'description' => esc_html__( 'Controls the typography for the breadcrumb text.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => array(
		'font-family'    => '',
		'variant'        => '500',
		'line-height'    => '1.58',
		'letter-spacing' => '',
		'text-transform' => '',
		'font-size'      => '14px',
	),
	'output'      => array(
		array(
			'element' => '.page-title-bar-03 .insight_core_breadcrumb li, .page-title-bar-03 .insight_core_breadcrumb li a',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'breadcrumb_text_color',
	'label'       => esc_html__( 'Text Color', 'brook' ),
	'description' => esc_html__( 'Controls the color of text on breadcrumb.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#ffffff',
	'output'      => array(
		array(
			'element'  => '.page-title-bar-03 .insight_core_breadcrumb li',
			'property' => 'color',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'breadcrumb_link_color',
	'label'       => esc_html__( 'Link Color', 'brook' ),
	'description' => esc_html__( 'Controls the color of links on breadcrumb.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#ffffff',
	'output'      => array(
		array(
			'element'  => '.page-title-bar-03 .insight_core_breadcrumb a',
			'property' => 'color',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'breadcrumb_link_hover_color',
	'label'       => esc_html__( 'Link Hover Color', 'brook' ),
	'description' => esc_html__( 'Controls the color when hover of links on breadcrumb.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#ffffff',
	'output'      => array(
		array(
			'element'  => '.page-title-bar-03 .insight_core_breadcrumb a:hover',
			'property' => 'color',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'breadcrumb_underline_color',
	'label'       => esc_html__( 'Underline Color', 'brook' ),
	'description' => esc_html__( 'Controls the color for underline.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#ffffff',
	'output'      => array(
		array(
			'element'  => '.page-title-bar-03 .insight_core_breadcrumb a:after',
			'property' => 'background-color',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'breadcrumb_separator_color',
	'label'       => esc_html__( 'Separator Color', 'brook' ),
	'description' => esc_html__( 'Controls the color of separator on breadcrumb.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '#ffffff',
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element'  => '.page-title-bar-03 .insight_core_breadcrumb li + li:before',
			'property' => 'color',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Responsive Options', 'brook' ) . '</div>',
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="group_title">' . esc_html__( 'Medium Device', 'brook' ) . '</div>',
) );

Brook_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'md_padding_top',
	'label'     => esc_html__( 'Padding Bottom', 'brook' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => 355,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 50,
		'max'  => 500,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'     => '.page-title-bar-03 .page-title-bar-inner',
			'property'    => 'padding-top',
			'units'       => 'px',
			'media_query' => Brook_Helper::get_md_media_query(),
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'md_padding_bottom',
	'label'     => esc_html__( 'Padding Bottom', 'brook' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => 100,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 50,
		'max'  => 500,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'     => '.page-title-bar-03 .page-title-bar-inner',
			'property'    => 'padding-bottom',
			'units'       => 'px',
			'media_query' => Brook_Helper::get_md_media_query(),
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'md_heading_font_size',
	'label'     => esc_html__( 'Heading Font Size', 'brook' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => 28,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 10,
		'max'  => 100,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'     => '.page-title-bar-03 .page-title-bar-inner .heading',
			'property'    => 'font-size',
			'units'       => 'px',
			'media_query' => Brook_Helper::get_md_media_query(),
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="group_title">' . esc_html__( 'Small Device', 'brook' ) . '</div>',
) );

Brook_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'sm_padding_top',
	'label'     => esc_html__( 'Padding Bottom', 'brook' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => 350,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 50,
		'max'  => 500,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'     => '.page-title-bar-03 .page-title-bar-inner',
			'property'    => 'padding-top',
			'units'       => 'px',
			'media_query' => Brook_Helper::get_sm_media_query(),
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'sm_padding_bottom',
	'label'     => esc_html__( 'Padding Bottom', 'brook' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => 100,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 50,
		'max'  => 500,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'     => '.page-title-bar-03 .page-title-bar-inner',
			'property'    => 'padding-bottom',
			'units'       => 'px',
			'media_query' => Brook_Helper::get_sm_media_query(),
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'sm_heading_font_size',
	'label'     => esc_html__( 'Heading Font Size', 'brook' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => 24,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 10,
		'max'  => 100,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'     => '.page-title-bar-03 .page-title-bar-inner .heading',
			'property'    => 'font-size',
			'units'       => 'px',
			'media_query' => Brook_Helper::get_sm_media_query(),
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="group_title">' . esc_html__( 'Extra Small Device', 'brook' ) . '</div>',
) );

Brook_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'xs_padding_top',
	'label'     => esc_html__( 'Padding Bottom', 'brook' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => 300,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 50,
		'max'  => 500,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'     => '.page-title-bar-03 .page-title-bar-inner',
			'property'    => 'padding-top',
			'units'       => 'px',
			'media_query' => Brook_Helper::get_xs_media_query(),
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'xs_padding_bottom',
	'label'     => esc_html__( 'Padding Bottom', 'brook' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => 80,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 50,
		'max'  => 500,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'     => '.page-title-bar-03 .page-title-bar-inner',
			'property'    => 'padding-bottom',
			'units'       => 'px',
			'media_query' => Brook_Helper::get_xs_media_query(),
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'xs_heading_font_size',
	'label'     => esc_html__( 'Heading Font Size', 'brook' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => 24,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 10,
		'max'  => 100,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'     => '.page-title-bar-03 .page-title-bar-inner .heading',
			'property'    => 'font-size',
			'units'       => 'px',
			'media_query' => Brook_Helper::get_xs_media_query(),
		),
	),
) );
