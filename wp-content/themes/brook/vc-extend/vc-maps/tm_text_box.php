<?php

class WPBakeryShortCode_TM_Text_Box extends WPBakeryShortCode {

	public function get_inline_css( $selector, $atts ) {
		Brook_VC::get_vc_spacing_css( $selector, $atts );
	}
}

vc_map( array(
	'name'                      => esc_html__( 'Text Box', 'brook' ),
	'base'                      => 'tm_text_box',
	'category'                  => BROOK_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-dropcap',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'heading'     => esc_html__( 'Style', 'brook' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Style 01', 'brook' ) => '01',
				esc_html__( 'Style 02', 'brook' ) => '02',
				esc_html__( 'Style 03', 'brook' ) => '03',
				esc_html__( 'Style 04', 'brook' ) => '04',
			),
			'std'         => '01',
		),
		array(
			'heading'    => esc_html__( 'Heading', 'brook' ),
			'type'       => 'textfield',
			'param_name' => 'heading',
		),
		array(
			'heading'    => esc_html__( 'Text', 'brook' ),
			'type'       => 'textarea',
			'param_name' => 'text',
		),
		Brook_VC::extra_class_field(),
	), Brook_VC::get_vc_spacing_tab() ),
) );
