<?php

class WPBakeryShortCode_TM_Icon extends WPBakeryShortCode {

	public function get_inline_css( $selector, $atts ) {
		global $brook_shortcode_lg_css;
		global $brook_shortcode_md_css;
		global $brook_shortcode_sm_css;
		global $brook_shortcode_xs_css;

		$wrapper_tmp = $tmp = '';

		if ( $atts['align'] !== '' ) {
			$wrapper_tmp .= "text-align: {$atts['align']};";
		}

		if ( $atts['md_align'] !== '' ) {
			$brook_shortcode_md_css .= "$selector { text-align: {$atts['md_align']} }";
		}

		if ( $atts['sm_align'] !== '' ) {
			$brook_shortcode_sm_css .= "$selector { text-align: {$atts['sm_align']} }";
		}

		if ( $atts['xs_align'] !== '' ) {
			$brook_shortcode_xs_css .= "$selector { text-align: {$atts['xs_align']} }";
		}

		$tmp .= Brook_Helper::get_shortcode_css_color_inherit( 'color', $atts['icon_color'], $atts['custom_icon_color'] );
		$tmp .= Brook_Helper::get_shortcode_css_color_inherit( 'background', $atts['icon_bg_color'], $atts['custom_icon_bg_color'] );

		if ( $wrapper_tmp !== '' ) {
			$brook_shortcode_lg_css .= "$selector  { $wrapper_tmp }";
		}

		if ( $tmp !== '' ) {
			$brook_shortcode_lg_css .= "$selector .icon { $tmp }";
		}

		if ( isset( $atts['font_size'] ) ) {
			Brook_VC::get_responsive_css( array(
				'element' => "$selector .icon",
				'atts'    => array(
					'font-size' => array(
						'media_str' => $atts['font_size'],
						'unit'      => 'px',
					),
				),
			) );

			Brook_VC::get_responsive_css( array(
				'element' => "$selector .tm-svg",
				'atts'    => array(
					'width' => array(
						'media_str' => $atts['font_size'],
						'unit'      => 'px',
					),
				),
			) );
		}

		Brook_VC::get_vc_spacing_css( $selector, $atts );
	}
}

$params = array_merge( Brook_VC::icon_libraries( array(
	'allow_none' => true,
	'group'      => '',
) ), Brook_VC::get_alignment_fields(), array(
	array(
		'heading'     => esc_html__( 'Style', 'brook' ),
		'type'        => 'dropdown',
		'param_name'  => 'style',
		'value'       => array(
			esc_html__( 'Style 01', 'brook' ) => '01',
			esc_html__( 'Style 02', 'brook' ) => '02',
		),
		'admin_label' => true,
		'std'         => '01',
	),
	array(
		'heading'     => esc_html__( 'Font Size', 'brook' ),
		'type'        => 'number_responsive',
		'param_name'  => 'font_size',
		'min'         => 8,
		'suffix'      => 'px',
		'media_query' => array(
			'lg' => '',
			'md' => '',
			'sm' => '',
			'xs' => '',
		),
	),
	array(
		'group'      => $styling_tab,
		'heading'    => esc_html__( 'Icon Color', 'brook' ),
		'type'       => 'dropdown',
		'param_name' => 'icon_color',
		'value'      => array(
			esc_html__( 'Default Color', 'brook' )   => '',
			esc_html__( 'Primary Color', 'brook' )   => 'primary',
			esc_html__( 'Secondary Color', 'brook' ) => 'secondary',
			esc_html__( 'Custom Color', 'brook' )    => 'custom',
		),
		'std'        => '',
	),
	array(
		'group'      => $styling_tab,
		'heading'    => esc_html__( 'Custom Icon Color', 'brook' ),
		'type'       => 'colorpicker',
		'param_name' => 'custom_icon_color',
		'dependency' => array(
			'element' => 'icon_color',
			'value'   => 'custom',
		),
		'std'        => '#fff',
	),
	array(
		'group'      => $styling_tab,
		'heading'    => esc_html__( 'Icon Background Color', 'brook' ),
		'type'       => 'dropdown',
		'param_name' => 'icon_bg_color',
		'value'      => array(
			esc_html__( 'Default Color', 'brook' )   => '',
			esc_html__( 'Primary Color', 'brook' )   => 'primary',
			esc_html__( 'Secondary Color', 'brook' ) => 'secondary',
			esc_html__( 'Custom Color', 'brook' )    => 'custom',
		),
		'std'        => '',
	),
	array(
		'group'      => $styling_tab,
		'heading'    => esc_html__( 'Custom Icon Background Color', 'brook' ),
		'type'       => 'colorpicker',
		'param_name' => 'custom_icon_bg_color',
		'dependency' => array(
			'element' => 'icon_bg_color',
			'value'   => 'custom',
		),
		'std'        => '#222',
	),
	Brook_VC::get_animation_field(),
	Brook_VC::extra_class_field(),
), Brook_VC::get_vc_spacing_tab() );

vc_map( array(
	'name'                      => esc_html__( 'Icon', 'brook' ),
	'base'                      => 'tm_icon',
	'category'                  => BROOK_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-icons',
	'allowed_container_element' => 'vc_row',
	'params'                    => $params,
) );
