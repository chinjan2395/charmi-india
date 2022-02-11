<?php
$section  = 'navigation';
$priority = 1;
$prefix   = 'navigation_';

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Main Menu Dropdown', 'brook' ) . '</div>',
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'kirki_typography',
	'settings'    => $prefix . 'dropdown_link_typography',
	'label'       => esc_html__( 'Typography', 'brook' ),
	'description' => esc_html__( 'Controls the typography for all dropdown menu items.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => array(
		'font-family'    => '',
		'variant'        => '500',
		'line-height'    => '1.58',
		'letter-spacing' => '0em',
		'text-transform' => 'none',
	),
	'output'      => array(
		array(
			'element' => '
			.sm-simple .sub-menu a,
			.sm-simple .children a,
			.sm-simple .sub-menu .menu-item-title,
			.sm-simple .tm-list .item-wrapper
			',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'slider',
	'settings'    => $prefix . 'dropdown_link_font_size',
	'label'       => esc_html__( 'Font Size', 'brook' ),
	'description' => esc_html__( 'Controls the font size for dropdown menu items.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 14,
	'transport'   => 'auto',
	'choices'     => array(
		'min'  => 10,
		'max'  => 50,
		'step' => 1,
	),
	'output'      => array(
		array(
			'element'  => '.sm-simple .sub-menu a, .sm-simple .children a, .sm-simple .tm-list .item-title',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
) );

/*--------------------------------------------------------------
# Styling
--------------------------------------------------------------*/

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'dropdown_bg_color',
	'label'       => esc_html__( 'Background', 'brook' ),
	'description' => esc_html__( 'Controls the background color for dropdown menu', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#222222',
	'output'      => array(
		array(
			'element'  => array(
				'.sm-simple .sub-menu',
				'.sm-simple .children',
			),
			'property' => 'background-color',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'dropdown_box_shadow',
	'label'       => esc_html__( 'Box Shadow', 'brook' ),
	'description' => esc_html__( 'Input valid box-shadow for dropdown menu. For e.g: "0 0 37px rgba(0, 0, 0, .07)"', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'output'      => array(
		array(
			'element'  => array(
				'.sm-simple .sub-menu',
				'.sm-simple .children',
			),
			'property' => 'box-shadow',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'slider',
	'settings'    => $prefix . 'dropdown_border_bottom_width',
	'label'       => esc_html__( 'Border Bottom Width', 'brook' ),
	'description' => esc_html__( 'Controls the border bottom width for dropdown menu.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 0,
	'transport'   => 'auto',
	'choices'     => array(
		'min'  => 0,
		'max'  => 10,
		'step' => 1,
	),
	'output'      => array(
		array(
			'element'  => '
			.desktop-menu .sm-simple .sub-menu,
			.desktop-menu .sm-simple .children
			',
			'property' => 'border-bottom-width',
			'units'    => 'px',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'dropdown_border_bottom_color',
	'label'       => esc_html__( 'Border Bottom Color', 'brook' ),
	'description' => esc_html__( 'Controls the border bottom color for dropdown menu', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => Brook::PRIMARY_COLOR,
	'output'      => array(
		array(
			'element'  => array(
				'.desktop-menu .sm-simple .sub-menu,
                .desktop-menu .sm-simple .children',
			),
			'property' => 'border-bottom-color',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => $prefix . 'dropdown_link_color',
	'label'       => esc_html__( 'Color', 'brook' ),
	'description' => esc_html__( 'Controls the color for dropdown menu items.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#999999',
	'output'      => array(
		array(
			'element'  => array(
				'.sm-simple .sub-menu a',
				'.sm-simple .children a',
				'.sm-simple .tm-list .item-wrapper',
			),
			'property' => 'color',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => $prefix . 'dropdown_link_hover_color',
	'label'       => esc_html__( 'Hover Color', 'brook' ),
	'description' => esc_html__( 'Controls the color when hover for dropdown menu items.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#ffffff',
	'output'      => array(
		array(
			'element'  => array(
				'.sm-simple .sub-menu li:hover > a',
				'.sm-simple .children li:hover > a',
				'.sm-simple .tm-list li:hover .item-wrapper',
				'.sm-simple .sub-menu li:hover > a:after',
				'.sm-simple .children li:hover > a:after',
				'.sm-simple .sub-menu li.current-menu-item > a',
				'.sm-simple .sub-menu li.current-menu-ancestor > a',
			),
			'property' => 'color',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'dropdown_link_hover_bg_color',
	'label'       => esc_html__( 'Hover Background', 'brook' ),
	'description' => esc_html__( 'Controls the background color when hover for dropdown menu items.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => 'rgba( 255, 255, 255, 0 )',
	'output'      => array(
		array(
			'element'  => array(
				'.sm-simple .sub-menu li:hover > a',
				'.sm-simple .children li:hover > a',
				'.sm-simple .tm-list li:hover > a',
				'.sm-simple .sub-menu li.current-menu-item > a',
				'.sm-simple .sub-menu li.current-menu-ancestor > a',
			),
			'property' => 'background-color',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Mega Menu Dropdown', 'brook' ) . '</div>',
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => $prefix . 'dropdown_widget_title_color',
	'label'       => esc_html__( 'Color', 'brook' ),
	'description' => esc_html__( 'Controls the color for widget title.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#ffffff',
	'output'      => array(
		array(
			'element'  => array(
				'.desktop-menu .sm-simple .widgettitle',
			),
			'property' => 'color',
		),
	),
) );
