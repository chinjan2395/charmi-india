<?php

class WPBakeryShortCode_TM_Slider_Button extends WPBakeryShortCode {

	public function get_inline_css( $selector, $atts ) {
		global $brook_shortcode_lg_css;
		global $brook_shortcode_md_css;
		global $brook_shortcode_sm_css;
		global $brook_shortcode_xs_css;

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

		if ( $wrapper_tmp !== '' ) {
			$brook_shortcode_lg_css .= "$selector { $wrapper_tmp }";
		}

		Brook_VC::get_vc_spacing_css( $selector, $atts );
	}
}

vc_map( array(
	'name'                      => esc_html__( 'Slider Button', 'brook' ),
	'base'                      => 'tm_slider_button',
	'category'                  => BROOK_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-carousel',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'heading'     => esc_html__( 'Style', 'brook' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'value'       => array(
				esc_html__( '01', 'brook' ) => '01',
				esc_html__( '02', 'brook' ) => '02',
			),
			'admin_label' => true,
			'std'         => '01',
		),
		array(
			'heading'     => esc_html__( 'Skin', 'brook' ),
			'type'        => 'dropdown',
			'param_name'  => 'skin',
			'value'       => array(
				esc_html__( 'Dark', 'brook' )  => 'dark',
				esc_html__( 'Light', 'brook' ) => 'light',
			),
			'admin_label' => true,
			'std'         => 'dark',
		),
		Brook_VC::extra_id_field(),
	), Brook_VC::get_alignment_fields(), Brook_VC::get_vc_spacing_tab() ),
) );
