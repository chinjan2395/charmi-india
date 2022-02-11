<?php
$section  = 'navigation_mobile';
$priority = 1;
$prefix   = 'mobile_menu_';

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'number',
	'settings'    => $prefix . 'breakpoint',
	'label'       => esc_html__( 'Breakpoint', 'brook' ),
	'description' => esc_html__( 'Controls the breakpoint of the mobile menu.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'postMessage',
	'default'     => 1199,
	'choices'     => array(
		'min'  => 460,
		'max'  => 1300,
		'step' => 10,
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'      => 'radio-buttonset',
	'settings'  => $prefix . 'effect',
	'label'     => esc_html__( 'Opened Effect', 'brook' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'postMessage',
	'default'   => 'slide-to-right',
	'choices'   => array(
		'slide-to-right' => esc_html__( 'Slide To Right', 'brook' ),
		'slide-to-left'  => esc_html__( 'Slide To Left', 'brook' ),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'header_bg',
	'label'       => esc_html__( 'Header Background Color', 'brook' ),
	'description' => esc_html__( 'Controls the background color of the mobile menu header.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '#fff',
	'output'      => array(
		array(
			'element'  => '.page-mobile-menu-header',
			'property' => 'background',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'multicolor',
	'settings'    => $prefix . 'close_button_color',
	'label'       => esc_html__( 'Close Button Color', 'brook' ),
	'description' => esc_html__( 'Controls the color of close button.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'choices'     => array(
		'default' => esc_attr__( 'Default Color', 'brook' ),
		'hover'   => esc_attr__( 'Hover Color', 'brook' ),
	),
	'output'      => array(
		array(
			'choice'   => 'default',
			'element'  => '.page-close-mobile-menu',
			'property' => 'color',
		),
		array(
			'choice'   => 'hover',
			'element'  => '.page-close-mobile-menu:hover',
			'property' => 'color',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'bg_color',
	'label'       => esc_html__( 'Color', 'brook' ),
	'description' => esc_html__( 'Controls the background color of the mobile menu.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#000000',
	'output'      => array(
		array(
			'element'  => '.page-mobile-main-menu > .inner',
			'property' => 'background',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'      => 'radio-buttonset',
	'settings'  => $prefix . 'text_align',
	'label'     => esc_html__( 'Text Align', 'brook' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'auto',
	'default'   => 'left',
	'choices'   => array(
		'left'   => esc_html__( 'Left', 'brook' ),
		'center' => esc_html__( 'Center', 'brook' ),
		'right'  => esc_html__( 'Right', 'brook' ),
	),
	'output'    => array(
		array(
			'element'  => '.page-mobile-main-menu .menu__container',
			'property' => 'text-align',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'header_button_enable',
	'label'    => esc_html__( 'Header Button', 'brook' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '0',
	'choices'  => array(
		'0' => esc_html__( 'Hide', 'brook' ),
		'1' => esc_html__( 'Show', 'brook' ),
	),
) );

// Level 1.

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Level 1', 'brook' ) . '</div>',
) );

Brook_Kirki::add_field( 'theme', array(
	'type'      => 'spacing',
	'settings'  => $prefix . 'item_padding',
	'label'     => esc_html__( 'Item Padding', 'brook' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => array(
		'top'    => '19px',
		'bottom' => '19px',
		'left'   => '0',
		'right'  => '0',
	),
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => array(
				'.page-mobile-main-menu .menu__container > li > a',
			),
			'property' => 'padding',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'kirki_typography',
	'settings'    => $prefix . 'typo',
	'label'       => esc_html__( 'Typography', 'brook' ),
	'description' => esc_html__( 'Controls the typography for mobile menu items.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => array(
		'font-family'    => '',
		'variant'        => '500',
		'line-height'    => '1.5',
		'letter-spacing' => '',
		'text-transform' => '',
	),
	'output'      => array(
		array(
			'element' => '.page-mobile-main-menu .menu__container a',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'slider',
	'settings'    => $prefix . 'item_font_size',
	'label'       => esc_html__( 'Font Size', 'brook' ),
	'description' => esc_html__( 'Controls the font size of items level 1.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 14,
	'transport'   => 'auto',
	'choices'     => array(
		'min'  => 8,
		'max'  => 50,
		'step' => 1,
	),
	'output'      => array(
		array(
			'element'  => '.page-mobile-main-menu .menu__container > li > a',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => $prefix . 'link_color',
	'label'       => esc_html__( 'Link Color', 'brook' ),
	'description' => esc_html__( 'Controls the color of items level 1.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#999999',
	'output'      => array(
		array(
			'element'  => '.page-mobile-main-menu .menu__container > li > a',
			'property' => 'color',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => $prefix . 'link_hover_color',
	'label'       => esc_html__( 'Link Hover Color', 'brook' ),
	'description' => esc_html__( 'Controls the color when hover of items level 1.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#fff',
	'output'      => array(
		array(
			'element'  => '.page-mobile-main-menu .menu__container > li > a:hover,
            .page-mobile-main-menu .menu__container > li.opened > a',
			'property' => 'color',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'divider_color',
	'label'       => esc_html__( 'Divider Color', 'brook' ),
	'description' => esc_html__( 'Controls the divider color between items level 1', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => 'rgba(255, 255, 255, 0.15)',
	'output'      => array(
		array(
			'element'  => '
			.page-mobile-main-menu .menu__container > li + li > a,
			.page-mobile-main-menu .menu__container > li.opened > a',
			'property' => 'border-color',
		),
		array(
			'element'  => '.page-mobile-main-menu .widget-title, .page-mobile-main-menu .widgettitle',
			'property' => 'border-bottom-color',
		),
	),
) );

// Mobile Menu Drop down Menu.

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Sub Items', 'brook' ) . '</div>',
) );

Brook_Kirki::add_field( 'theme', array(
	'type'      => 'spacing',
	'settings'  => $prefix . 'sub_item_padding',
	'label'     => esc_html__( 'Item Padding', 'brook' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => array(
		'top'    => '10px',
		'bottom' => '10px',
		'left'   => '0',
		'right'  => '0',
	),
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => array(
				'.page-mobile-main-menu .sub-menu a',
				'.page-mobile-main-menu .children a',
			),
			'property' => 'padding',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'slider',
	'settings'    => $prefix . 'sub_item_font_size',
	'label'       => esc_html__( 'Font Size', 'brook' ),
	'description' => esc_html__( 'Controls the font size of sub items.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 14,
	'transport'   => 'auto',
	'choices'     => array(
		'min'  => 8,
		'max'  => 50,
		'step' => 1,
	),
	'output'      => array(
		array(
			'element'  => '
			.page-mobile-main-menu .sub-menu a,
			.page-mobile-main-menu .children a,
			.page-mobile-main-menu .tm-list__item
			',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => $prefix . 'sub_link_color',
	'label'       => esc_html__( 'Link Color', 'brook' ),
	'description' => esc_html__( 'Controls the color of sub items.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#999999',
	'output'      => array(
		array(
			'element'  => '
			.page-mobile-main-menu .sub-menu a,
			.page-mobile-main-menu .children a,
			.page-mobile-main-menu .tm-list__item',
			'property' => 'color',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => $prefix . 'sub_link_hover_color',
	'label'       => esc_html__( 'Link Hover Color', 'brook' ),
	'description' => esc_html__( 'Controls the color when hover of sub items.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#fff',
	'output'      => array(
		array(
			'element'  => '
			.page-mobile-main-menu .sub-menu a:hover,
			.page-mobile-main-menu .children a:hover,
            .page-mobile-main-menu .tm-list__item:hover,
            .page-mobile-main-menu .sub-menu .opened > a',
			'property' => 'color',
		),
	),
) );

// Widget Title
Brook_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Widget Title', 'brook' ) . '</div>',
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'kirki_typography',
	'settings'    => $prefix . 'widget_title_typo',
	'label'       => esc_html__( 'Typography', 'brook' ),
	'description' => esc_html__( 'Controls the typography for widget title.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => array(
		'font-family'    => '',
		'variant'        => '700',
		'line-height'    => '1.5',
		'letter-spacing' => '',
		'text-transform' => 'uppercase',
	),
	'output'      => array(
		array(
			'element' => '.page-mobile-main-menu .widgettitle',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'slider',
	'settings'    => $prefix . 'widget_title_font_size',
	'label'       => esc_html__( 'Font Size', 'brook' ),
	'description' => esc_html__( 'Controls the font size of widget title in sub mega menu.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 14,
	'transport'   => 'auto',
	'choices'     => array(
		'min'  => 8,
		'max'  => 50,
		'step' => 1,
	),
	'output'      => array(
		array(
			'element'  => '.page-mobile-main-menu .widgettitle',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => $prefix . 'widget_title_color',
	'label'       => esc_html__( 'Widget Title Color', 'brook' ),
	'description' => esc_html__( 'Controls the color of widget title.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#fff',
	'output'      => array(
		array(
			'element'  => '.page-mobile-main-menu .widgettitle',
			'property' => 'color',
		),
	),
) );
