<?php

class WPBakeryShortCode_TM_Pricing_Rotate_Box extends WPBakeryShortCode {

	public function get_inline_css( $selector, $atts ) {
		global $brook_shortcode_lg_css;
		$tmp = '';

		if ( isset( $atts['image'] ) && $atts['image'] !== '' ) {
			$image_url = Brook_Image::get_attachment_url_by_id( array(
				'id'   => $atts['image'],
				'size' => '480x480',
			) );

			$tmp .= "background-image: url( {$image_url} );";
		}

		if ( $tmp !== '' ) {
			$brook_shortcode_lg_css .= "$selector .front { $tmp }";
		}

		Brook_VC::get_vc_spacing_css( $selector, $atts );
	}
}

vc_map( array(
	'name'                      => esc_html__( 'Pricing Rotate Box', 'brook' ),
	'base'                      => 'tm_pricing_rotate_box',
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
			),
			'std'         => '01',
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
			'type'       => 'vc_link',
			'heading'    => esc_html__( 'Button', 'brook' ),
			'param_name' => 'button',
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
					'heading'     => esc_html__( 'Text', 'brook' ),
					'type'        => 'textfield',
					'param_name'  => 'text',
					'admin_label' => true,
				),
			),
		),
	), Brook_VC::get_vc_spacing_tab() ),
) );
