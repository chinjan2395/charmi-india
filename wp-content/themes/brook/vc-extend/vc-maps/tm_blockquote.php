<?php

class WPBakeryShortCode_TM_Blockquote extends WPBakeryShortCode {

	public function get_inline_css( $selector, $atts ) {
		Brook_VC::get_vc_spacing_css( $selector, $atts );
	}
}

$content_tab = esc_html__( 'Content', 'brook' );

vc_map( array(
	'name'                      => esc_html__( 'Blockquote', 'brook' ),
	'base'                      => 'tm_blockquote',
	'category'                  => BROOK_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-blockquote',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Style', 'brook' ),
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Style 01', 'brook' ) => '01',
				esc_html__( 'Style 02', 'brook' ) => '02',
			),
			'std'         => '01',
		),
		array(
			'heading'    => esc_html__( 'Text', 'brook' ),
			'type'       => 'textarea',
			'param_name' => 'text',
		),
		Brook_VC::extra_class_field(),
	), Brook_VC::get_vc_spacing_tab() ),
) );
