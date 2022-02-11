<?php
$section  = 'top_bar_style_01';
$priority = 1;
$prefix   = 'top_bar_style_01_';

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'text',
	'settings' => $prefix . 'text',
	'label'    => esc_html__( 'Text', 'brook' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => esc_html__( 'Your Trusted 24 Hours Brook Service Provider ! ', 'brook' ),
) );

Brook_Customize::field_social_networks_enable( array(
	'settings' => $prefix . 'social_networks_enable',
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '1',
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'widget_enable',
	'label'    => esc_html__( 'Widget Enable', 'brook' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '1',
	'choices'  => array(
		'0' => esc_html__( 'No', 'brook' ),
		'1' => esc_html__( 'Yes', 'brook' ),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'dimension',
	'settings'    => $prefix . 'width',
	'label'       => esc_html__( 'Max Width', 'brook' ),
	'description' => esc_html__( 'For e.g: 1430px or 100%', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'output'      => array(
		array(
			'element'     => '.top-bar-01 .container',
			'property'    => 'max-width',
			'media_query' => Brook_Helper::get_lg_media_query(),
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'padding_top',
	'label'     => esc_html__( 'Padding top', 'brook' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => 0,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 0,
		'max'  => 200,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.top-bar-01',
			'property' => 'padding-top',
			'units'    => 'px',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'padding_bottom',
	'label'     => esc_html__( 'Padding bottom', 'brook' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => 0,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 0,
		'max'  => 200,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.top-bar-01',
			'property' => 'padding-bottom',
			'units'    => 'px',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'kirki_typography',
	'settings'    => $prefix . 'typography',
	'label'       => esc_html__( 'Typography', 'brook' ),
	'description' => esc_html__( 'These settings control the typography of texts of top bar section.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => array(
		'font-family'    => '',
		'variant'        => 'normal',
		'line-height'    => '1.78',
		'letter-spacing' => '0',
	),
	'output'      => array(
		array(
			'element' => '.top-bar-01, .top-bar-01 a',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'font_size',
	'label'     => esc_html__( 'Font size', 'brook' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => 14,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 10,
		'max'  => 50,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.top-bar-01, .top-bar-01 a',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'bg_color',
	'label'       => esc_html__( 'Background', 'brook' ),
	'description' => esc_html__( 'Controls the background color of top bar.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#fff',
	'output'      => array(
		array(
			'element'  => '.top-bar-01',
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
	'default'   => 1,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 0,
		'max'  => 50,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.top-bar-01',
			'property' => 'border-bottom-width',
			'units'    => 'px',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'border_color',
	'label'       => esc_html__( 'Border Bottom Color', 'brook' ),
	'description' => esc_html__( 'Controls the border bottom color of top bar.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#eee',
	'output'      => array(
		array(
			'element'  => '.top-bar-01',
			'property' => 'border-bottom-color',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => $prefix . 'text_color',
	'label'       => esc_html__( 'Text', 'brook' ),
	'description' => esc_html__( 'Controls the color of text on top bar.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#999',
	'output'      => array(
		array(
			'element'  => '.top-bar-01',
			'property' => 'color',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => $prefix . 'link_color',
	'label'       => esc_html__( 'Link Color', 'brook' ),
	'description' => esc_html__( 'Controls the color of links on top bar.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#999',
	'output'      => array(
		array(
			'element'  => '.top-bar-01 a',
			'property' => 'color',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => $prefix . 'link_hover_color',
	'label'       => esc_html__( 'Link Hover Color', 'brook' ),
	'description' => esc_html__( 'Controls the color when hover of links on top bar.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => Brook::PRIMARY_COLOR,
	'output'      => array(
		array(
			'element'  => '.top-bar-01 a:hover, .top-bar-01 a:focus',
			'property' => 'color',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'separator_width',
	'label'     => esc_html__( 'Separator Width', 'brook' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => 1,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 0,
		'max'  => 50,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.top-bar-01 .top-bar-text-wrap,
			.top-bar-01 .top-bar-social-network,
			.top-bar-01 .top-bar-social-network .social-link + .social-link
			',
			'property' => 'border-left-width',
			'units'    => 'px',
		),
		array(
			'element'  => '.top-bar-01 .top-bar-text-wrap,
			.top-bar-01 .top-bar-social-network',
			'property' => 'border-right-width',
			'units'    => 'px',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'separator_color',
	'label'       => esc_html__( 'Separator Color', 'brook' ),
	'description' => esc_html__( 'Controls the separator color of top bar.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#eeeeee',
	'output'      => array(
		array(
			'element'  => '
			.top-bar-01 .top-bar-text-wrap,
			.top-bar-01 .top-bar-social-network,
			.top-bar-01 .top-bar-social-network .social-link + .social-link
			',
			'property' => 'border-color',
		),
	),
) );
