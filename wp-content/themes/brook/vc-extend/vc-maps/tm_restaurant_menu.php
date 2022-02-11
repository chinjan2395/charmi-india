<?php

class WPBakeryShortCode_TM_Restaurant_Menu extends WPBakeryShortCode {

	public function get_inline_css( $selector, $atts ) {
		Brook_VC::get_vc_spacing_css( $selector, $atts );
	}
}

vc_map( array(
	'name'                      => esc_html__( 'Restaurant Menu', 'brook' ),
	'base'                      => 'tm_restaurant_menu',
	'category'                  => BROOK_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-restaurant-menu',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'heading'     => esc_html__( 'Style', 'brook' ),
			'description' => esc_html__( 'Select style for menu.', 'brook' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'value'       => array(
				esc_html__( '01', 'brook' ) => '1',
				esc_html__( '02', 'brook' ) => '2',
			),
			'admin_label' => true,
		),
		Brook_VC::extra_class_field(),
		array(
			'group'      => esc_html__( 'Items', 'brook' ),
			'heading'    => esc_html__( 'Items', 'brook' ),
			'type'       => 'param_group',
			'param_name' => 'items',
			'params'     => array(
				array(
					'heading'     => esc_html__( 'Item Title', 'brook' ),
					'type'        => 'textfield',
					'param_name'  => 'title',
					'admin_label' => true,
				),
				array(
					'heading'    => esc_html__( 'Item Description', 'brook' ),
					'type'       => 'textarea',
					'param_name' => 'text',
				),
				array(
					'heading'    => esc_html__( 'Item Price', 'brook' ),
					'type'       => 'textfield',
					'param_name' => 'price',
				),
				array(
					'heading'     => esc_html__( 'Badge', 'brook' ),
					'type'        => 'dropdown',
					'param_name'  => 'badge',
					'value'       => array(
						esc_html__( 'None', 'brook' ) => '',
						esc_html__( 'New', 'brook' )  => 'new',
					),
					'admin_label' => true,
				),
			),
		),
	), Brook_VC::get_vc_spacing_tab() ),
) );
