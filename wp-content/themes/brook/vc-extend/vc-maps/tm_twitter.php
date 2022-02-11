<?php

class WPBakeryShortCode_TM_Twitter extends WPBakeryShortCode {

	public function get_inline_css( $selector, $atts ) {
		global $brook_shortcode_lg_css;

		$icon_tmp = Brook_Helper::get_shortcode_css_color_inherit( 'color', $atts['icon_color'], $atts['custom_icon_color'] );
		$text_tmp = Brook_Helper::get_shortcode_css_color_inherit( 'color', $atts['text_color'], $atts['custom_text_color'] );

		if ( $icon_tmp !== '' ) {
			$brook_shortcode_lg_css .= "$selector .tweet:before{ $icon_tmp }";
		}

		if ( $text_tmp !== '' ) {
			$brook_shortcode_lg_css .= "$selector .tweet{ $text_tmp }";
		}

		Brook_VC::get_vc_spacing_css( $selector, $atts );
	}
}

$slider_tab  = esc_html__( 'Slider Settings', 'brook' );
$styling_tab = esc_html__( 'Styling', 'brook' );

vc_map( array(
	'name'                      => esc_html__( 'Twitter', 'brook' ),
	'base'                      => 'tm_twitter',
	'category'                  => BROOK_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-twitter',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'heading'     => esc_html__( 'Widget title', 'brook' ),
			'description' => esc_html__( 'What text use as a widget title.', 'brook' ),
			'type'        => 'textfield',
			'param_name'  => 'widget_title',
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Style', 'brook' ),
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'List', 'brook' )         => 'list',
				esc_html__( 'Slider', 'brook' )       => 'slider',
				esc_html__( 'Slider Quote', 'brook' ) => 'slider-quote',
			),
			'std'         => 'slider-quote',
		),
		array(
			'heading'    => esc_html__( 'Consumer Key', 'brook' ),
			'type'       => 'textfield',
			'param_name' => 'consumer_key',
		),
		array(
			'heading'    => esc_html__( 'Consumer Secret', 'brook' ),
			'type'       => 'textfield',
			'param_name' => 'consumer_secret',
		),
		array(
			'heading'    => esc_html__( 'Access Token', 'brook' ),
			'type'       => 'textfield',
			'param_name' => 'access_token',
		),
		array(
			'heading'    => esc_html__( 'Access Token Secret', 'brook' ),
			'type'       => 'textfield',
			'param_name' => 'access_token_secret',
		),
		array(
			'heading'    => esc_html__( 'Twitter Username', 'brook' ),
			'type'       => 'textfield',
			'param_name' => 'username',
		),
		array(
			'heading'    => esc_html__( 'Number of tweets', 'brook' ),
			'type'       => 'number',
			'param_name' => 'number_items',
		),
		array(
			'heading'    => esc_html__( 'Heading', 'brook' ),
			'type'       => 'textfield',
			'param_name' => 'heading',
			'std'        => esc_html__( 'From Twitter', 'brook' ),
		),
		array(
			'heading'    => esc_html__( 'Show date.', 'brook' ),
			'type'       => 'checkbox',
			'param_name' => 'show_date',
			'value'      => array(
				esc_html__( 'Yes', 'brook' ) => '1',
			),
		),
		Brook_VC::extra_class_field(),
		array(
			'group'       => $slider_tab,
			'heading'     => esc_html__( 'Speed', 'brook' ),
			'description' => esc_html__( 'Duration of transition between slides (in ms). For e.g: 1000. Leave blank to use default.', 'brook' ),
			'type'        => 'number',
			'suffix'      => 'ms',
			'param_name'  => 'carousel_speed',
			'dependency'  => array(
				'element' => 'style',
				'value'   => array(
					'slider',
					'slider-quote',
				),
			),
		),
		array(
			'group'       => $slider_tab,
			'heading'     => esc_html__( 'Auto Play', 'brook' ),
			'description' => esc_html__( 'Delay between transitions (in ms). For e.g: 3000. Leave blank to disabled.', 'brook' ),
			'type'        => 'number',
			'suffix'      => 'ms',
			'param_name'  => 'carousel_auto_play',
			'dependency'  => array(
				'element' => 'style',
				'value'   => array(
					'slider',
					'slider-quote',
				),
			),
		),
		array(
			'group'      => $slider_tab,
			'heading'    => esc_html__( 'Navigation', 'brook' ),
			'type'       => 'dropdown',
			'param_name' => 'carousel_nav',
			'value'      => Brook_VC::get_slider_navs(),
			'std'        => '',
			'dependency' => array(
				'element' => 'style',
				'value'   => array(
					'slider',
					'slider-quote',
				),
			),
		),
		Brook_VC::extra_id_field( array(
			'group'      => $slider_tab,
			'heading'    => esc_html__( 'Slider Button ID', 'brook' ),
			'param_name' => 'slider_button_id',
			'dependency' => array(
				'element' => 'carousel_nav',
				'value'   => array(
					'custom',
				),
			),
		) ),
		array(
			'group'      => $slider_tab,
			'heading'    => esc_html__( 'Pagination', 'brook' ),
			'type'       => 'dropdown',
			'param_name' => 'carousel_pagination',
			'value'      => Brook_VC::get_slider_dots(),
			'std'        => '',
			'dependency' => array(
				'element' => 'style',
				'value'   => array(
					'slider',
					'slider-quote',
				),
			),
		),
		array(
			'group'            => $styling_tab,
			'heading'          => esc_html__( 'Icon Color', 'brook' ),
			'type'             => 'dropdown',
			'param_name'       => 'icon_color',
			'value'            => array(
				esc_html__( 'Default Color', 'brook' )   => '',
				esc_html__( 'Primary Color', 'brook' )   => 'primary',
				esc_html__( 'Secondary Color', 'brook' ) => 'secondary',
				esc_html__( 'Custom Color', 'brook' )    => 'custom',
			),
			'std'              => '',
			'edit_field_class' => 'vc_col-sm-6 col-break',
		),
		array(
			'group'            => $styling_tab,
			'heading'          => esc_html__( 'Custom Icon Color', 'brook' ),
			'type'             => 'colorpicker',
			'param_name'       => 'custom_icon_color',
			'dependency'       => array(
				'element' => 'icon_color',
				'value'   => 'custom',
			),
			'std'              => '#999',
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'group'            => $styling_tab,
			'heading'          => esc_html__( 'Text Color', 'brook' ),
			'type'             => 'dropdown',
			'param_name'       => 'text_color',
			'value'            => array(
				esc_html__( 'Default Color', 'brook' )   => '',
				esc_html__( 'Primary Color', 'brook' )   => 'primary',
				esc_html__( 'Secondary Color', 'brook' ) => 'secondary',
				esc_html__( 'Custom Color', 'brook' )    => 'custom',
			),
			'std'              => '',
			'edit_field_class' => 'vc_col-sm-6 col-break',
		),
		array(
			'group'            => $styling_tab,
			'heading'          => esc_html__( 'Custom Text Color', 'brook' ),
			'type'             => 'colorpicker',
			'param_name'       => 'custom_text_color',
			'dependency'       => array(
				'element' => 'text_color',
				'value'   => array( 'custom' ),
			),
			'std'              => '#999',
			'edit_field_class' => 'vc_col-sm-6',
		),
	), Brook_VC::get_vc_spacing_tab() ),
) );
