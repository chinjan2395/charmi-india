<?php

class WPBakeryShortCode_TM_Line_Chart extends WPBakeryShortCode {

	public function get_inline_css( $selector, $atts ) {
		Brook_VC::get_vc_spacing_css( $selector, $atts );
	}
}

$legend_tab = esc_html__( 'Tooltips and Legends', 'brook' );

vc_map( array(
	'name'                      => esc_html__( 'Line Chart', 'brook' ),
	'base'                      => 'tm_line_chart',
	'category'                  => BROOK_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-accordion',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'heading'     => esc_html__( 'X axis labels', 'brook' ),
			'description' => esc_html__( 'List of labels for X axis (separate labels with ";").', 'brook' ),
			'type'        => 'textfield',
			'param_name'  => 'labels',
			'std'         => 'Jul; Aug; Sep; Oct; Nov; Dec',
		),
		array(
			'heading'    => esc_html__( 'Datasets', 'brook' ),
			'type'       => 'param_group',
			'param_name' => 'datasets',
			'params'     => array(
				array(
					'heading'     => esc_html__( 'Title', 'brook' ),
					'description' => esc_html__( 'Dataset title used in tooltips and legends.', 'brook' ),
					'type'        => 'textfield',
					'param_name'  => 'title',
					'admin_label' => true,
				),
				array(
					'heading'     => esc_html__( 'Values', 'brook' ),
					'description' => esc_html__( 'text format for the tooltip (available placeholders: {d} dataset title, {x} X axis label, {y} Y axis value)', 'brook' ),
					'type'        => 'textfield',
					'param_name'  => 'values',
				),
				array(
					'heading'    => esc_html__( 'Dataset Color', 'brook' ),
					'type'       => 'colorpicker',
					'param_name' => 'color',
				),
				array(
					'heading'     => esc_html__( 'Area filling', 'brook' ),
					'description' => esc_html__( 'How to fill the area below the line', 'brook' ),
					'type'        => 'dropdown',
					'param_name'  => 'fill',
					'value'       => array(
						esc_html__( 'Custom', 'brook' ) => 'custom',
						esc_html__( 'None', 'brook' )   => 'none',
					),
					'std'         => 'none',
				),
				array(
					'heading'    => esc_html__( 'Fill Color', 'brook' ),
					'type'       => 'colorpicker',
					'param_name' => 'fill_color',
					'dependency' => array(
						'element' => 'fill',
						'value'   => array( 'custom' ),
					),
				),
				array(
					'type'       => 'dropdown',
					'param_name' => 'point_style',
					'heading'    => esc_html__( 'Point Style', 'brook' ),
					'value'      => array(
						esc_html__( 'none', 'brook' )              => 'none',
						esc_html__( 'circle', 'brook' )            => 'circle',
						esc_html__( 'triangle', 'brook' )          => 'triangle',
						esc_html__( 'rectangle', 'brook' )         => 'rect',
						esc_html__( 'rotated rectangle', 'brook' ) => 'rectRot',
						esc_html__( 'cross', 'brook' )             => 'cross',
						esc_html__( 'rotated cross', 'brook' )     => 'crossRot',
						esc_html__( 'star', 'brook' )              => 'star',
					),
					'std'        => 'circle',
				),
				array(
					'type'       => 'dropdown',
					'param_name' => 'line_type',
					'heading'    => esc_html__( 'Line type', 'brook' ),
					'value'      => array(
						esc_html__( 'normal', 'brook' )  => 'normal',
						esc_html__( 'stepped', 'brook' ) => 'step',
					),
					'std'        => 'normal',
				),
				array(
					'type'       => 'dropdown',
					'param_name' => 'line_style',
					'heading'    => esc_html__( 'Line style', 'brook' ),
					'value'      => array(
						esc_html__( 'solid', 'brook' )  => 'solid',
						esc_html__( 'dashed', 'brook' ) => 'dashed',
						esc_html__( 'dotted', 'brook' ) => 'dotted',
					),
					'std'        => 'solid',
				),
				array(
					'heading'     => esc_html__( 'Thickness', 'brook' ),
					'description' => esc_html__( 'line and points thickness', 'brook' ),
					'type'        => 'dropdown',
					'param_name'  => 'thickness',
					'value'       => array(
						esc_html__( 'thin', 'brook' )    => 'thin',
						esc_html__( 'normal', 'brook' )  => 'normal',
						esc_html__( 'thick', 'brook' )   => 'thick',
						esc_html__( 'thicker', 'brook' ) => 'thicker',
					),
					'std'         => 'normal',
				),
				array(
					'heading'     => esc_html__( 'Line tension', 'brook' ),
					'description' => esc_html__( 'tension of the line ( 100 for a straight line )', 'brook' ),
					'type'        => 'number',
					'param_name'  => 'line_tension',
					'std'         => 10,
					'min'         => 0,
					'max'         => 100,
					'step'        => 1,
				),
			),
			'value'      => rawurlencode( wp_json_encode( array(
				array(
					'title'        => esc_html__( 'Item 01', 'brook' ),
					'values'       => '15; 10; 22; 19; 23; 17',
					'color'        => 'rgba(105, 59, 255, 0.55)',
					'fill'         => 'none',
					'thickness'    => 'normal',
					'point_style'  => 'circle',
					'line_style'   => 'solid',
					'line_tension' => 10,

				),
				array(
					'title'        => esc_html__( 'Item 02', 'brook' ),
					'values'       => '34; 38; 35; 33; 37; 40',
					'color'        => 'rgba(0, 110, 253, 0.56)',
					'fill'         => 'none',
					'thickness'    => 'normal',
					'point_style'  => 'circle',
					'line_style'   => 'solid',
					'line_tension' => 10,
				),
			) ) ),
		),
		Brook_VC::extra_class_field(),
		array(
			'group'      => $legend_tab,
			'heading'    => esc_html__( 'Enable legends', 'brook' ),
			'type'       => 'checkbox',
			'param_name' => 'legend',
			'value'      => array(
				esc_html__( 'Yes', 'brook' ) => '1',
			),
			'std'        => '1',
		),
		array(
			'group'      => $legend_tab,
			'heading'    => esc_html__( 'Legends Style', 'brook' ),
			'type'       => 'dropdown',
			'param_name' => 'legend_style',
			'value'      => array(
				esc_html__( 'Normal', 'brook' )          => 'normal',
				esc_html__( 'Use Point Style', 'brook' ) => 'point',
			),
			'std'        => 'normal',
		),
		array(
			'group'      => $legend_tab,
			'heading'    => esc_html__( 'Legends Position', 'brook' ),
			'type'       => 'dropdown',
			'param_name' => 'legend_position',
			'value'      => array(
				esc_html__( 'Top', 'brook' )    => 'top',
				esc_html__( 'Right', 'brook' )  => 'right',
				esc_html__( 'Bottom', 'brook' ) => 'bottom',
				esc_html__( 'Left', 'brook' )   => 'left',
			),
			'std'        => 'bottom',
		),
		array(
			'group'       => $legend_tab,
			'heading'     => esc_html__( 'Click on legends', 'brook' ),
			'description' => esc_html__( 'Hide dataset on click on legend', 'brook' ),
			'type'        => 'checkbox',
			'param_name'  => 'legend_onclick',
			'value'       => array(
				esc_html__( 'Yes', 'brook' ) => '1',
			),
			'std'         => '1',
		),
		array(
			'group'      => esc_html__( 'Chart Options', 'brook' ),
			'heading'    => esc_html__( 'Aspect Ratio', 'brook' ),
			'type'       => 'dropdown',
			'param_name' => 'aspect_ratio',
			'value'      => array(
				'1:1'  => '1:1',
				'21:9' => '21:9',
				'16:9' => '16:9',
				'4:3'  => '4:3',
				'3:4'  => '3:4',
				'9:16' => '9:16',
				'9:21' => '9:21',
			),
			'std'        => '4:3',
		),
	), Brook_VC::get_vc_spacing_tab() ),
) );
