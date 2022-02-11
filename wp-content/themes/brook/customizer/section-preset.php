<?php
$section  = 'settings_preset';
$priority = 1;
$prefix   = 'settings_preset_';

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'preset',
	'settings' => 'settings_preset',
	'label'    => esc_html__( 'Settings Preset', 'brook' ),
	'section'  => $section,
	'default'  => '-1',
	'priority' => $priority++,
	'multiple' => 3,
	'choices'  => array(
		'-1' => array(
			'label'    => esc_html__( 'None', 'brook' ),
			'settings' => array(),
		),
		'01' => array(
			'label'    => esc_html__( '01 - Creative Agency', 'brook' ),
			'settings' => array_merge( Brook_Customize::get_preset_settings( array(
				'primary_color' => '#FE378C',
			) ), array(
				'secondary_color'    => '#FE5B34',
				'typography_body'    => array(
					'font-family'    => 'Montserrat',
					'variant'        => '500',
					'line-height'    => '1.6',
					'letter-spacing' => '0em',
				),
				'body_font_size'     => 15,
				'typography_heading' => array(
					'font-family'    => 'Montserrat',
					'variant'        => '700',
					'line-height'    => '1.23',
					'letter-spacing' => '0em',
				),
			) ),
		),
		'02' => array(
			'label'    => esc_html__( '02 - Business', 'brook' ),
			'settings' => array(
				'typography_body'    => array(
					'font-family'    => 'Louis George Cafe',
					'variant'        => '700',
					'line-height'    => '1.32',
					'letter-spacing' => '0em',
				),
				'body_font_size'     => 16,
				'typography_heading' => array(
					'font-family'    => 'Poppins',
					'variant'        => '600',
					'line-height'    => '1.23',
					'letter-spacing' => '0em',
				),
				'secondary_font'     => array(
					'font-family' => 'Louis George Cafe',
				),
				'secondary_color'    => '#FF5EE1',
			),
		),
		'03' => array(
			'label'    => esc_html__( '03 - Vertical Menu', 'brook' ),
			'settings' => array_merge( Brook_Customize::get_preset_settings( array(
				'primary_color' => '#AC61EE',
			) ), array(
				'secondary_color' => '#F23E20',
				'secondary_font'  => array(
					'font-family' => '',
				),
			) ),
		),
		'04' => array(
			'label'    => esc_html__( '04 - Design Studio', 'brook' ),
			'settings' => array_merge( Brook_Customize::get_preset_settings( array(
				'primary_color' => '#E33A3F',
			) ), array(
				'secondary_font' => array(
					'font-family' => 'Playfair Display',
				),
			) ),
		),
		'05' => array(
			'label'    => esc_html__( '05 - Freelancer', 'brook' ),
			'settings' => array_merge( Brook_Customize::get_preset_settings( array(
				'primary_color' => '#FCB72B',
			) ), array()
			),
		),
		'06' => array(
			'label'    => esc_html__( '06 - Creative Portfolio', 'brook' ),
			'settings' => array(
				'primary_color'      => '#99E5E8',
				'link_color_hover'   => '#99E5E8',
				'typography_body'    => array(
					'font-family'    => 'Roboto',
					'variant'        => '400',
					'line-height'    => '1.38',
					'letter-spacing' => '0em',
				),
				'body_font_size'     => 16,
				'typography_heading' => array(
					'font-family'    => 'Roboto',
					'variant'        => '400',
					'line-height'    => '1.23',
					'letter-spacing' => '0em',
				),
				'secondary_font'     => array(
					'font-family' => 'Playfair Display',
				),
			),
		),
		'07' => array(
			'label'    => esc_html__( '07', 'brook' ),
			'settings' => array(
				'typography_body'    => array(
					'font-family'    => 'Louis George Cafe',
					'variant'        => '700',
					'line-height'    => '1.38',
					'letter-spacing' => '0em',
				),
				'body_font_size'     => 16,
				'typography_heading' => array(
					'font-family'    => 'Louis George Cafe',
					'variant'        => '700',
					'line-height'    => '1.23',
					'letter-spacing' => '0em',
				),
			),
		),
		'08' => array(
			'label'    => esc_html__( '08 - Vertical Slide Portfolio', 'brook' ),
			'settings' => array(
				'primary_color'      => '#FB6031',
				'link_color_hover'   => '#FB6031',
				'typography_body'    => array(
					'font-family'    => 'Louis George Cafe',
					'variant'        => '700',
					'line-height'    => '1.38',
					'letter-spacing' => '0em',
				),
				'body_font_size'     => 16,
				'typography_heading' => array(
					'font-family'    => 'Louis George Cafe',
					'variant'        => '700',
					'line-height'    => '1.23',
					'letter-spacing' => '0em',
				),
				'secondary_font'     => array(
					'font-family' => 'Poppins',
				),
			),
		),
		'09' => array(
			'label'    => esc_html__( '09', 'brook' ),
			'settings' => Brook_Customize::get_preset_settings( array(
				'primary_color' => '#19D2A8',
			) ),
		),
		'10' => array(
			'label'    => esc_html__( '10', 'brook' ),
			'settings' => Brook_Customize::get_preset_settings( array(
				'primary_color' => '#0069FF',
			) ),
		),
		'11' => array(
			'label'    => esc_html__( '11 - Presentation', 'brook' ),
			'settings' => array(
				'primary_color'          => '#A810E0',
				'link_color_hover'       => '#A810E0',
				'form_input_focus_color' => array(
					'color'      => '#A810E0',
					'background' => '#fff',
					'border'     => '#A810E0',
				),
				'typography_body'        => array(
					'font-family'    => 'Louis George Cafe',
					'variant'        => '700',
					'line-height'    => '1.38',
					'letter-spacing' => '0em',
				),
				'body_font_size'         => 16,
				'typography_heading'     => array(
					'font-family'    => 'Louis George Cafe',
					'variant'        => '700',
					'line-height'    => '1.23',
					'letter-spacing' => '0em',
				),
			),
		),
		'12' => array(
			'label'    => esc_html__( '12 - Portfolio Fullscreen Slider - Left Vertical Header', 'brook' ),
			'settings' => array(
				'typography_body'        => array(
					'font-family'    => 'Montserrat',
					'variant'        => '500',
					'line-height'    => '1.58',
					'letter-spacing' => '0em',
				),
				'body_font_size'         => 14,
				'typography_heading'     => array(
					'font-family'    => 'Montserrat',
					'variant'        => '600',
					'line-height'    => '1.23',
					'letter-spacing' => '0em',
				),
				'primary_color'          => '#82CECF',
				'secondary_color'        => '#FFB805',
				'link_color_hover'       => '#82CECF',
				'form_input_focus_color' => array(
					'color'      => '#82CECF',
					'background' => '#fff',
					'border'     => '#82CECF',
				),
			),
		),
		'13' => array(
			'label'    => esc_html__( '13 - Portfolio Masonry - Left Vertical Header', 'brook' ),
			'settings' => array(
				'typography_body'        => array(
					'font-family'    => 'Montserrat',
					'variant'        => '500',
					'line-height'    => '1.58',
					'letter-spacing' => '0em',
				),
				'body_font_size'         => 14,
				'typography_heading'     => array(
					'font-family'    => 'Montserrat',
					'variant'        => '600',
					'line-height'    => '1.23',
					'letter-spacing' => '0em',
				),
				'secondary_font'         => array(
					'font-family' => 'Playfair Display',
				),
				'primary_color'          => '#F0263F',
				'secondary_color'        => '#FFB805',
				'link_color_hover'       => '#F0263F',
				'form_input_focus_color' => array(
					'color'      => '#F0263F',
					'background' => '#fff',
					'border'     => '#F0263F',
				),
			),
		),
		'14' => array(
			'label'    => esc_html__( '14 - Grid Blog', 'brook' ),
			'settings' => Brook_Customize::get_preset_settings( array(
				'primary_color' => '#899664',
			) ),
		),
		'15' => array(
			'label'    => esc_html__( '15 - Metro Blog', 'brook' ),
			'settings' => array_merge( Brook_Customize::get_preset_settings( array(
				'primary_color' => '#F5A623',
			) ), array(
				'typography_body'                       => array(
					'font-family'    => 'Louis George Cafe',
					'variant'        => '700',
					'line-height'    => '1.38',
					'letter-spacing' => '0em',
				),
				'body_font_size'                        => 16,
				'typography_heading'                    => array(
					'font-family'    => 'Louis George Cafe',
					'variant'        => '700',
					'line-height'    => '1.23',
					'letter-spacing' => '0em',
				),
				'header_style_06_navigation_typography' => array(
					'font-family'    => '',
					'variant'        => '700',
					'line-height'    => '1.18',
					'letter-spacing' => '',
					'text-transform' => '',
				),
			) ),
		),
		'16' => array(
			'label'    => esc_html__( '16 - Product Landing', 'brook' ),
			'settings' => Brook_Customize::get_preset_settings( array(
				'primary_color' => '#F1C078',
			) ),
		),
		'17' => array(
			'label'    => esc_html__( '17 - Minimal Agency', 'brook' ),
			'settings' => array_merge(
				Brook_Customize::get_preset_settings( array(
					'primary_color' => '#F12C6E',
				) ),
				array(
					'typography_body'                         => array(
						'font-family'    => 'Montserrat',
						'variant'        => '500',
						'line-height'    => '1.58',
						'letter-spacing' => '0em',
					),
					'body_font_size'                          => 14,
					'typography_heading'                      => array(
						'font-family'    => 'Montserrat',
						'variant'        => '600',
						'line-height'    => '1.23',
						'letter-spacing' => '0em',
					),
					'secondary_font'                          => array(
						'font-family' => 'Playfair Display',
					),
					'header_style_04_header_icon_color'       => '#999',
					'header_style_04_header_icon_hover_color' => '#000',
				)
			),
		),
		'18' => array(
			'label'    => esc_html__( '18 - Start-ups', 'brook' ),
			'settings' => Brook_Customize::get_preset_settings( array(
				'primary_color' => '#F8A440',
			) ),
		),
		'19' => array(
			'label'    => esc_html__( '19 - Indie Musician', 'brook' ),
			'settings' => array_merge( Brook_Customize::get_preset_settings( array(
				'primary_color' => '#F55D4E',
			) ), array(
				'typography_body'                       => array(
					'font-family'    => 'Louis George Cafe',
					'variant'        => '700',
					'line-height'    => '1.38',
					'letter-spacing' => '0em',
				),
				'body_font_size'                        => 16,
				'typography_heading'                    => array(
					'font-family'    => 'Louis George Cafe',
					'variant'        => '700',
					'line-height'    => '1.23',
					'letter-spacing' => '0em',
				),
				'header_style_06_navigation_typography' => array(
					'font-family'    => '',
					'variant'        => '700',
					'line-height'    => '1.18',
					'letter-spacing' => '',
					'text-transform' => '',
				),
			) ),
		),
		'20' => array(
			'label'    => esc_html__( '20 - Minimal Metro Grid', 'brook' ),
			'settings' => Brook_Customize::get_preset_settings( array(
				'primary_color' => '#B013FE',
			) ),
		),
		'21' => array(
			'label'    => esc_html__( '21 - Shop', 'brook' ),
			'settings' => Brook_Customize::get_preset_settings( array(
				'primary_color' => '#CAC0B3',
			) ),
		),
		'22' => array(
			'label'    => esc_html__( '22 - Masonry Gallery', 'brook' ),
			'settings' => array_merge( Brook_Customize::get_preset_settings( array(
				'primary_color' => '#F5A623',
			) ), array(
				'typography_body'                         => array(
					'font-family'    => 'Louis George Cafe',
					'variant'        => '700',
					'line-height'    => '1.38',
					'letter-spacing' => '0em',
				),
				'body_font_size'                          => 16,
				'typography_heading'                      => array(
					'font-family'    => 'Louis George Cafe',
					'variant'        => '700',
					'line-height'    => '1.23',
					'letter-spacing' => '0em',
				),
				'header_style_04_header_icon_color'       => '#999',
				'header_style_04_header_icon_hover_color' => '#222',
			) ),
		),
		'23' => array(
			'label'    => esc_html__( '23 - Gradient Slide', 'brook' ),
			'settings' => array(
				'typography_body'                         => array(
					'font-family'    => 'Louis George Cafe',
					'variant'        => '700',
					'line-height'    => '1.38',
					'letter-spacing' => '0em',
				),
				'body_font_size'                          => 16,
				'typography_heading'                      => array(
					'font-family'    => 'Louis George Cafe',
					'variant'        => '700',
					'line-height'    => '1.23',
					'letter-spacing' => '0em',
				),
				'header_style_07_search_enable'           => '0',
				'header_style_07_cart_enable'             => '0',
				'header_style_07_social_networks_enable'  => '1',
				'header_style_07_header_icon_color'       => '#999',
				'header_style_07_header_icon_hover_color' => '#222',
			),
		),
		'24' => array(
			'label'    => esc_html__( '24 - Photo Slide Gallery', 'brook' ),
			'settings' => array(
				'typography_body'    => array(
					'font-family'    => 'Louis George Cafe',
					'variant'        => '700',
					'line-height'    => '1.38',
					'letter-spacing' => '0em',
				),
				'body_font_size'     => 16,
				'typography_heading' => array(
					'font-family'    => 'Louis George Cafe',
					'variant'        => '700',
					'line-height'    => '1.23',
					'letter-spacing' => '0em',
				),
				'secondary_font'     => array(
					'font-family' => 'Reenie Beanie',
				),
			),
		),
		'25' => array(
			'label'    => esc_html__( '25 - Architect', 'brook' ),
			'settings' => array_merge( Brook_Customize::get_preset_settings( array(
				'primary_color' => '#FCB72B',
			) ), array(
					'heading_color'          => '#001029',
					'secondary_color'        => '#001029',
					'button_color'           => array(
						'color'      => '#001029',
						'background' => '#FCB72B',
						'border'     => '#FCB72B',
					),
					'button_hover_color'     => array(
						'color'      => '#001029',
						'background' => '#FCB72B',
						'border'     => '#FCB72B',
					),
					'form_input_color'       => array(
						'color'      => '#001029',
						'background' => '#fff',
						'border'     => '#ddd',
					),
					'form_input_focus_color' => array(
						'color'      => '#001029',
						'background' => '#fff',
						'border'     => '#FCB72B',
					),
				)
			),
		),
		'26' => array(
			'label'    => esc_html__( '26 - Digital Broadsheets', 'brook' ),
			'settings' => array(
				'typography_body'    => array(
					'font-family'    => 'Louis George Cafe',
					'variant'        => '700',
					'line-height'    => '1.38',
					'letter-spacing' => '0em',
				),
				'body_font_size'     => 16,
				'typography_heading' => array(
					'font-family'    => 'Louis George Cafe',
					'variant'        => '700',
					'line-height'    => '1.23',
					'letter-spacing' => '0em',
				),
				'secondary_font'     => array(
					'font-family' => '',
				),
				'button_typography'  => array(
					'font-family'    => '',
					'variant'        => '700',
					'font-size'      => '18px',
					'letter-spacing' => '0em',
				),
			),
		),
		'27' => array(
			'label'    => esc_html__( '27 - Revolutionary', 'brook' ),
			'settings' => Brook_Customize::get_preset_settings( array(
				'primary_color' => '#F05874',
			) ),
		),
		'28' => array(
			'label'    => esc_html__( '28 - Authentic Studio', 'brook' ),
			'settings' => array_merge( Brook_Customize::get_preset_settings( array(
				'primary_color' => '#CE8F4F',
			) ), array(
				'typography_body'    => array(
					'font-family'    => 'Louis George Cafe',
					'variant'        => '700',
					'line-height'    => '1.38',
					'letter-spacing' => '0em',
				),
				'body_font_size'     => 16,
				'typography_heading' => array(
					'font-family'    => 'Poppins',
					'variant'        => '600',
					'line-height'    => '1.23',
					'letter-spacing' => '0em',
				),
				'secondary_font'     => array(
					'font-family' => 'Poppins',
				),
				'button_typography'  => array(
					'font-family'    => 'Louis George Cafe',
					'variant'        => '700',
					'letter-spacing' => '0em',
					'font-size'      => '16px',
				),
			) ),
		),
		'29' => array(
			'label'    => esc_html__( '29 - Astronomy', 'brook' ),
			'settings' => array(
				'secondary_font' => array(
					'font-family' => 'Bebas Neue',
					'variant'     => '700',
				),
			),
		),
		'30' => array(
			'label'    => esc_html__( '30 - Restaurant', 'brook' ),
			'settings' => array_merge( Brook_Customize::get_preset_settings( array(
				'primary_color' => '#BC9464',
			) ), array(
				'typography_body'    => array(
					'font-family'    => 'CerebriSans',
					'variant'        => '400',
					'line-height'    => '1.75',
					'letter-spacing' => '0em',
				),
				'body_font_size'     => 16,
				'typography_heading' => array(
					'font-family'    => 'CerebriSans',
					'variant'        => '700',
					'line-height'    => '1.23',
					'letter-spacing' => '0em',
				),
				'button_typography'  => array(
					'font-family'    => 'CerebriSans',
					'variant'        => '500',
					'letter-spacing' => '1px',
					'font-size'      => '13px',
					'text-transform' => 'uppercase',
				),
				'secondary_font'     => array(
					'font-family' => 'Pinyon Script',
					'variant'     => '400',
				),
			) ),
		),
		'31' => array(
			'label'    => esc_html__( '31 - Essential', 'brook' ),
			'settings' => array_merge( Brook_Customize::get_preset_settings( array(
				'primary_color' => '#68AE4A',
			) ), array(
				'typography_body'    => array(
					'font-family'    => 'CerebriSans',
					'variant'        => '400',
					'line-height'    => '1.75',
					'letter-spacing' => '0em',
				),
				'body_font_size'     => 16,
				'body_color'         => '#777',
				'typography_heading' => array(
					'font-family'    => 'CerebriSans',
					'variant'        => '700',
					'line-height'    => '1.23',
					'letter-spacing' => '0em',
				),
				'button_typography'  => array(
					'font-family'    => 'CerebriSans',
					'variant'        => '500',
					'letter-spacing' => '1px',
					'font-size'      => '13px',
					'text-transform' => 'uppercase',
				),
				'secondary_font'     => array(
					'font-family' => 'Pinyon Script',
					'variant'     => '400',
				),
			) ),
		),
		'32' => array(
			'label'    => esc_html__( '30 - Business 2', 'brook' ),
			'settings' => array_merge( Brook_Customize::get_preset_settings( array(
				'primary_color' => '#9F3939',
			) ), array(
				'typography_body'                  => array(
					'font-family'    => 'CerebriSans',
					'variant'        => '400',
					'line-height'    => '1.75',
					'letter-spacing' => '0em',
				),
				'body_font_size'                   => 16,
				'body_color'                       => '#888',
				'typography_heading'               => array(
					'font-family'    => 'CerebriSans',
					'variant'        => '700',
					'line-height'    => '1.23',
					'letter-spacing' => '0em',
				),
				'button_typography'                => array(
					'font-family'    => 'CerebriSans',
					'variant'        => '500',
					'letter-spacing' => '1px',
					'font-size'      => '13px',
					'text-transform' => 'uppercase',
				),
				'secondary_font'                   => array(
					'font-family' => 'Spectral',
					'variant'     => '600',
				),
				'navigation_minimal_01_menu_title' => esc_html__( 'Menu', 'brook' ),
			) ),
		),
		'33' => array(
			'label'    => esc_html__( '33 - Wedding', 'brook' ),
			'settings' => array(
				'typography_body'        => array(
					'font-family'    => 'CerebriSans',
					'variant'        => '500',
					'line-height'    => '1.58',
					'letter-spacing' => '0em',
				),
				'body_font_size'         => 16,
				'typography_heading'     => array(
					'font-family'    => 'Playfair Display',
					'variant'        => '700',
					'line-height'    => '1.23',
					'letter-spacing' => '0em',
				),
				'primary_color'          => '#E2BA7A',
				'secondary_color'        => '#999',
				'link_color_hover'       => '#E2BA7A',
			),
		),
		'34' => array(
			'label'    => esc_html__( '34 - Coworking Space', 'brook' ),
			'settings' => array_merge( Brook_Customize::get_preset_settings( array(
				'primary_color' => '#6400FD',
			) ), array(
				'typography_body'    => array(
					'font-family'    => 'Poppins',
					'variant'        => '400',
					'line-height'    => '1.6',
					'letter-spacing' => '0em',
				),
				'body_font_size'     => 14,
				'typography_heading' => array(
					'font-family'    => 'Poppins',
					'variant'        => '700',
					'line-height'    => '1.7',
					'letter-spacing' => '0em',
				),
				'secondary_font'     => array(
					'font-family' => 'Poppins',
				),
			) ),
		),
	),
) );
