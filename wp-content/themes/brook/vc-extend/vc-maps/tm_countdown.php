<?php

class WPBakeryShortCode_TM_CountDown extends WPBakeryShortCode {

	public function get_inline_css( $selector, $atts ) {
		global $brook_shortcode_lg_css;
		global $brook_shortcode_md_css;
		global $brook_shortcode_sm_css;
		global $brook_shortcode_xs_css;
		$skin = '';
		extract( $atts );

		if ( $skin === 'custom' ) {
			$number_tmp = Brook_Helper::get_shortcode_css_color_inherit( 'color', $atts['number_color'], $atts['custom_number_color'] );
			$text_tmp   = Brook_Helper::get_shortcode_css_color_inherit( 'color', $atts['text_color'], $atts['custom_text_color'] );

			if ( $number_tmp !== '' ) {
				$brook_shortcode_lg_css .= "$selector .number { $number_tmp }";
			}

			if ( $text_tmp !== '' ) {
				$brook_shortcode_lg_css .= "$selector .text { $text_tmp }";
			}
		}

		if ( $atts['align'] !== '' ) {
			$brook_shortcode_lg_css .= "$selector { text-align: {$atts['align']}; }";
		}

		if ( $atts['md_align'] !== '' ) {
			$brook_shortcode_md_css .= "$selector { text-align: {$atts['md_align']} }";
		}

		if ( $atts['sm_align'] !== '' ) {
			$brook_shortcode_sm_css .= "$selector { text-align: {$atts['sm_align']} }";
		}

		if ( $atts['xs_align'] !== '' ) {
			$brook_shortcode_xs_css .= "$selector { text-align: {$atts['xs_align']} }";
		}

		Brook_VC::get_vc_spacing_css( $selector, $atts );
	}
}

vc_map( array(
	'name'                      => esc_html__( 'Countdown', 'brook' ),
	'base'                      => 'tm_countdown',
	'category'                  => BROOK_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-countdownclock',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'heading'     => esc_html__( 'Style', 'brook' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( '01', 'brook' ) => '01',
				esc_html__( '02', 'brook' ) => '02',
				esc_html__( '03', 'brook' ) => '03',
				esc_html__( '04', 'brook' ) => '04',
				esc_html__( '05', 'brook' ) => '05',
				esc_html__( '06', 'brook' ) => '06',
			),
			'std'         => '01',
		),
		array(
			'heading'     => esc_html__( 'Skin', 'brook' ),
			'type'        => 'dropdown',
			'param_name'  => 'skin',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Custom', 'brook' ) => 'custom',
				esc_html__( 'Dark', 'brook' )   => 'dark',
				esc_html__( 'Light', 'brook' )  => 'light',
			),
			'std'         => 'dark',
		),
		array(
			'type'             => 'dropdown',
			'heading'          => esc_html__( 'Number Color', 'brook' ),
			'param_name'       => 'number_color',
			'value'            => array(
				esc_html__( 'Default Color', 'brook' )   => '',
				esc_html__( 'Primary Color', 'brook' )   => 'primary',
				esc_html__( 'Secondary Color', 'brook' ) => 'secondary',
				esc_html__( 'Custom Color', 'brook' )    => 'custom',
			),
			'std'              => 'secondary',
			'edit_field_class' => 'vc_col-sm-6 col-break',
			'dependency'       => array(
				'element' => 'skin',
				'value'   => array( 'custom' ),
			),
		),
		array(
			'type'             => 'colorpicker',
			'heading'          => esc_html__( 'Custom Number Color', 'brook' ),
			'param_name'       => 'custom_number_color',
			'edit_field_class' => 'vc_col-sm-6',
			'dependency'       => array(
				'element' => 'number_color',
				'value'   => array( 'custom' ),
			),
		),
		array(
			'type'             => 'dropdown',
			'heading'          => esc_html__( 'Text Color', 'brook' ),
			'param_name'       => 'text_color',
			'value'            => array(
				esc_html__( 'Default Color', 'brook' )   => '',
				esc_html__( 'Primary Color', 'brook' )   => 'primary',
				esc_html__( 'Secondary Color', 'brook' ) => 'secondary',
				esc_html__( 'Custom Color', 'brook' )    => 'custom',
			),
			'std'              => 'custom',
			'edit_field_class' => 'vc_col-sm-6 col-break',
			'dependency'       => array(
				'element' => 'skin',
				'value'   => array( 'custom' ),
			),
		),
		array(
			'type'             => 'colorpicker',
			'heading'          => esc_html__( 'Custom Text Color', 'brook' ),
			'param_name'       => 'custom_text_color',
			'edit_field_class' => 'vc_col-sm-6',
			'dependency'       => array(
				'element' => 'text_color',
				'value'   => array( 'custom' ),
			),
			'std'              => '#ababab',
		),
	), Brook_VC::get_alignment_fields(),
		array(
			array(
				'heading'     => esc_html__( 'Date Time', 'brook' ),
				'description' => esc_html__( 'Date and time format (yyyy/mm/dd hh:mm).', 'brook' ),
				'type'        => 'datetimepicker',
				'param_name'  => 'datetime',
				'value'       => '',
				'admin_label' => true,
				'settings'    => array(
					'minDate' => 0,
				),
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( '"Days" text', 'brook' ),
				'description' => esc_html__( 'Leave blank to use default.', 'brook' ),
				'param_name'  => 'days',
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( '"Hours" text', 'brook' ),
				'description' => esc_html__( 'Leave blank to use default.', 'brook' ),
				'param_name'  => 'hours',
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( '"Minutes" text', 'brook' ),
				'description' => esc_html__( 'Leave blank to use default.', 'brook' ),
				'param_name'  => 'minutes',
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( '"Seconds" text', 'brook' ),
				'description' => esc_html__( 'Leave blank to use default.', 'brook' ),
				'param_name'  => 'seconds',
			),
			Brook_VC::extra_class_field(),
		),
		Brook_VC::get_vc_spacing_tab() ),
) );

