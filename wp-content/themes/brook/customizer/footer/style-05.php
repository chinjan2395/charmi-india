<?php
$section  = 'footer_05';
$priority = 1;
$prefix   = 'footer_05_';

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'kirki_typography',
	'settings'    => $prefix . 'widget_title_typography',
	'label'       => esc_html__( 'Typography', 'brook' ),
	'description' => esc_html__( 'Controls the typography of footer widget title.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => array(
		'font-family'    => '',
		'variant'        => '600',
		'font-size'      => '18px',
		'line-height'    => '1.2',
		'letter-spacing' => '',
		'text-transform' => '',
	),
	'output'      => array(
		array(
			'element' => '.footer-style-05 .widgettitle',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'      => 'color-alpha',
	'settings'  => $prefix . 'widget_title_color',
	'label'     => esc_html__( 'Widget Title Color', 'brook' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'auto',
	'default'   => '#222',
	'output'    => array(
		array(
			'element'  => '.footer-style-05 .widgettitle',
			'property' => 'color',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'      => 'color-alpha',
	'settings'  => $prefix . 'widget_title_border_color',
	'label'     => esc_html__( 'Widget Title Border Color', 'brook' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'auto',
	'default'   => 'rgba(0, 0, 0, 0)',
	'output'    => array(
		array(
			'element'  => '.footer-style-05 .widgettitle',
			'property' => 'border-bottom-color',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'widget_title_margin_bottom',
	'label'     => esc_html__( 'Widget Title Margin Bottom', 'brook' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => 29,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 0,
		'max'  => 100,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.footer-style-05 .widgettitle',
			'property' => 'margin-bottom',
			'units'    => 'px',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'kirki_typography',
	'settings'    => $prefix . 'typography',
	'label'       => esc_html__( 'Typography', 'brook' ),
	'description' => esc_html__( 'Controls the typography of footer.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => array(
		'font-family'    => '',
		'variant'        => '500',
		'font-size'      => '14px',
		'line-height'    => '1.58',
		'letter-spacing' => '0em',
		'text-transform' => '',
	),
	'output'      => array(
		array(
			'element' => '.footer-style-05',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'      => 'color-alpha',
	'settings'  => $prefix . 'text_color',
	'label'     => esc_html__( 'Text Color', 'brook' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'auto',
	'default'   => '#999',
	'output'    => array(
		array(
			'element'  => '.footer-style-05, .footer-style-05 .widget_text',
			'property' => 'color',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'      => 'color-alpha',
	'settings'  => $prefix . 'link_color',
	'label'     => esc_html__( 'Link Color', 'brook' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'auto',
	'default'   => '#999',
	'output'    => array(
		array(
			'element'  => '
			.footer-style-05 a,
            .footer-style-05 .widget_recent_entries li a,
            .footer-style-05 .widget_recent_comments li a,
            .footer-style-05 .widget_archive li a,
            .footer-style-05 .widget_categories li a,
            .footer-style-05 .widget_meta li a,
            .footer-style-05 .widget_product_categories li a,
            .footer-style-05 .widget_rss li a,
            .footer-style-05 .widget_pages li a,
            .footer-style-05 .widget_nav_menu li a,
            .footer-style-05 .insight-core-bmw li a
			',
			'property' => 'color',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'      => 'color-alpha',
	'settings'  => $prefix . 'link_hover_color',
	'label'     => esc_html__( 'Link Hover Color', 'brook' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'auto',
	'default'   => '#222',
	'output'    => array(
		array(
			'element'  => '
			.footer-style-05 a:hover,
            .footer-style-05 .widget_recent_entries li a:hover,
            .footer-style-05 .widget_recent_comments li a:hover,
            .footer-style-05 .widget_archive li a:hover,
            .footer-style-05 .widget_categories li a:hover,
            .footer-style-05 .widget_meta li a:hover,
            .footer-style-05 .widget_product_categories li a:hover,
            .footer-style-05 .widget_rss li a:hover,
            .footer-style-05 .widget_pages li a:hover,
            .footer-style-05 .widget_nav_menu li a:hover,
            .footer-style-05 .insight-core-bmw li a:hover 
			',
			'property' => 'color',
		),
	),
) );
