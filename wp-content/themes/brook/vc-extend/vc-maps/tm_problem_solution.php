<?php

class WPBakeryShortCode_TM_Problem_Solution extends WPBakeryShortCode {

	public function get_inline_css( $selector, $atts ) {
		Brook_VC::get_vc_spacing_css( $selector, $atts );
	}
}

$carousel_tab = esc_html__( 'Carousel Settings', 'brook' );

vc_map( array(
	'name'                      => esc_html__( 'Problem And Solution', 'brook' ),
	'base'                      => 'tm_problem_solution',
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
			),
			'admin_label' => true,
			'std'         => '01',
		),
		array(
			'heading'    => esc_html__( 'Image', 'brook' ),
			'type'       => 'attach_image',
			'param_name' => 'image',
		),
		Brook_VC::extra_class_field(),
		array(
			'group'      => esc_html__( 'Items', 'brook' ),
			'heading'    => esc_html__( 'Items', 'brook' ),
			'type'       => 'param_group',
			'param_name' => 'items',
			'params'     => array(
				array(
					'heading'     => esc_html__( 'Problem Name', 'brook' ),
					'type'        => 'textfield',
					'param_name'  => 'problem_name',
					'admin_label' => true,
				),
				array(
					'heading'    => esc_html__( 'Problem Description', 'brook' ),
					'type'       => 'textarea',
					'param_name' => 'problem_desc',
				),
				array(
					'heading'    => esc_html__( 'Solution Name', 'brook' ),
					'type'       => 'textfield',
					'param_name' => 'solution_name',
				),
				array(
					'heading'    => esc_html__( 'Solution Description', 'brook' ),
					'type'       => 'textarea',
					'param_name' => 'solution_desc',
				),
			),
		),
		array(
			'group'       => $carousel_tab,
			'heading'     => esc_html__( 'Auto Play', 'brook' ),
			'description' => esc_html__( 'Delay between transitions (in ms). For e.g: 3000. Leave blank to disabled.', 'brook' ),
			'type'        => 'number',
			'suffix'      => 'ms',
			'param_name'  => 'carousel_auto_play',
		),
		array(
			'group'      => $carousel_tab,
			'heading'    => esc_html__( 'Loop', 'brook' ),
			'type'       => 'checkbox',
			'param_name' => 'carousel_loop',
			'value'      => array( esc_html__( 'Yes', 'brook' ) => '1' ),
			'std'        => '1',
		),
		array(
			'group'      => $carousel_tab,
			'heading'    => esc_html__( 'Navigation', 'brook' ),
			'type'       => 'dropdown',
			'param_name' => 'carousel_nav',
			'value'      => Brook_VC::get_slider_navs(),
			'std'        => '',
		),
		Brook_VC::extra_id_field( array(
			'group'      => $carousel_tab,
			'heading'    => esc_html__( 'Slider Button ID', 'brook' ),
			'param_name' => 'slider_button_id',
			'dependency' => array(
				'element' => 'carousel_nav',
				'value'   => array(
					'custom',
				),
			),
		) ),
		array(
			'group'      => $carousel_tab,
			'heading'    => esc_html__( 'Pagination', 'brook' ),
			'type'       => 'dropdown',
			'param_name' => 'carousel_pagination',
			'value'      => Brook_VC::get_slider_dots(),
			'std'        => '',
		),
	), Brook_VC::get_vc_spacing_tab() ),
) );
