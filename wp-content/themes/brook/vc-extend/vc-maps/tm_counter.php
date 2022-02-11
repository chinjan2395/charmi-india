<?php

class WPBakeryShortCode_TM_Counter extends WPBakeryShortCode {

	public function get_inline_css( $selector, $atts ) {
		global $brook_shortcode_lg_css;
		$align = 'center';

		extract( $atts );

		$tmp = "text-align: {$align}";

		$number_tmp      = Brook_Helper::get_shortcode_css_color_inherit( 'color', $atts['number_color'], $atts['custom_number_color'] );
		$text_tmp        = Brook_Helper::get_shortcode_css_color_inherit( 'color', $atts['text_color'], $atts['custom_text_color'] );
		$description_tmp = Brook_Helper::get_shortcode_css_color_inherit( 'color', $atts['description_color'], $atts['custom_description_color'] );
		$icon_tmp        = Brook_Helper::get_shortcode_css_color_inherit( 'color', $atts['icon_color'], $atts['custom_icon_color'] );
		$background_tmp  = Brook_Helper::get_shortcode_css_color_inherit( 'background-color', $atts['background_color'], $atts['custom_background_color'] );

		if ( $number_tmp !== '' ) {
			$brook_shortcode_lg_css .= "$selector .number-wrap { $number_tmp }";
		}

		if ( $text_tmp !== '' ) {
			$brook_shortcode_lg_css .= "$selector .heading { $text_tmp }";
		}

		if ( $description_tmp !== '' ) {
			$brook_shortcode_lg_css .= "$selector .description { $text_tmp }";
		}

		if ( $icon_tmp !== '' ) {
			$brook_shortcode_lg_css .= "$selector .icon { $icon_tmp }";
		}

		if ( $background_tmp !== '' ) {
			$brook_shortcode_lg_css .= "$selector .counter-wrap { $background_tmp }";
		}

		$brook_shortcode_lg_css .= "$selector { $tmp }";

		Brook_VC::get_vc_spacing_css( $selector, $atts );
	}
}

$style_group = esc_html__( 'Styling', 'brook' );

vc_map( array(
	'name'                      => esc_html__( 'Counter', 'brook' ),
	'base'                      => 'tm_counter',
	'category'                  => BROOK_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-counter',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Style', 'brook' ),
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( '01', 'brook' ) => '01',
				esc_html__( '02', 'brook' ) => '02',
				esc_html__( '03', 'brook' ) => '03',
				esc_html__( '04', 'brook' ) => '04',
				esc_html__( '05', 'brook' ) => '05',
			),
			'std'         => '01',
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Counter Animation', 'brook' ),
			'param_name' => 'animation',
			'value'      => array(
				esc_html__( 'Counter Up', 'brook' ) => 'counter-up',
				esc_html__( 'Odometer', 'brook' )   => 'odometer',
			),
			'std'        => 'counter-up',
		),
		array(
			'heading'    => esc_html__( 'Text Align', 'brook' ),
			'type'       => 'dropdown',
			'param_name' => 'align',
			'value'      => array(
				esc_html__( 'Left', 'brook' )   => 'left',
				esc_html__( 'Center', 'brook' ) => 'center',
				esc_html__( 'Right', 'brook' )  => 'right',
			),
			'std'        => 'center',
		),
		array(
			'group'       => esc_html__( 'Data', 'brook' ),
			'heading'     => esc_html__( 'Number', 'brook' ),
			'type'        => 'number',
			'admin_label' => true,
			'param_name'  => 'number',
		),
		array(
			'group'       => esc_html__( 'Data', 'brook' ),
			'heading'     => esc_html__( 'Number Prefix', 'brook' ),
			'description' => esc_html__( 'Prefix your number with a symbol or text.', 'brook' ),
			'type'        => 'textfield',
			'admin_label' => true,
			'param_name'  => 'number_prefix',
		),
		array(
			'group'       => esc_html__( 'Data', 'brook' ),
			'heading'     => esc_html__( 'Number Suffix', 'brook' ),
			'description' => esc_html__( 'Suffix your number with a symbol or text.', 'brook' ),
			'type'        => 'textfield',
			'admin_label' => true,
			'param_name'  => 'number_suffix',
		),
		array(
			'group'       => esc_html__( 'Data', 'brook' ),
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Heading', 'brook' ),
			'admin_label' => true,
			'param_name'  => 'text',
		),
		array(
			'group'       => esc_html__( 'Data', 'brook' ),
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Description', 'brook' ),
			'admin_label' => true,
			'param_name'  => 'description',
		),
		Brook_VC::extra_class_field(),
		array(
			'group'            => $style_group,
			'type'             => 'dropdown',
			'heading'          => esc_html__( 'Number Color', 'brook' ),
			'param_name'       => 'number_color',
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
			'type'             => 'colorpicker',
			'heading'          => esc_html__( 'Custom Number Color', 'brook' ),
			'param_name'       => 'custom_number_color',
			'dependency'       => array(
				'element' => 'number_color',
				'value'   => array( 'custom' ),
			),
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'group'            => $style_group,
			'type'             => 'dropdown',
			'heading'          => esc_html__( 'Heading Color', 'brook' ),
			'param_name'       => 'text_color',
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
			'type'             => 'colorpicker',
			'heading'          => esc_html__( 'Custom Heading Color', 'brook' ),
			'param_name'       => 'custom_text_color',
			'dependency'       => array(
				'element' => 'text_color',
				'value'   => array( 'custom' ),
			),
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'group'            => $style_group,
			'type'             => 'dropdown',
			'heading'          => esc_html__( 'Description Color', 'brook' ),
			'param_name'       => 'description_color',
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
			'type'             => 'colorpicker',
			'heading'          => esc_html__( 'Custom Description Color', 'brook' ),
			'param_name'       => 'custom_description_color',
			'dependency'       => array(
				'element' => 'text_color',
				'value'   => array( 'custom' ),
			),
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'group'            => $style_group,
			'type'             => 'dropdown',
			'heading'          => esc_html__( 'Icon Color', 'brook' ),
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
			'type'             => 'colorpicker',
			'heading'          => esc_html__( 'Custom Icon Color', 'brook' ),
			'param_name'       => 'custom_icon_color',
			'dependency'       => array(
				'element' => 'icon_color',
				'value'   => array( 'custom' ),
			),
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'group'            => $style_group,
			'type'             => 'dropdown',
			'heading'          => esc_html__( 'Background Color', 'brook' ),
			'param_name'       => 'background_color',
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
			'type'             => 'colorpicker',
			'heading'          => esc_html__( 'Custom Background Color', 'brook' ),
			'param_name'       => 'custom_background_color',
			'dependency'       => array(
				'element' => 'background_color',
				'value'   => array( 'custom' ),
			),
			'edit_field_class' => 'vc_col-sm-6',
		),
	), Brook_VC::icon_libraries( array( 'allow_none' => true ) ), Brook_VC::get_vc_spacing_tab() ),
) );
