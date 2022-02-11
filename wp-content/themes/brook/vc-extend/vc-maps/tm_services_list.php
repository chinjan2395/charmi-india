<?php

class WPBakeryShortCode_TM_Services_List extends WPBakeryShortCode {

	public function get_inline_css( $selector, $atts ) {
		Brook_VC::get_vc_spacing_css( $selector, $atts );
	}
}

$styling_tab = esc_html__( 'Styling', 'brook' );

vc_map( array(
	'name'                      => esc_html__( 'Services List', 'brook' ),
	'base'                      => 'tm_services_list',
	'category'                  => BROOK_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-list',
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
		Brook_VC::extra_class_field(),
		array(
			'group'      => esc_html__( 'Items', 'brook' ),
			'heading'    => esc_html__( 'Items', 'brook' ),
			'type'       => 'param_group',
			'param_name' => 'items',
			'params'     => array(
				array(
					'heading'    => esc_html__( 'Image', 'brook' ),
					'type'       => 'attach_image',
					'param_name' => 'image',
				),
				array(
					'heading'     => esc_html__( 'Title', 'brook' ),
					'type'        => 'textfield',
					'param_name'  => 'title',
					'admin_label' => true,
				),
				array(
					'heading'    => esc_html__( 'Description', 'brook' ),
					'type'       => 'textarea',
					'param_name' => 'text',
				),
			),
		),
	), Brook_VC::get_vc_spacing_tab() ),
) );
