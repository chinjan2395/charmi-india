<?php

class WPBakeryShortCode_TM_Popup_Video extends WPBakeryShortCode {

	public function get_inline_css( $selector, $atts ) {
		global $brook_shortcode_lg_css;
		global $brook_shortcode_md_css;
		global $brook_shortcode_sm_css;
		global $brook_shortcode_xs_css;

		$wrapper_tmp = '';

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

		if ( $wrapper_tmp !== '' ) {
			$brook_shortcode_lg_css .= "$selector { $wrapper_tmp }";
		}

		$button_tmp = Brook_Helper::get_shortcode_css_color_inherit( 'background-color', $atts['button_color'], $atts['custom_button_color'] );
		if ( $button_tmp !== '' ) {
			$brook_shortcode_lg_css .= "$selector .video-play { $button_tmp }";
		}

		Brook_VC::get_vc_spacing_css( $selector, $atts );
	}
}

$posters = array(
	'poster-01',
	'poster-02',
	'poster-03',
	'poster-04',
);

$styling_tab = esc_html__( 'Styling', 'brook' );

vc_map( array(
	'name'                      => esc_html__( 'Popup Video', 'brook' ),
	'base'                      => 'tm_popup_video',
	'category'                  => BROOK_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-video',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'heading'     => esc_html__( 'Style', 'brook' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Poster Style 01', 'brook' ) => 'poster-01',
				esc_html__( 'Poster Style 02', 'brook' ) => 'poster-02',
				esc_html__( 'Poster Style 03', 'brook' ) => 'poster-03',
				esc_html__( 'Poster Style 04', 'brook' ) => 'poster-04',
				esc_html__( 'Button Style 01', 'brook' ) => 'button',
				esc_html__( 'Button Style 02', 'brook' ) => 'button-02',
				esc_html__( 'Button Style 03', 'brook' ) => 'button-03',
				esc_html__( 'Button Style 04', 'brook' ) => 'button-04',
				esc_html__( 'Button Style 05', 'brook' ) => 'button-05',
				esc_html__( 'Button Style 06', 'brook' ) => 'button-06',
				esc_html__( 'Box Style 01', 'brook' )    => 'box-01',
			),
			'std'         => 'poster-01',
		),
		array(
			'heading'     => esc_html__( 'Video Url', 'brook' ),
			'description' => esc_html__( 'For e.g: "https://www.youtube.com/watch?v=9No-FiEInLA"', 'brook' ),
			'type'        => 'textfield',
			'param_name'  => 'video',
		),
		array(
			'heading'     => esc_html__( 'Video Text', 'brook' ),
			'type'        => 'textfield',
			'param_name'  => 'video_text',
			'admin_label' => true,
		),
		array(
			'heading'    => esc_html__( 'Poster Image', 'brook' ),
			'type'       => 'attach_image',
			'param_name' => 'poster',
			'dependency' => array(
				'element' => 'style',
				'value'   => $posters,
			),
		),
		array(
			'heading'     => esc_html__( 'Poster Image Size', 'brook' ),
			'description' => esc_html__( 'Controls the size of poster image.', 'brook' ),
			'type'        => 'dropdown',
			'param_name'  => 'image_size',
			'value'       => array(
				esc_html__( '570x420', 'brook' ) => '570x420',
				esc_html__( '770x500', 'brook' ) => '770x500',
				esc_html__( 'Full', 'brook' )    => 'full',
				esc_html__( 'Custom', 'brook' )  => 'custom',
			),
			'std'         => '570x420',
			'dependency'  => array(
				'element' => 'style',
				'value'   => $posters,
			),
		),
		array(
			'heading'          => esc_html__( 'Image Width', 'brook' ),
			'type'             => 'number',
			'param_name'       => 'image_size_width',
			'min'              => 0,
			'max'              => 1920,
			'step'             => 10,
			'suffix'           => 'px',
			'dependency'       => array(
				'element' => 'image_size',
				'value'   => array( 'custom' ),
			),
			'edit_field_class' => 'vc_col-sm-6 col-break',
		),
		array(
			'heading'          => esc_html__( 'Image Height', 'brook' ),
			'type'             => 'number',
			'param_name'       => 'image_size_height',
			'min'              => 0,
			'max'              => 1920,
			'step'             => 10,
			'suffix'           => 'px',
			'dependency'       => array(
				'element' => 'image_size',
				'value'   => array( 'custom' ),
			),
			'edit_field_class' => 'vc_col-sm-6 col-break',
		),
		array(
			'heading'    => esc_html__( 'Poster - Full Wide', 'brook' ),
			'type'       => 'checkbox',
			'param_name' => 'poster_full_wide',
			'value'      => array(
				esc_html__( 'Yes', 'brook' ) => '1',
			),
			'std'        => '1',
			'dependency' => array(
				'element' => 'style',
				'value'   => $posters,
			),
		),
	), Brook_VC::get_alignment_fields(), array(
		Brook_VC::extra_class_field(),
		array(
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Video Button Color', 'brook' ),
			'type'       => 'dropdown',
			'param_name' => 'button_color',
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
			'heading'    => esc_html__( 'Custom Video Button Color', 'brook' ),
			'type'       => 'colorpicker',
			'param_name' => 'custom_button_color',
			'dependency' => array(
				'element' => 'button_color',
				'value'   => array( 'custom' ),
			),
			'std'        => '#fff',
		),
	), Brook_VC::get_vc_spacing_tab(), Brook_VC::get_custom_style_tab() ),
) );
