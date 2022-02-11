<?php

class WPBakeryShortCode_TM_Circle_Progress_Chart extends WPBakeryShortCode {

	public function get_inline_css( $selector, $atts ) {
		global $brook_shortcode_lg_css;

		if ( isset( $atts['number_font_size'] ) ) {
			Brook_VC::get_responsive_css( array(
				'element' => "$selector .chart-number",
				'atts'    => array(
					'font-size' => array(
						'media_str' => $atts['number_font_size'],
						'unit'      => 'px',
					),
				),
			) );
		}

		$icon_tmp      = Brook_Helper::get_shortcode_css_color_inherit( 'color', $atts['icon_color'], $atts['custom_icon_color'] );
		$title_tmp     = Brook_Helper::get_shortcode_css_color_inherit( 'color', $atts['title_color'], $atts['custom_title_color'] );
		$sub_title_tmp = Brook_Helper::get_shortcode_css_color_inherit( 'color', $atts['sub_title_color'], $atts['custom_sub_title_color'] );

		if ( $icon_tmp !== '' ) {
			$brook_shortcode_lg_css .= "$selector .chart-icon { $icon_tmp }";
		}

		if ( $title_tmp !== '' ) {
			$brook_shortcode_lg_css .= "$selector .title { $title_tmp }";
		}

		if ( $sub_title_tmp !== '' ) {
			$brook_shortcode_lg_css .= "$selector .subtitle { $sub_title_tmp }";
		}
	}
}

$content_group = esc_html__( 'Content', 'brook' );
$style_group   = esc_html__( 'Styling', 'brook' );

