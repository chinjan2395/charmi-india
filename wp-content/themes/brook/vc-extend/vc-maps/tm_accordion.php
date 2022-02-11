<?php

class WPBakeryShortCode_TM_Accordion extends WPBakeryShortCode {

	public function get_inline_css( $selector, $atts ) {
		Brook_VC::get_vc_spacing_css( $selector, $atts );
	}
}

vc_map( array(
	'name'                      => esc_html__( 'Accordion', 'brook' ),
	'base'                      => 'tm_accordion',
	'category'                  => BROOK_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-accordion',
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
			),
			'std'         => '01',
		),
		array(
			'heading'    => esc_html__( 'Multi Open', 'brook' ),
			'type'       => 'checkbox',
			'param_name' => 'multi_open',
			'value'      => array( esc_html__( 'Yes', 'brook' ) => '1' ),
		),
		array(
			'heading'    => esc_html__( 'Open First Item', 'brook' ),
			'type'       => 'checkbox',
			'param_name' => 'open_first_item',
			'value'      => array( esc_html__( 'Yes', 'brook' ) => '1' ),
		),
		Brook_VC::extra_class_field(),
		array(
			'group'      => esc_html__( 'Items', 'brook' ),
			'heading'    => esc_html__( 'Items', 'brook' ),
			'type'       => 'param_group',
			'param_name' => 'items',
			'params'     => array(
				array(
					'heading'     => esc_html__( 'Title', 'brook' ),
					'type'        => 'textfield',
					'param_name'  => 'title',
					'admin_label' => true,
				),
				array(
					'heading'    => esc_html__( 'Content', 'brook' ),
					'type'       => 'textarea',
					'param_name' => 'content',
				),
			),
		),
	), Brook_VC::get_vc_spacing_tab() ),
) );
