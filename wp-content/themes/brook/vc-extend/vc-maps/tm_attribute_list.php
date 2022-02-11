<?php

class WPBakeryShortCode_TM_Attribute_List extends WPBakeryShortCode {

	public function get_inline_css( $selector, $atts ) {
		Brook_VC::get_vc_spacing_css( $selector, $atts );
	}
}

vc_map( array(
	'name'     => esc_html__( 'Attribute List', 'brook' ),
	'base'     => 'tm_attribute_list',
	'category' => BROOK_VC_SHORTCODE_CATEGORY,
	'icon'     => 'insight-i insight-i-portfoliogrid',
	'params'   => array_merge( array(
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
			'heading'     => esc_html__( 'Skin', 'brook' ),
			'type'        => 'dropdown',
			'param_name'  => 'skin',
			'value'       => array(
				esc_html__( 'Dark', 'brook' )  => 'dark',
				esc_html__( 'Light', 'brook' ) => 'light',
			),
			'admin_label' => true,
			'std'         => 'light',
		),
		Brook_VC::extra_class_field(),
		array(
			'group'      => esc_html__( 'Attributes', 'brook' ),
			'heading'    => esc_html__( 'Attributes', 'brook' ),
			'type'       => 'param_group',
			'param_name' => 'attributes',
			'params'     => array(
				array(
					'heading'     => esc_html__( 'Name', 'brook' ),
					'type'        => 'textfield',
					'param_name'  => 'name',
					'admin_label' => true,
				),
				array(
					'heading'    => esc_html__( 'Value', 'brook' ),
					'type'       => 'textarea',
					'param_name' => 'value',
				),
			),
		),
	), Brook_VC::get_vc_spacing_tab(), Brook_VC::get_custom_style_tab() ),
) );

