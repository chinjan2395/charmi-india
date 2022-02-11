<?php

class WPBakeryShortCode_TM_Pricing_Table extends WPBakeryShortCode {

	public function get_inline_css( $selector, $atts ) {
		Brook_VC::get_vc_spacing_css( $selector, $atts );
	}
}

vc_map( array(
	'name'                      => esc_html__( 'Pricing Table', 'brook' ),
	'base'                      => 'tm_pricing_table',
	'category'                  => BROOK_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-pricing',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'heading'     => esc_html__( 'Heading', 'brook' ),
			'type'        => 'textarea',
			'admin_label' => true,
			'param_name'  => 'heading',
		),
		array(
			'heading'     => esc_html__( 'Feature Labels', 'brook' ),
			'description' => esc_html__( 'Input each feature label per line.', 'brook' ),
			'type'        => 'textarea',
			'param_name'  => 'features_labels',
			'admin_label' => true,
		),
		array(
			'heading'          => esc_html__( 'Currency', 'brook' ),
			'type'             => 'textfield',
			'param_name'       => 'currency',
			'value'            => '$',
			'edit_field_class' => 'vc_col-sm-4',
		),
		array(
			'heading'          => esc_html__( 'Period', 'brook' ),
			'type'             => 'textfield',
			'param_name'       => 'period',
			'value'            => '/ monthly',
			'edit_field_class' => 'vc_col-sm-4',
		),
		Brook_VC::get_animation_field(),
		Brook_VC::extra_class_field(),
		array(
			'group'      => esc_html__( 'Items', 'brook' ),
			'heading'    => esc_html__( 'Items', 'brook' ),
			'type'       => 'param_group',
			'param_name' => 'items',
			'params'     => array(
				array(
					'heading'     => esc_html__( 'Featured', 'brook' ),
					'description' => esc_html__( 'Checked the box if you want make this item featured', 'brook' ),
					'type'        => 'checkbox',
					'param_name'  => 'featured',
					'value'       => array( esc_html__( 'Yes', 'brook' ) => '1' ),
				),
				array(
					'heading'     => esc_html__( 'Title', 'brook' ),
					'type'        => 'textfield',
					'param_name'  => 'title',
					'admin_label' => true,
				),
				array(
					'heading'          => esc_html__( 'Price', 'brook' ),
					'type'             => 'textfield',
					'param_name'       => 'price',
					'edit_field_class' => 'vc_col-sm-4',
				),
				array(
					'heading'     => esc_html__( 'Feature List', 'brook' ),
					'type'        => 'textarea',
					'param_name'  => 'features',
					'description' => esc_html__( 'Input each feature per line, use [check] for check icon.', 'brook' ),
				),
				array(
					'type'       => 'vc_link',
					'heading'    => esc_html__( 'Button', 'brook' ),
					'param_name' => 'button',
				),
			),
		),
	), Brook_VC::icon_libraries( array(
		'allow_none' => true,
	) ), Brook_VC::get_vc_spacing_tab() ),
) );