vc_map( array(
	'name'                      => esc_html__( 'Circle Progress Chart', 'brook' ),
	'base'                      => 'tm_circle_progress_chart',
	'category'                  => BROOK_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-pie-chart',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'heading'     => esc_html__( 'Style', 'brook' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Style 01', 'brook' ) => '01',
				esc_html__( 'Style 02', 'brook' ) => '02',
				esc_html__( 'Style 03', 'brook' ) => '03',
			),
			'std'         => '01',
		),
		array(
			'heading'     => esc_html__( 'Number', 'brook' ),
			'description' => esc_html__( 'Controls the number you would like to display in pie chart.', 'brook' ),
			'type'        => 'number',
			'param_name'  => 'number',
			'min'         => 1,
			'max'         => 100,
			'std'         => 75,
		),
		array(
			'heading'     => esc_html__( 'Circle Size', 'brook' ),
			'description' => esc_html__( 'Controls the size of the pie chart circle. Default: 220', 'brook' ),
			'type'        => 'number',
			'param_name'  => 'size',
			'suffix'      => 'px',
			'std'         => 220,
		),
		array(
			'heading'     => esc_html__( 'Measuring unit', 'brook' ),
			'description' => esc_html__( 'Controls the unit of chart.', 'brook' ),
			'type'        => 'textfield',
			'param_name'  => 'unit',
			'std'         => '%',
		),
		Brook_VC::extra_class_field(),
		array(
			'group'      => $content_group,
			'heading'    => esc_html__( 'Title', 'brook' ),
			'type'       => 'textfield',
			'param_name' => 'title',
		),
		array(
			'group'      => $content_group,
			'heading'    => esc_html__( 'Subtitle', 'brook' ),
			'type'       => 'textfield',
			'param_name' => 'subtitle',
		),
	), Brook_VC::icon_libraries( array( 'allow_none' => true, ) ), array(
		array(
			'group'      => $style_group,
			'heading'    => esc_html__( 'Line Cap', 'brook' ),
			'type'       => 'dropdown',
			'param_name' => 'line_cap',
			'value'      => array(
				esc_html__( 'Butt', 'brook' )   => 'butt',
				esc_html__( 'Round', 'brook' )  => 'round',
				esc_html__( 'Square', 'brook' ) => 'square',
			),
			'std'        => 'square',
		),
		array(
			'group'       => $style_group,
			'heading'     => esc_html__( 'Line Width', 'brook' ),
			'description' => esc_html__( 'Controls the line width of chart.', 'brook' ),
			'type'        => 'number',
			'param_name'  => 'line_width',
			'suffix'      => 'px',
			'min'         => 1,
			'max'         => 50,
			'std'         => 6,
		),
		array(
			'group'            => $style_group,
			'heading'          => esc_html__( 'Bar Color', 'brook' ),
			'type'             => 'dropdown',
			'param_name'       => 'bar_color',
			'value'            => array(
				esc_html__( 'Gradient Color', 'brook' )  => 'gradient',
				esc_html__( 'Primary Color', 'brook' )   => 'primary',
				esc_html__( 'Secondary Color', 'brook' ) => 'secondary',
				esc_html__( 'Custom Color', 'brook' )    => 'custom',
			),
			'std'              => 'primary',
			'edit_field_class' => 'vc_col-sm-6 col-break',
		),
		array(
			'group'            => $style_group,
			'heading'          => esc_html__( 'Custom Bar Color', 'brook' ),
			'type'             => 'colorpicker',
			'param_name'       => 'custom_bar_color',
			'dependency'       => array( 'element' => 'bar_color', 'value' => array( 'custom' ) ),
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'group'            => $style_group,
			'heading'          => esc_html__( 'Track Color', 'brook' ),
			'type'             => 'dropdown',
			'param_name'       => 'track_color',
			'value'            => array(
				esc_html__( 'Default Color', 'brook' )   => '',
				esc_html__( 'Primary Color', 'brook' )   => 'primary',
				esc_html__( 'Secondary Color', 'brook' ) => 'secondary',
				esc_html__( 'Custom Color', 'brook' )    => 'custom',
			),
			'std'              => '',
			'edit_field_class' => 'vc_col-sm-6 col-break',
		),
		array(
			'group'            => $style_group,
			'heading'          => esc_html__( 'Custom Track Color', 'brook' ),
			'type'             => 'colorpicker',
			'param_name'       => 'custom_track_color',
			'dependency'       => array( 'element' => 'track_color', 'value' => array( 'custom' ) ),
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'group'            => $style_group,
			'heading'          => esc_html__( 'Icon Color', 'brook' ),
			'type'             => 'dropdown',
			'param_name'       => 'icon_color',
			'value'            => array(
				esc_html__( 'Default Color', 'brook' )   => '',
				esc_html__( 'Primary Color', 'brook' )   => 'primary',
				esc_html__( 'Secondary Color', 'brook' ) => 'secondary',
				esc_html__( 'Custom Color', 'brook' )    => 'custom',
			),
			'std'              => '',
			'edit_field_class' => 'vc_col-sm-6 col-break',
		),
		array(
			'group'            => $style_group,
			'heading'          => esc_html__( 'Custom Icon Color', 'brook' ),
			'type'             => 'colorpicker',
			'param_name'       => 'custom_icon_color',
			'dependency'       => array( 'element' => 'icon_color', 'value' => array( 'custom' ) ),
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'group'            => $style_group,
			'heading'          => esc_html__( 'Title Color', 'brook' ),
			'type'             => 'dropdown',
			'param_name'       => 'title_color',
			'value'            => array(
				esc_html__( 'Default Color', 'brook' )   => '',
				esc_html__( 'Primary Color', 'brook' )   => 'primary',
				esc_html__( 'Secondary Color', 'brook' ) => 'secondary',
				esc_html__( 'Custom Color', 'brook' )    => 'custom',
			),
			'std'              => '',
			'edit_field_class' => 'vc_col-sm-6 col-break',
		),
		array(
			'group'            => $style_group,
			'heading'          => esc_html__( 'Custom Title Color', 'brook' ),
			'type'             => 'colorpicker',
			'param_name'       => 'custom_title_color',
			'dependency'       => array( 'element' => 'title_color', 'value' => array( 'custom' ) ),
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'group'            => $style_group,
			'heading'          => esc_html__( 'Sub Title Color', 'brook' ),
			'type'             => 'dropdown',
			'param_name'       => 'sub_title_color',
			'value'            => array(
				esc_html__( 'Default Color', 'brook' )   => '',
				esc_html__( 'Primary Color', 'brook' )   => 'primary',
				esc_html__( 'Secondary Color', 'brook' ) => 'secondary',
				esc_html__( 'Custom Color', 'brook' )    => 'custom',
			),
			'std'              => '',
			'edit_field_class' => 'vc_col-sm-6 col-break',
		),
		array(
			'group'            => $style_group,
			'heading'          => esc_html__( 'Custom Sub Title Color', 'brook' ),
			'type'             => 'colorpicker',
			'param_name'       => 'custom_sub_title_color',
			'dependency'       => array( 'element' => 'sub_title_color', 'value' => array( 'custom' ) ),
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'group'       => $style_group,
			'heading'     => esc_html__( 'Number Font Size', 'brook' ),
			'type'        => 'number_responsive',
			'param_name'  => 'number_font_size',
			'min'         => 8,
			'suffix'      => 'px',
			'media_query' => array(
				'lg' => '',
				'md' => '',
				'sm' => '',
				'xs' => '',
			),
		),
	) ),
) );
