<?php

class WPBakeryShortCode_TM_Image extends WPBakeryShortCode {

	public function get_inline_css( $selector, $atts ) {
		global $brook_shortcode_lg_css;
		global $brook_shortcode_md_css;
		global $brook_shortcode_sm_css;
		global $brook_shortcode_xs_css;
		$tmp = $image_tmp = '';

		$tmp .= "text-align: {$atts['align']}";

		if ( $tmp !== '' ) {
			$brook_shortcode_lg_css .= "$selector{ $tmp }";
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

		if ( $atts['rounded'] !== '' ) {
			$image_tmp .= Brook_Helper::get_css_prefix( 'border-radius', "{$atts['rounded']}px" );
		}

		if ( $atts['box_shadow'] !== '' ) {
			$image_tmp .= Brook_Helper::get_css_prefix( 'box-shadow', $atts['box_shadow'] );
		}

		if ( $atts['full_wide'] === '1' ) {
			$image_tmp .= "width: 100%;";
		}

		if ( $image_tmp !== '' ) {
			$brook_shortcode_lg_css .= "$selector img { $image_tmp }";
		}

		Brook_VC::get_vc_spacing_css( $selector, $atts );
	}
}

$styling_tab = esc_html__( 'Styling', 'brook' );

vc_map( array(
	'name'                      => esc_html__( 'Single Image', 'brook' ),
	'base'                      => 'tm_image',
	'category'                  => BROOK_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-singleimage',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'heading'    => esc_html__( 'Image', 'brook' ),
			'type'       => 'attach_image',
			'param_name' => 'image',
		),
		array(
			'heading'     => esc_html__( 'Image Size', 'brook' ),
			'description' => esc_html__( 'Controls the size of image.', 'brook' ),
			'type'        => 'dropdown',
			'param_name'  => 'image_size',
			'value'       => array(
				esc_html__( 'Full', 'brook' )   => 'full',
				esc_html__( 'Custom', 'brook' ) => 'custom',
			),
			'std'         => 'full',
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
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'heading'    => esc_html__( 'On Click Action', 'brook' ),
			'desc'       => esc_html__( 'Select action for click action.', 'brook' ),
			'type'       => 'dropdown',
			'param_name' => 'action',
			'value'      => array(
				esc_html__( 'None', 'brook' )                  => '',
				esc_html__( 'Open Full Image Popup', 'brook' ) => 'popup',
				esc_html__( 'Open Custom Link', 'brook' )      => 'custom_link',
				esc_html__( 'Return To Home', 'brook' )        => 'go_to_home',
			),
			'std'        => '',
		),
		array(
			'heading'     => esc_html__( 'Link', 'brook' ),
			'description' => esc_html__( 'Add a link to image.', 'brook' ),
			'type'        => 'vc_link',
			'param_name'  => 'custom_link',
			'dependency'  => array(
				'element' => 'action',
				'value'   => 'custom_link',
			),
		),
		array(
			'heading'     => esc_html__( 'Full wide', 'brook' ),
			'description' => esc_html__( 'Make image fit wide of container', 'brook' ),
			'type'        => 'checkbox',
			'param_name'  => 'full_wide',
			'value'       => array( esc_html__( 'Yes', 'brook' ) => '1' ),
		),
		array(
			'group'       => $styling_tab,
			'heading'     => esc_html__( 'Rounded', 'brook' ),
			'description' => esc_html__( 'Controls the rounded of image', 'brook' ),
			'type'        => 'number',
			'param_name'  => 'rounded',
			'min'         => 0,
			'max'         => 100,
			'step'        => 1,
			'suffix'      => 'px',
		),
		array(
			'group'       => $styling_tab,
			'heading'     => esc_html__( 'Box Shadow', 'brook' ),
			'description' => esc_html__( 'For e.g: 0 20px 30px #ccc', 'brook' ),
			'type'        => 'textfield',
			'param_name'  => 'box_shadow',
		),
	), Brook_VC::get_alignment_fields(), array(
		Brook_VC::get_animation_field(),
		Brook_VC::extra_class_field(),
	), Brook_VC::get_vc_spacing_tab() ),

) );
