<?php

class WPBakeryShortCode_TM_Separator extends WPBakeryShortCode {

	public function get_inline_css( $selector, $atts ) {
		global $brook_shortcode_lg_css;
		global $brook_shortcode_md_css;
		global $brook_shortcode_sm_css;
		global $brook_shortcode_xs_css;
		extract( $atts );

		$wrapper_tmp = '';

		if ( $atts['align'] !== '' ) {
			$wrapper_tmp .= "text-align: {$atts['align']};";
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

		switch ( $atts['style'] ) {
			case 'thin-line':
			case 'thick-line':
			case 'dash-line':
				$_color = Brook_Helper::get_shortcode_css_color_inherit( 'border-color', $atts['color'], $atts['custom_color'] );

				$brook_shortcode_lg_css .= "$selector { $_color }";
				break;
			case 'thin-short-line':
			case 'thick-short-line':
				$_color = Brook_Helper::get_shortcode_css_color_inherit( 'background-color', $atts['color'], $atts['custom_color'] );

				$brook_shortcode_lg_css .= "$selector .separator-wrap{ $_color }";
				break;
			case 'modern-dots':
			case 'modern-dots-02':
				$_color = Brook_Helper::get_shortcode_css_color_inherit( 'background-color', $atts['color'], $atts['custom_color'] );

				$brook_shortcode_lg_css .= "$selector .dot{ $_color }";
				break;
		}

		if ( $wrapper_tmp !== '' ) {
			$brook_shortcode_lg_css .= "$selector { $wrapper_tmp }";
		}

		Brook_VC::get_vc_spacing_css( $selector, $atts );
	}

}

vc_map( array(
	'name'     => esc_html__( 'Separator', 'brook' ),
	'base'     => 'tm_separator',
	'category' => BROOK_VC_SHORTCODE_CATEGORY,
	'icon'     => 'insight-i insight-i-call-to-action',
	'params'   => array_merge( array(
		array(
			'heading'     => esc_html__( 'Style', 'brook' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Modern Dots', 'brook' )      => 'modern-dots',
				esc_html__( 'Modern Dots 02', 'brook' )   => 'modern-dots-02',
				esc_html__( 'Thin Short Line', 'brook' )  => 'thin-short-line',
				esc_html__( 'Thick Short Line', 'brook' ) => 'thick-short-line',
				esc_html__( 'Thin Line', 'brook' )        => 'thin-line',
				esc_html__( 'Thick Line', 'brook' )       => 'thick-line',
				esc_html__( 'Dash Line', 'brook' )        => 'dash-line',
			),
			'std'         => 'thick-short-line',
		),
		array(
			'type'             => 'dropdown',
			'heading'          => esc_html__( 'Color', 'brook' ),
			'param_name'       => 'color',
			'value'            => array(
				esc_html__( 'Default', 'brook' )   => '',
				esc_html__( 'Primary', 'brook' )   => 'primary',
				esc_html__( 'Secondary', 'brook' ) => 'secondary',
				esc_html__( 'Custom', 'brook' )    => 'custom',
			),
			'std'              => '',
			'edit_field_class' => 'vc_col-sm-6 col-break',
		),
		array(
			'type'             => 'colorpicker',
			'heading'          => esc_html__( 'Custom color', 'brook' ),
			'param_name'       => 'custom_color',
			'dependency'       => array(
				'element' => 'color',
				'value'   => 'custom',
			),
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'heading'     => esc_html__( 'Smooth Scroll', 'brook' ),
			'description' => esc_html__( 'Input valid id to smooth scroll to a section on click. ( For e.g: #about-us-section )', 'brook' ),
			'type'        => 'textfield',
			'param_name'  => 'smooth_scroll',
		),
		Brook_VC::extra_class_field(),
	), Brook_VC::get_alignment_fields(), Brook_VC::get_vc_spacing_tab() ),
) );

