<?php

class WPBakeryShortCode_TM_Gradation extends WPBakeryShortCode {

	public function get_inline_css( $selector, $atts ) {
		global $brook_shortcode_lg_css_array;

		$items = (array) vc_param_group_parse_atts( $atts['items'] );

		if ( count( $items ) >= 1 ) {
			$count = 0;

			foreach ( $items as $item ) {
				$count++;

				$custom_dot_color = isset( $item['custom_dot_color'] ) ? $item['custom_dot_color'] : '';

				if ( ! isset( $item['dot_color'] ) || $item['dot_color'] === '' ) {
					continue;
				}

				$dot_color = Brook_Helper::get_shortcode_css_color_inherit( 'background-color', $item['dot_color'], $custom_dot_color );


				if ( $dot_color !== '' ) {
					$dot_selector = "$selector .item-$count .dot";

					$brook_shortcode_lg_css_array[ $dot_selector ][] = $dot_color;
				}
			}
		}

		Brook_VC::get_vc_spacing_css( $selector, $atts );
	}
}

vc_map( array(
	'name'                      => esc_html__( 'Gradation', 'brook' ),
	'base'                      => 'tm_gradation',
	'category'                  => BROOK_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-list',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
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
					'heading'    => esc_html__( 'Description', 'brook' ),
					'type'       => 'textarea',
					'param_name' => 'text',
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Dot color', 'brook' ),
					'param_name' => 'dot_color',
					'value'      => array(
						esc_html__( 'Default', 'brook' ) => '',
						esc_html__( 'Custom', 'brook' )  => 'custom',
					),
					'std'        => '',
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Custom dot color', 'brook' ),
					'param_name' => 'custom_dot_color',
					'dependency' => array(
						'element' => 'dot_color',
						'value'   => 'custom',
					),
				),
			),
		),

	), Brook_VC::get_vc_spacing_tab() ),
) );
