<?php

class WPBakeryShortCode_TM_Bar_Chart extends WPBakeryShortCode {

	public function get_inline_css( $selector, $atts ) {
		Brook_VC::get_vc_spacing_css( $selector, $atts );
	}
}

$legend_tab = esc_html__( 'Tooltips and Legends', 'brook' );

vc_map( array(
	'name'                      => esc_html__( 'Bar Chart', 'brook' ),
	'base'                      => 'tm_bar_chart',
	'category'                  => BROOK_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-processbar',
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
			'heading'    => esc_html__( 'Direction type', 'brook' ),
			'type'       => 'dropdown',
			'param_name' => 'type',
			'value'      => array(
				esc_html__( 'Vertical', 'brook' )   => 'bar',
				esc_html__( 'Horizontal', 'brook' ) => 'horizontalBar',
			),
			'std'        => 'bar',
		),
		array(
			'heading'     => esc_html__( 'Border Width', 'brook' ),
			'description' => esc_html__( 'Border width of the bars', 'brook' ),
			'type'        => 'number',
			'param_name'  => 'border_width',
			'std'         => 0,
			'min'         => 0,
			'step'        => 1,
			'suffix'      => 'px',
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
					'heading'     => esc_html__( 'Fill Color', 'brook' ),
					'description' => esc_html__( 'Leave blank to use color from dataset.', 'brook' ),
					'type'        => 'colorpicker',
					'param_name'  => 'fill_color',
				),
				array(
					'heading'     => esc_html__( 'Border Color', 'brook' ),
					'description' => esc_html__( 'Leave blank to use color from dataset.', 'brook' ),
					'type'        => 'colorpicker',
					'param_name'  => 'border_color',
				),
			),
			'value'      => rawurlencode( wp_json_encode( array(
				array(
					'title'  => esc_html__( 'Item 01', 'brook' ),
					'values' => '15; 10; 22; 19; 23; 17',
					'color'  => 'rgba(105, 59, 255, 1)',

				),
				array(
					'title'  => esc_html__( 'Item 02', 'brook' ),
					'values' => '34; 38; 35; 33; 37; 40',
					'color'  => 'rgba(0, 110, 253, 1)',
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
