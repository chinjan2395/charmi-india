<?php
$section  = 'header_style_21';
$priority = 1;
$prefix   = 'header_style_21_';

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'overlay',
	'label'    => esc_html__( 'Header Overlay', 'brook' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '1',
	'choices'  => array(
		'0' => esc_html__( 'No', 'brook' ),
		'1' => esc_html__( 'Yes', 'brook' ),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'logo',
	'label'    => esc_html__( 'Logo', 'brook' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => 'dark',
	'choices'  => array(
		'light' => esc_html__( 'Light', 'brook' ),
		'dark'  => esc_html__( 'Dark', 'brook' ),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'search_enable',
	'label'    => esc_html__( 'Search', 'brook' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '0',
	'choices'  => array(
		'0' => esc_html__( 'Hide', 'brook' ),
		'1' => esc_html__( 'Show', 'brook' ),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'cart_enable',
	'label'    => esc_html__( 'Mini Cart', 'brook' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '0',
	'choices'  => array(
		'0'             => esc_html__( 'Hide', 'brook' ),
		'1'             => esc_html__( 'Show', 'brook' ),
		'hide_on_empty' => esc_html__( 'Hide On Empty', 'brook' ),
	),
) );

Brook_Customize::field_social_networks_enable( array(
	'settings' => $prefix . 'social_networks_enable',
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '1',
) );

Brook_Customize::field_language_switcher_enable( array(
	'settings' => $prefix . 'language_switcher_enable',
	'section'  => $section,
	'priority' => $priority++,
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
			'element'  => '.header-21 .page-header-inner',
			'property' => 'border-bottom-width',
			'units'    => 'px',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'border_color',
	'label'       => esc_html__( 'Border Color', 'brook' ),
	'description' => esc_html__( 'Controls the border color.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#EAEAEA',
	'output'      => array(
		array(
			'element'  => '.header-21 .page-header-inner',
			'property' => 'border-color',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'box_shadow',
	'label'       => esc_html__( 'Box Shadow', 'brook' ),
	'description' => esc_html__( 'Input box shadow for header. For e.g: 0 0 5px #ccc', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'output'      => array(
		array(
			'element'  => '.header-21 .page-header-inner',
			'property' => 'box-shadow',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'background',
	'settings'    => $prefix . 'background',
	'label'       => esc_html__( 'Background', 'brook' ),
	'description' => esc_html__( 'Controls the background of header.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => array(
		'background-color'      => '',
		'background-image'      => '',
		'background-repeat'     => 'no-repeat',
		'background-size'       => 'cover',
		'background-attachment' => 'scroll',
		'background-position'   => 'center center',
	),
	'output'      => array(
		array(
			'element' => '.header-21 .page-header-inner',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'header_icon_color',
	'label'       => esc_html__( 'Icon Color', 'brook' ),
	'description' => esc_html__( 'Controls the color of icons on header.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#111',
	'output'      => array(
		array(
			'element'  => '
			.header-21 .wpml-ls-item-toggle,
			.header-21 .header-social-networks a,
			.header-21 .page-open-mobile-menu i,
			.header-21 .popup-search-wrap i,
			.header-21 .mini-cart .mini-cart-icon',
			'property' => 'color',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'header_icon_hover_color',
	'label'       => esc_html__( 'Icon Hover Color', 'brook' ),
	'description' => esc_html__( 'Controls the color when hover of icons on header.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#68AE4A',
	'output'      => array(
		array(
			'element'  => '
			.header-21 .header-social-networks a:hover,
			.header-21 .page-open-mobile-menu:hover i,
			.header-21 .popup-search-wrap:hover i,
			.header-21 .mini-cart .mini-cart-icon:hover
			',
			'property' => 'color',
		),
		array(
			'element'  => '.header-21 .wpml-ls-slot-shortcode_actions:hover > .js-wpml-ls-item-toggle',
			'property' => 'color',
			'suffix'   => '!important',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'cart_badge_background_color',
	'label'       => esc_html__( 'Cart Badge Background Color', 'brook' ),
	'description' => esc_html__( 'Controls the background color of cart badge.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#111',
	'output'      => array(
		array(
			'element'  => '.header-21 .mini-cart .mini-cart-icon:after',
			'property' => 'background-color',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'cart_badge_color',
	'label'       => esc_html__( 'Cart Badge Color', 'brook' ),
	'description' => esc_html__( 'Controls the color of cart badge.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#fff',
	'output'      => array(
		array(
			'element'  => '.header-21 .mini-cart .mini-cart-icon:after',
			'property' => 'color',
		),
	),
) );

/*--------------------------------------------------------------
# Navigation
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
	'settings'  => $prefix . 'navigation_margin',
	'label'     => esc_html__( 'Menu Margin', 'brook' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'auto',
	'default'   => array(
		'top'    => '0px',
		'bottom' => '0px',
		'left'   => '0px',
		'right'  => '0px',
	),
	'output'    => array(
		array(
			'element'  => array(
				'.desktop-menu .header-21 .menu__container',
			),
			'property' => 'margin',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'      => 'spacing',
	'settings'  => $prefix . 'navigation_item_padding',
	'label'     => esc_html__( 'Item Padding', 'brook' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => array(
		'top'    => '32px',
		'bottom' => '32px',
		'left'   => '3px',
		'right'  => '3px',
	),
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => array(
				'.desktop-menu .header-21 .menu--primary .menu__container > li > a',
			),
			'property' => 'padding',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'      => 'spacing',
	'settings'  => $prefix . 'navigation_item_margin',
	'label'     => esc_html__( 'Item Margin', 'brook' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => array(
		'top'    => '0px',
		'bottom' => '0px',
		'left'   => '22px',
		'right'  => '22px',
	),
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => array(
				'.desktop-menu .header-21  .menu--primary .menu__container > li',
			),
			'property' => 'margin',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'kirki_typography',
	'settings'    => $prefix . 'navigation_typography',
	'label'       => esc_html__( 'Typography', 'brook' ),
	'description' => esc_html__( 'These settings control the typography for menu items.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => array(
		'font-family'    => '',
		'variant'        => '300',
		'line-height'    => '1.18',
		'letter-spacing' => '',
		'text-transform' => '',
	),
	'output'      => array(
		array(
			'element' => '.header-21 .menu--primary a',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'slider',
	'settings'    => $prefix . 'navigation_item_font_size',
	'label'       => esc_html__( 'Font Size', 'brook' ),
	'description' => esc_html__( 'Controls the font size for main menu items.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 16,
	'transport'   => 'auto',
	'choices'     => array(
		'min'  => 10,
		'max'  => 50,
		'step' => 1,
	),
	'output'      => array(
		array(
			'element'  => '.header-21 .menu--primary a',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'navigation_link_color',
	'label'       => esc_html__( 'Color', 'brook' ),
	'description' => esc_html__( 'Controls the color for main menu items.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#777',
	'output'      => array(
		array(
			'element'  => '
			.header-21 .menu--primary a
			',
			'property' => 'color',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'navigation_link_hover_color',
	'label'       => esc_html__( 'Hover Color', 'brook' ),
	'description' => esc_html__( 'Controls the color when hover for main menu items.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#111',
	'output'      => array(
		array(
			'element'  => '
            .header-21 .menu--primary li:hover > a,
            .header-21 .menu--primary > ul > li > a:hover,
            .header-21 .menu--primary > ul > li > a:focus,
            .header-21 .menu--primary .current-menu-ancestor > a,
            .header-21 .menu--primary .current-menu-item > a',
			'property' => 'color',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'navigation_link_background_color',
	'label'       => esc_html__( 'Background Color', 'brook' ),
	'description' => esc_html__( 'Controls the background color for main menu items.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '',
	'output'      => array(
		array(
			'element'  => '.header-21 .menu--primary .menu__container > li > a',
			'property' => 'background-color',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'navigation_link_hover_background_color',
	'label'       => esc_html__( 'Hover Background Color', 'brook' ),
	'description' => esc_html__( 'Controls the background color when hover for main menu items.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '',
	'output'      => array(
		array(
			'element'  => '
            .header-21 .menu--primary .menu__container > li > a:hover,
            .header-21 .menu--primary .menu__container > li.current-menu-item > a',
			'property' => 'background-color',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'navigation_link_border_color',
	'label'       => esc_html__( 'Color', 'brook' ),
	'description' => esc_html__( 'Controls the color for link border when hover.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#68AE4A',
	'output'      => array(
		array(
			'element'  => '
			.header-21 .menu__container > li > a:after
			',
			'property' => 'color',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Button', 'brook' ) . '</div>',
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'text',
	'settings' => $prefix . 'button_text',
	'label'    => esc_html__( 'Button Text', 'brook' ),
	'section'  => $section,
	'priority' => $priority++,
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'text',
	'settings' => $prefix . 'button_link',
	'label'    => esc_html__( 'Button link', 'brook' ),
	'section'  => $section,
	'priority' => $priority++,
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'button_link_target',
	'label'    => esc_html__( 'Open link in a new tab.', 'brook' ),
	'section'  => $section,
	'priority' => $priority++,
	'choices'  => array(
		'0' => esc_html__( 'No', 'brook' ),
		'1' => esc_html__( 'Yes', 'brook' ),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'text',
	'settings' => $prefix . 'button_class',
	'label'    => esc_html__( 'Button Class', 'brook' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '',
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'multicolor',
	'settings'    => $prefix . 'button_color',
	'label'       => esc_html__( 'Button Color', 'brook' ),
	'description' => esc_html__( 'Controls the color of button.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'choices'     => array(
		'color'      => esc_attr__( 'Color', 'brook' ),
		'background' => esc_attr__( 'Background', 'brook' ),
		'border'     => esc_attr__( 'Border', 'brook' ),
	),
	'default'     => array(
		'color'      => '#222',
		'background' => '#fff',
		'border'     => '#fff',
	),
	'output'      => array(
		array(
			'choice'   => 'color',
			'element'  => '.header-21 .tm-button',
			'property' => 'color',
		),
		array(
			'choice'   => 'border',
			'element'  => '.header-21 .tm-button',
			'property' => 'border-color',
		),
		array(
			'choice'   => 'background',
			'element'  => '.header-21 .tm-button',
			'property' => 'background-color',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'multicolor',
	'settings'    => $prefix . 'button_hover_color',
	'label'       => esc_html__( 'Button Hover Color', 'brook' ),
	'description' => esc_html__( 'Controls the color of button when hover.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'choices'     => array(
		'color'      => esc_attr__( 'Color', 'brook' ),
		'background' => esc_attr__( 'Background', 'brook' ),
		'border'     => esc_attr__( 'Border', 'brook' ),
	),
	'default'     => array(
		'color'      => '#222',
		'background' => '#fff',
		'border'     => '#fff',
	),
	'output'      => array(
		array(
			'choice'   => 'color',
			'element'  => '.header-21 .tm-button:hover',
			'property' => 'color',
		),
		array(
			'choice'   => 'border',
			'element'  => '.header-21 .tm-button:hover',
			'property' => 'border-color',
		),
		array(
			'choice'   => 'background',
			'element'  => '.header-21 .tm-button:hover',
			'property' => 'background-color',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Header Sticky', 'brook' ) . '</div>',
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'background',
	'settings'    => $prefix . 'sticky_background',
	'label'       => esc_html__( 'Background', 'brook' ),
	'description' => esc_html__( 'Controls the background of header when sticky.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => array(
		'background-color'      => '#fff',
		'background-image'      => '',
		'background-repeat'     => 'no-repeat',
		'background-size'       => 'cover',
		'background-attachment' => 'scroll',
		'background-position'   => 'center center',
	),
	'output'      => array(
		array(
			'element' => '.header-21.headroom--not-top .page-header-inner',
		),
	),
) );
