<?php
$section  = 'navigation_minimal_01';
$priority = 1;
$prefix   = 'navigation_minimal_01_';

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'menu_title',
	'label'       => esc_html__( 'Menu Title', 'brook' ),
	'description' => esc_html__( 'Input a text that displays next to open button. Fox Ex: Menu', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'background',
	'settings'    => $prefix . 'background',
	'label'       => esc_html__( 'Background', 'brook' ),
	'description' => esc_html__( 'Controls the background of canvas menu.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => array(
		'background-color'      => '#222',
		'background-image'      => BROOK_THEME_IMAGE_URI . '/canvas-menu-bg.jpg',
		'background-repeat'     => 'no-repeat',
		'background-size'       => 'cover',
		'background-attachment' => 'scroll',
		'background-position'   => 'center center',
	),
	'output'      => array(
		array(
			'element' => '.page-off-canvas-main-menu',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'close_button_color',
	'label'       => esc_html__( 'Close Button Color', 'brook' ),
	'description' => esc_html__( 'Controls the color of close button.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#fff',
	'output'      => array(
		array(
			'element'  => '.page-close-main-menu:before, .page-close-main-menu:after',
			'property' => 'background-color',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'heading_color',
	'label'       => esc_html__( 'Heading Color', 'brook' ),
	'description' => esc_html__( 'Controls the heading color in canvas menu.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#fff',
	'output'      => array(
		array(
			'element'  => '
			.page-off-canvas-main-menu h1,
			.page-off-canvas-main-menu h2,
			.page-off-canvas-main-menu h3,
			.page-off-canvas-main-menu h4,
			.page-off-canvas-main-menu h5,
			.page-off-canvas-main-menu h6
			',
			'property' => 'color',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'link_color',
	'label'       => esc_html__( 'Link Color', 'brook' ),
	'description' => esc_html__( 'Controls the link color in canvas menu.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#999',
	'output'      => array(
		array(
			'element'  => '.page-off-canvas-main-menu a',
			'property' => 'color',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'link_hover_color',
	'label'       => esc_html__( 'Link Hover Color', 'brook' ),
	'description' => esc_html__( 'Controls the link color when hover in canvas menu.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#fff',
	'output'      => array(
		array(
			'element'  => '.page-off-canvas-main-menu a:hover',
			'property' => 'color',
		),
	),
) );

/*--------------------------------------------------------------
# Level 1
--------------------------------------------------------------*/
Brook_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Main Menu Level 1', 'brook' ) . '</div>',
) );

Brook_Kirki::add_field( 'theme', array(
	'type'      => 'spacing',
	'settings'  => $prefix . 'nav_margin',
	'label'     => esc_html__( 'Menu Margin', 'brook' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => array(
		'top'    => '-10px',
		'bottom' => '-10px',
		'left'   => '-24px',
		'right'  => '-24px',
	),
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => array(
				'.page-off-canvas-main-menu .menu__container',
			),
			'property' => 'margin',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'      => 'spacing',
	'settings'  => $prefix . 'item_padding',
	'label'     => esc_html__( 'Item Padding', 'brook' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => array(
		'top'    => '10px',
		'bottom' => '10px',
		'left'   => '24px',
		'right'  => '24px',
	),
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => array(
				'.page-off-canvas-main-menu .menu__container > li > a',
				'.page-off-canvas-main-menu .menu__container > ul > li > a',
			),
			'property' => 'padding',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'kirki_typography',
	'settings'    => $prefix . 'typography',
	'label'       => esc_html__( 'Typography', 'brook' ),
	'description' => esc_html__( 'These settings control the typography for menu items.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => array(
		'font-family'    => '',
		'variant'        => '600',
		'line-height'    => '1.4',
		'letter-spacing' => '',
		'text-transform' => '',
	),
	'output'      => array(
		array(
			'element' => '.page-off-canvas-main-menu .menu__container > li > a',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'slider',
	'settings'    => $prefix . 'item_font_size',
	'label'       => esc_html__( 'Font Size', 'brook' ),
	'description' => esc_html__( 'Controls the font size for main menu items.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 48,
	'transport'   => 'auto',
	'choices'     => array(
		'min'  => 10,
		'max'  => 50,
		'step' => 1,
	),
	'output'      => array(
		array(
			'element'  => '.page-off-canvas-main-menu .menu__container > li > a',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'item_color',
	'label'       => esc_html__( 'Color', 'brook' ),
	'description' => esc_html__( 'Controls the color for main menu items.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#fff',
	'output'      => array(
		array(
			'element'  => '.page-off-canvas-main-menu .menu__container > li > a',
			'property' => 'color',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'item_hover_color',
	'label'       => esc_html__( 'Hover Color', 'brook' ),
	'description' => esc_html__( 'Controls the color when hover for main menu items.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => Brook::PRIMARY_COLOR,
	'output'      => array(
		array(
			'element'  => '
            .page-off-canvas-main-menu .menu__container  > li > a:hover,
            .page-off-canvas-main-menu .menu__container  > li > a:focus
            ',
			'property' => 'color',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'search_enable',
	'label'    => esc_html__( 'Search', 'brook' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '1',
	'choices'  => array(
		'0' => esc_html__( 'Hide', 'brook' ),
		'1' => esc_html__( 'Show', 'brook' ),
	),
) );

Brook_Customize::field_social_networks_enable( array(
	'settings' => $prefix . 'social_networks_enable',
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '1',
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'textarea',
	'settings' => $prefix . 'left_text',
	'label'    => esc_html__( 'Left text', 'brook' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<h5>Connect</h5>
					<div>2005 Stokes Isle Apt. 896, Venaville 10010, USA</div>
					<div><a href="mailto:info@yourdomain.com">info@yourdomain.com</a></div>',
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'textarea',
	'settings' => $prefix . 'right_text',
	'label'    => esc_html__( 'Right text', 'brook' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => esc_html__( '&copy; 2019 Brook. All Rights Reserved.', 'brook' ),
) );
