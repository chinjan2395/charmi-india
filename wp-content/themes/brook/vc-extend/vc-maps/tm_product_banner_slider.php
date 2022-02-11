<?php

class WPBakeryShortCode_TM_Product_Banner_Slider extends WPBakeryShortCode {

	public function get_inline_css( $selector, $atts ) {
		Brook_VC::get_vc_spacing_css( $selector, $atts );
	}
}

$slides_tab = esc_html__( 'Slides', 'brook' );

vc_map( array(
	'name'                      => esc_html__( 'Product Banner Slider', 'brook' ),
	'base'                      => 'tm_product_banner_slider',
	'category'                  => BROOK_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-carousel',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'heading'    => esc_html__( 'Image Size', 'brook' ),
			'type'       => 'dropdown',
			'param_name' => 'image_size',
			'value'      => array(
				esc_html__( '960x960', 'brook' ) => '960x960',
				esc_html__( 'Full', 'brook' )    => 'full',
			),
			'std'        => '960x960',
		),
		array(
			'heading'    => esc_html__( 'Auto Height', 'brook' ),
			'type'       => 'checkbox',
			'param_name' => 'auto_height',
			'value'      => array( esc_html__( 'Yes', 'brook' ) => '1' ),
			'std'        => '1',
		),
		array(
			'heading'    => esc_html__( 'Loop', 'brook' ),
			'type'       => 'checkbox',
			'param_name' => 'loop',
			'value'      => array( esc_html__( 'Yes', 'brook' ) => '1' ),
			'std'        => '1',
		),
		array(
			'heading'     => esc_html__( 'Auto Play', 'brook' ),
			'description' => esc_html__( 'Delay between transitions (in ms). For e.g: 3000. Leave blank to disabled.', 'brook' ),
			'type'        => 'number',
			'suffix'      => 'ms',
			'param_name'  => 'auto_play',
		),
		array(
			'heading'    => esc_html__( 'Equal Height', 'brook' ),
			'type'       => 'checkbox',
			'param_name' => 'equal_height',
			'value'      => array( esc_html__( 'Yes', 'brook' ) => '1' ),
		),
		array(
			'heading'    => esc_html__( 'Vertically Center', 'brook' ),
			'type'       => 'checkbox',
			'param_name' => 'v_center',
			'value'      => array( esc_html__( 'Yes', 'brook' ) => '1' ),
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
			'heading'    => esc_html__( 'Gutter', 'brook' ),
			'type'       => 'number',
			'param_name' => 'gutter',
			'std'        => 30,
			'min'        => 0,
			'max'        => 50,
			'step'       => 1,
			'suffix'     => 'px',
		),
		array(
			'heading'     => esc_html__( 'Items Display', 'brook' ),
			'type'        => 'number_responsive',
			'param_name'  => 'items_display',
			'min'         => 1,
			'max'         => 10,
			'suffix'      => 'item (s)',
			'media_query' => array(
				'lg' => 3,
				'md' => 3,
				'sm' => 2,
				'xs' => 1,
			),
		),
		array(
			'heading'    => esc_html__( 'Full-width Image', 'brook' ),
			'type'       => 'checkbox',
			'param_name' => 'fw_image',
			'value'      => array( esc_html__( 'Yes', 'brook' ) => '1' ),
		),
		Brook_VC::extra_class_field(),
		array(
			'group'      => $slides_tab,
			'heading'    => esc_html__( 'Slides', 'brook' ),
			'type'       => 'param_group',
			'param_name' => 'items',
			'params'     => array(
				array(
					'heading'     => esc_html__( 'Image', 'brook' ),
					'type'        => 'attach_image',
					'param_name'  => 'image',
					'admin_label' => true,
				),
				array(
					'heading'    => esc_html__( 'Sub Title', 'brook' ),
					'type'       => 'textfield',
					'param_name' => 'sub_title',
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
					'heading'    => esc_html__( 'Link', 'brook' ),
					'type'       => 'vc_link',
					'param_name' => 'link',
					'value'      => esc_html__( 'Link', 'brook' ),
				),
			),
		),
	), Brook_VC::get_vc_spacing_tab() ),
) );
