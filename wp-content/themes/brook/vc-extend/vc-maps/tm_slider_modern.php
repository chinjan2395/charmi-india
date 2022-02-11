<?php

class WPBakeryShortCode_TM_Slider_Modern extends WPBakeryShortCode {

	public function get_inline_css( $selector, $atts ) {
		Brook_VC::get_vc_spacing_css( $selector, $atts );
	}
}

$slides_tab  = esc_html__( 'Slides', 'brook' );
$styling_tab = esc_html__( 'Styling', 'brook' );

vc_map( array(
	'name'                      => esc_html__( 'Slider Modern', 'brook' ),
	'base'                      => 'tm_slider_modern',
	'category'                  => BROOK_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-carousel',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'heading'    => esc_html__( 'Style', 'brook' ),
			'type'       => 'dropdown',
			'param_name' => 'style',
			'value'      => array(
				esc_html__( '01', 'brook' ) => '01',
			),
			'std'        => '01',
		),
		array(
			'heading'    => esc_html__( 'Navigation', 'brook' ),
			'type'       => 'dropdown',
			'param_name' => 'nav',
			'value'      => Brook_VC::get_slider_navs(),
			'std'        => '',
		),
		Brook_VC::extra_id_field( array(
			'heading'    => esc_html__( 'Slider Button ID', 'brook' ),
			'param_name' => 'slider_button_id',
			'dependency' => array(
				'element' => 'nav',
				'value'   => array(
					'custom',
				),
			),
		) ),
		array(
			'heading'    => esc_html__( 'Pagination', 'brook' ),
			'type'       => 'dropdown',
			'param_name' => 'pagination',
			'value'      => Brook_VC::get_slider_dots(),
			'std'        => '',
		),
		array(
			'heading'     => esc_html__( 'Items Display', 'brook' ),
			'type'        => 'number_responsive',
			'param_name'  => 'items_display',
			'min'         => 1,
			'max'         => 10,
			'suffix'      => 'item (s)',
			'media_query' => array(
				'lg' => 4,
				'md' => 3,
				'sm' => 2,
				'xs' => 1,
			),
		),
		Brook_VC::extra_class_field(),
		array(
			'group'      => $slides_tab,
			'heading'    => esc_html__( 'Slides', 'brook' ),
			'type'       => 'param_group',
			'param_name' => 'items',
			'params'     => array(
				array(
					'heading'     => esc_html__( 'Background Image', 'brook' ),
					'type'        => 'attach_image',
					'param_name'  => 'background_image',
					'admin_label' => true,
				),
				array(
					'heading'     => esc_html__( 'Image', 'brook' ),
					'type'        => 'attach_image',
					'param_name'  => 'image',
					'admin_label' => true,
				),
				array(
					'heading'     => esc_html__( 'Title', 'brook' ),
					'type'        => 'textfield',
					'param_name'  => 'title',
					'admin_label' => true,
				),
				array(
					'heading'    => esc_html__( 'Text', 'brook' ),
					'type'       => 'textarea',
					'param_name' => 'text',
				),
				array(
					'heading'    => esc_html__( 'Button', 'brook' ),
					'type'       => 'vc_link',
					'param_name' => 'button',
					'value'      => esc_html__( 'Button', 'brook' ),
				),
			),
		),
	), Brook_VC::get_vc_spacing_tab() ),
) );
