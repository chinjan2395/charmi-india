<?php

class WPBakeryShortCode_TM_Pricing extends WPBakeryShortCode {

	public function get_inline_css( $selector, $atts ) {
		Brook_VC::get_vc_spacing_css( $selector, $atts );
	}
}

vc_map( array(
	'name'                      => esc_html__( 'Pricing Box', 'brook' ),
	'base'                      => 'tm_pricing',
	'category'                  => BROOK_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-pricing',
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
			),
			'std'         => '01',
		),
		array(
			'heading'     => esc_html__( 'Featured', 'brook' ),
			'description' => esc_html__( 'Checked the box if you want make this item featured', 'brook' ),
			'type'        => 'checkbox',
			'param_name'  => 'featured',
			'value'       => array( esc_html__( 'Yes', 'brook' ) => '1' ),
		),
		array(
			'heading'    => esc_html__( 'Image', 'brook' ),
			'type'       => 'attach_image',
			'param_name' => 'image',
		),
		array(
			'heading'     => esc_html__( 'Title', 'brook' ),
			'type'        => 'textfield',
			'admin_label' => true,
			'param_name'  => 'title',
		),
		array(
			'heading'     => esc_html__( 'Description', 'brook' ),
			'description' => esc_html__( 'Controls the text that display under price', 'brook' ),
			'type'        => 'textarea',
			'param_name'  => 'desc',
		),
		array(
			'heading'          => esc_html__( 'Currency', 'brook' ),
			'type'             => 'textfield',
			'param_name'       => 'currency',
			'value'            => '$',
			'edit_field_class' => 'vc_col-sm-4',
		),
		array(
			'heading'          => esc_html__( 'Price', 'brook' ),
			'type'             => 'textfield',
			'param_name'       => 'price',
			'edit_field_class' => 'vc_col-sm-4',
		),
		array(
			'heading'          => esc_html__( 'Period', 'brook' ),
			'type'             => 'textfield',
			'param_name'       => 'period',
			'value'            => 'per monthly',
			'edit_field_class' => 'vc_col-sm-4',
		),
		array(
			'heading'     => esc_html__( 'Button Type', 'brook' ),
			'type'        => 'dropdown',
			'param_name'  => 'button_type',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Custom', 'brook' )              => 'custom',
				esc_html__( 'Product Add To Cart', 'brook' ) => 'product',
			),
			'std'         => 'custom',
		),
		array(
			'heading'          => esc_html__( 'Product ID', 'brook' ),
			'description' => esc_html__( 'Input product id to connect to this pricing', 'brook' ),
			'type'             => 'textfield',
			'param_name'       => 'product',
			'dependency' => array(
				'element' => 'button_type',
				'value'   => 'product',
			),
		),
		array(
			'type'       => 'vc_link',
			'heading'    => esc_html__( 'Button', 'brook' ),
			'param_name' => 'button',
			'dependency' => array(
				'element' => 'button_type',
				'value'   => 'custom',
			),
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
					'heading'    => esc_html__( 'Icon', 'brook' ),
					'type'       => 'iconpicker',
					'param_name' => 'icon',
					'settings'   => array(
						'emptyIcon'    => true,
						'type'         => 'fontawesome5',
						'iconsPerPage' => 300,
					),
					'value'      => '',
				),
				array(
					'heading'     => esc_html__( 'Text', 'brook' ),
					'type'        => 'textfield',
					'param_name'  => 'text',
					'admin_label' => true,
				),
				array(
					'heading'     => esc_html__( 'Available Feature', 'brook' ),
					'description' => esc_html__( 'Checked the box if you want make this item featured', 'brook' ),
					'type'        => 'checkbox',
					'param_name'  => 'available',
					'value'       => array( esc_html__( 'Yes', 'brook' ) => '1' ),
					'std'         => '1',
				),
			),
		),
	), Brook_VC::icon_libraries( array(
		'allow_none' => true,
	) ), Brook_VC::get_vc_spacing_tab() ),
) );
