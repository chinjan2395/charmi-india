<?php

class WPBakeryShortCode_TM_Rotate_Box extends WPBakeryShortCode {

	public function get_inline_css( $selector, $atts ) {
		global $brook_shortcode_lg_css;

		$box_tmp = $front_overlay_tmp = $back_overlay_tmp = '';


		$front_heading_tmp = Brook_Helper::get_shortcode_css_color_inherit( 'color', $atts['front_heading_color'], $atts['front_custom_heading_color'] );
		$back_heading_tmp  = Brook_Helper::get_shortcode_css_color_inherit( 'color', $atts['back_heading_color'], $atts['back_custom_heading_color'] );
		$front_text_tmp    = Brook_Helper::get_shortcode_css_color_inherit( 'color', $atts['front_text_color'], $atts['front_custom_text_color'] );
		$back_text_tmp     = Brook_Helper::get_shortcode_css_color_inherit( 'color', $atts['back_text_color'], $atts['back_custom_text_color'] );
		$front_tmp         = Brook_Helper::get_shortcode_css_color_inherit( 'background-color', $atts['front_background_color'], $atts['front_custom_background_color'], $atts['front_background_gradient'] );
		$back_tmp          = Brook_Helper::get_shortcode_css_color_inherit( 'background-color', $atts['back_background_color'], $atts['back_custom_background_color'], $atts['back_background_gradient'] );

		if ( $atts['front_background_image'] !== '' ) {
			$_url = Brook_Image::get_attachment_url_by_id( array(
				'id'     => $atts['front_background_image'],
				'size'   => $atts['image_size'],
				'width'  => $atts['image_size_width'],
				'height' => $atts['image_size_height'],
			) );

			if ( $_url !== false ) {
				$front_tmp .= "background-image: url( $_url );";
				$front_tmp .= "background-size: cover; background-repeat: no-repeat;";
			}
		}

		if ( $atts['back_background_image'] !== '' ) {
			$_url = Brook_Image::get_attachment_url_by_id( array(
				'id'     => $atts['back_background_image'],
				'size'   => $atts['image_size'],
				'width'  => $atts['image_size_width'],
				'height' => $atts['image_size_height'],
			) );

			if ( $_url !== false ) {
				$back_tmp .= "background-image: url( $_url );";
				$back_tmp .= "background-size: cover; background-repeat: no-repeat;";
			}
		}

		if ( $atts['front_background_overlay'] !== '' ) {
			$front_overlay_tmp .= Brook_Helper::get_shortcode_css_color_inherit( 'background-color', $atts['front_background_overlay'], $atts['front_custom_background_overlay'] );
			$_opacity          = $atts['front_overlay_opacity'] / 100;
			$front_overlay_tmp .= "opacity: {$_opacity};";
		}

		if ( $atts['back_background_overlay'] !== '' ) {
			$back_overlay_tmp .= Brook_Helper::get_shortcode_css_color_inherit( 'background-color', $atts['back_background_overlay'], $atts['back_custom_background_overlay'] );
			$_opacity         = $atts['back_overlay_opacity'] / 100;
			$back_overlay_tmp .= "opacity: {$_opacity};";
		}

		if ( $atts['height'] !== '' ) {
			$box_tmp .= "min-height: {$atts['height']}px;";
		}

		if ( $atts['rounded'] !== '' ) {
			$box_tmp .= Brook_Helper::get_css_prefix( 'border-radius', "{$atts['rounded']}px" );
		}

		if ( $box_tmp !== '' ) {
			$brook_shortcode_lg_css .= "$selector .box { $box_tmp }";
		}

		if ( $front_tmp !== '' ) {
			$brook_shortcode_lg_css .= "$selector .front{ $front_tmp }";
		}

		if ( $front_overlay_tmp !== '' ) {
			$brook_shortcode_lg_css .= "$selector .front:before{ $front_overlay_tmp }";
		}

		if ( $front_heading_tmp !== '' ) {
			$brook_shortcode_lg_css .= "$selector .front .heading{ $front_heading_tmp }";
		}

		if ( $front_text_tmp !== '' ) {
			$brook_shortcode_lg_css .= "$selector .front .text{ $front_text_tmp }";
		}

		if ( $back_tmp !== '' ) {
			$brook_shortcode_lg_css .= "$selector .back{ $back_tmp }";
		}

		if ( $back_overlay_tmp !== '' ) {
			$brook_shortcode_lg_css .= "$selector .back:before{ $back_overlay_tmp }";
		}

		if ( $back_heading_tmp !== '' ) {
			$brook_shortcode_lg_css .= "$selector .back .heading{ $back_heading_tmp }";
		}

		if ( $back_text_tmp !== '' ) {
			$brook_shortcode_lg_css .= "$selector .back .text{ $back_text_tmp }";
		}

		Brook_VC::get_vc_spacing_css( $selector, $atts );
	}
}

$front_tab = esc_html__( 'Front', 'brook' );
$back_tab  = esc_html__( 'Back', 'brook' );

vc_map( array(
	'name'                      => esc_html__( 'Flip Box', 'brook' ),
	'base'                      => 'tm_rotate_box',
	'category'                  => BROOK_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-flip-box',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'heading'     => esc_html__( 'Direction', 'brook' ),
			'description' => esc_html__( 'Select direction for box.', 'brook' ),
			'type'        => 'dropdown',
			'param_name'  => 'direction',
			'value'       => array(
				esc_html__( 'To Top', 'brook' )    => 'top',
				esc_html__( 'To Right', 'brook' )  => 'right',
				esc_html__( 'To Bottom', 'brook' ) => 'bottom',
				esc_html__( 'To Left', 'brook' )   => 'left',
			),
			'admin_label' => true,
			'std'         => 'top',
		),
		array(
			'heading'     => esc_html__( 'Height', 'brook' ),
			'description' => esc_html__( 'Controls the min height of rotate box', 'brook' ),
			'type'        => 'number',
			'param_name'  => 'height',
			'min'         => 100,
			'max'         => 1000,
			'step'        => 10,
			'suffix'      => 'px',
		),
		array(
			'heading'     => esc_html__( 'Rounded', 'brook' ),
			'description' => esc_html__( 'Controls the rounded of rotate box', 'brook' ),
			'type'        => 'number',
			'param_name'  => 'rounded',
			'min'         => 0,
			'max'         => 100,
			'step'        => 1,
			'suffix'      => 'px',
		),
		array(
			'heading'     => esc_html__( 'Image Size', 'brook' ),
			'type'        => 'dropdown',
			'param_name'  => 'image_size',
			'admin_label' => true,
			'value'       => array(
				esc_attr( '480x480' )           => '480x480',
				esc_html__( 'Full', 'brook' )   => 'full',
				esc_html__( 'Custom', 'brook' ) => 'custom',
			),
			'std'         => '480x480',
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
		Brook_VC::get_animation_field(),
		Brook_VC::extra_class_field(),
		array(
			'group'      => $front_tab,
			'heading'    => esc_html__( 'Heading', 'brook' ),
			'type'       => 'textfield',
			'param_name' => 'front_heading',
		),
		array(
			'group'      => $front_tab,
			'heading'    => esc_html__( 'Text', 'brook' ),
			'type'       => 'textarea',
			'param_name' => 'front_text',
		),
		array(
			'group'      => $front_tab,
			'heading'    => esc_html__( 'Button', 'brook' ),
			'type'       => 'vc_link',
			'param_name' => 'front_button',
		),
		array(
			'group'      => $front_tab,
			'heading'    => esc_html__( 'Heading Color', 'brook' ),
			'type'       => 'dropdown',
			'param_name' => 'front_heading_color',
			'value'      => array(
				esc_html__( 'Default', 'brook' )   => '',
				esc_html__( 'Primary', 'brook' )   => 'primary',
				esc_html__( 'Secondary', 'brook' ) => 'secondary',
				esc_html__( 'Custom', 'brook' )    => 'custom',
			),
			'std'        => '',
		),
		array(
			'group'      => $front_tab,
			'heading'    => esc_html__( 'Custom Heading Color', 'brook' ),
			'type'       => 'colorpicker',
			'param_name' => 'front_custom_heading_color',
			'dependency' => array(
				'element' => 'front_heading_color',
				'value'   => array( 'custom' ),
			),
			'std'        => '#fff',
		),
		array(
			'group'      => $front_tab,
			'heading'    => esc_html__( 'Text Color', 'brook' ),
			'type'       => 'dropdown',
			'param_name' => 'front_text_color',
			'value'      => array(
				esc_html__( 'Default', 'brook' )   => '',
				esc_html__( 'Primary', 'brook' )   => 'primary',
				esc_html__( 'Secondary', 'brook' ) => 'secondary',
				esc_html__( 'Custom', 'brook' )    => 'custom',
			),
			'std'        => '',
		),
		array(
			'group'      => $front_tab,
			'heading'    => esc_html__( 'Custom Text Color', 'brook' ),
			'type'       => 'colorpicker',
			'param_name' => 'front_custom_text_color',
			'dependency' => array(
				'element' => 'front_text_color',
				'value'   => array( 'custom' ),
			),
			'std'        => '#fff',
		),
		array(
			'group'       => $front_tab,
			'heading'     => esc_html__( 'Button', 'brook' ),
			'description' => esc_html__( 'Select color for button.', 'brook' ),
			'type'        => 'dropdown',
			'param_name'  => 'front_button_color',
			'value'       => array(
				esc_html__( 'Default', 'brook' )   => 'default',
				esc_html__( 'Primary', 'brook' )   => 'primary',
				esc_html__( 'Secondary', 'brook' ) => 'secondary',
			),
			'std'         => '',
		),
		array(
			'group'      => $front_tab,
			'heading'    => esc_html__( 'Background Color', 'brook' ),
			'type'       => 'dropdown',
			'param_name' => 'front_background_color',
			'value'      => array(
				esc_html__( 'Default', 'brook' )   => '',
				esc_html__( 'Primary', 'brook' )   => 'primary',
				esc_html__( 'Secondary', 'brook' ) => 'secondary',
				esc_html__( 'Custom', 'brook' )    => 'custom',
				esc_html__( 'Gradient', 'brook' )  => 'gradient',
			),
			'std'        => '',
		),
		array(
			'group'      => $front_tab,
			'heading'    => esc_html__( 'Custom Background Color', 'brook' ),
			'type'       => 'colorpicker',
			'param_name' => 'front_custom_background_color',
			'dependency' => array(
				'element' => 'front_background_color',
				'value'   => array( 'custom' ),
			),
		),
		array(
			'group'      => $front_tab,
			'heading'    => esc_html__( 'Background Gradient', 'brook' ),
			'type'       => 'gradient',
			'param_name' => 'front_background_gradient',
			'dependency' => array(
				'element' => 'front_background_color',
				'value'   => array( 'gradient' ),
			),
		),
		array(
			'group'      => $front_tab,
			'heading'    => esc_html__( 'Background Image', 'brook' ),
			'type'       => 'attach_image',
			'param_name' => 'front_background_image',
		),
		array(
			'group'       => $front_tab,
			'heading'     => esc_html__( 'Background Overlay', 'brook' ),
			'description' => esc_html__( 'Choose an overlay background color.', 'brook' ),
			'type'        => 'dropdown',
			'param_name'  => 'front_background_overlay',
			'value'       => array(
				esc_html__( 'None', 'brook' )            => '',
				esc_html__( 'Primary Color', 'brook' )   => 'primary',
				esc_html__( 'Secondary Color', 'brook' ) => 'secondary',
				esc_html__( 'Custom Color', 'brook' )    => 'custom',
			),
			'std'         => '',
		),
		array(
			'group'       => $front_tab,
			'heading'     => esc_html__( 'Custom Background Overlay', 'brook' ),
			'description' => esc_html__( 'Choose an custom background color overlay.', 'brook' ),
			'type'        => 'colorpicker',
			'param_name'  => 'front_custom_background_overlay',
			'std'         => '#000000',
			'dependency'  => array(
				'element' => 'front_background_overlay',
				'value'   => array( 'custom' ),
			),
		),
		array(
			'group'      => $front_tab,
			'heading'    => esc_html__( 'Opacity', 'brook' ),
			'type'       => 'number',
			'param_name' => 'front_overlay_opacity',
			'value'      => 100,
			'min'        => 0,
			'max'        => 100,
			'step'       => 1,
			'suffix'     => '%',
			'std'        => 80,
			'dependency' => array(
				'element'   => 'front_background_overlay',
				'not_empty' => true,
			),
		),

		// Back Content Tab.
		array(
			'group'      => $back_tab,
			'heading'    => esc_html__( 'Heading', 'brook' ),
			'type'       => 'textfield',
			'param_name' => 'back_heading',
		),
		array(
			'group'      => $back_tab,
			'heading'    => esc_html__( 'Text', 'brook' ),
			'type'       => 'textarea',
			'param_name' => 'back_text',
		),
		array(
			'group'      => $back_tab,
			'heading'    => esc_html__( 'Button', 'brook' ),
			'type'       => 'vc_link',
			'param_name' => 'back_button',
		),
		array(
			'group'      => $back_tab,
			'heading'    => esc_html__( 'Heading Color', 'brook' ),
			'type'       => 'dropdown',
			'param_name' => 'back_heading_color',
			'value'      => array(
				esc_html__( 'Default', 'brook' )   => '',
				esc_html__( 'Primary', 'brook' )   => 'primary',
				esc_html__( 'Secondary', 'brook' ) => 'secondary',
				esc_html__( 'Custom', 'brook' )    => 'custom',
			),
			'std'        => '',
		),
		array(
			'group'      => $back_tab,
			'heading'    => esc_html__( 'Custom Heading Color', 'brook' ),
			'type'       => 'colorpicker',
			'param_name' => 'back_custom_heading_color',
			'dependency' => array(
				'element' => 'back_heading_color',
				'value'   => array( 'custom' ),
			),
			'std'        => '#fff',
		),
		array(
			'group'      => $back_tab,
			'heading'    => esc_html__( 'Text Color', 'brook' ),
			'type'       => 'dropdown',
			'param_name' => 'back_text_color',
			'value'      => array(
				esc_html__( 'Default', 'brook' )   => '',
				esc_html__( 'Primary', 'brook' )   => 'primary',
				esc_html__( 'Secondary', 'brook' ) => 'secondary',
				esc_html__( 'Custom', 'brook' )    => 'custom',
			),
			'std'        => '',
		),
		array(
			'group'      => $back_tab,
			'heading'    => esc_html__( 'Custom Text Color', 'brook' ),
			'type'       => 'colorpicker',
			'param_name' => 'back_custom_text_color',
			'dependency' => array(
				'element' => 'back_text_color',
				'value'   => array( 'custom' ),
			),
			'std'        => '#fff',
		),
		array(
			'group'       => $back_tab,
			'heading'     => esc_html__( 'Button', 'brook' ),
			'description' => esc_html__( 'Select color for button.', 'brook' ),
			'type'        => 'dropdown',
			'param_name'  => 'back_button_color',
			'value'       => array(
				esc_html__( 'Default', 'brook' )   => '',
				esc_html__( 'Primary', 'brook' )   => 'primary',
				esc_html__( 'Secondary', 'brook' ) => 'secondary',
			),
			'std'         => '',
		),
		array(
			'group'      => $back_tab,
			'heading'    => esc_html__( 'Background Color', 'brook' ),
			'type'       => 'dropdown',
			'param_name' => 'back_background_color',
			'value'      => array(
				esc_html__( 'Default', 'brook' )   => '',
				esc_html__( 'Primary', 'brook' )   => 'primary',
				esc_html__( 'Secondary', 'brook' ) => 'secondary',
				esc_html__( 'Custom', 'brook' )    => 'custom',
				esc_html__( 'Gradient', 'brook' )  => 'gradient',
			),
			'std'        => '',
		),
		array(
			'group'      => $back_tab,
			'heading'    => esc_html__( 'Custom Background Color', 'brook' ),
			'type'       => 'colorpicker',
			'param_name' => 'back_custom_background_color',
			'dependency' => array(
				'element' => 'back_background_color',
				'value'   => array( 'custom' ),
			),
		),
		array(
			'group'      => $back_tab,
			'heading'    => esc_html__( 'Background Gradient', 'brook' ),
			'type'       => 'gradient',
			'param_name' => 'back_background_gradient',
			'dependency' => array(
				'element' => 'back_background_color',
				'value'   => array( 'gradient' ),
			),
		),
		array(
			'group'      => $back_tab,
			'heading'    => esc_html__( 'Background Image', 'brook' ),
			'type'       => 'attach_image',
			'param_name' => 'back_background_image',
		),
		array(
			'group'       => $back_tab,
			'heading'     => esc_html__( 'Background Overlay', 'brook' ),
			'description' => esc_html__( 'Choose an overlay background color.', 'brook' ),
			'type'        => 'dropdown',
			'param_name'  => 'back_background_overlay',
			'value'       => array(
				esc_html__( 'None', 'brook' )            => '',
				esc_html__( 'Primary Color', 'brook' )   => 'primary',
				esc_html__( 'Secondary Color', 'brook' ) => 'secondary',
				esc_html__( 'Custom Color', 'brook' )    => 'custom',
			),
			'std'         => '',
		),
		array(
			'group'       => $back_tab,
			'heading'     => esc_html__( 'Custom Background Overlay', 'brook' ),
			'description' => esc_html__( 'Choose an custom background color overlay.', 'brook' ),
			'type'        => 'colorpicker',
			'param_name'  => 'back_custom_background_overlay',
			'std'         => '#000000',
			'dependency'  => array(
				'element' => 'back_background_overlay',
				'value'   => array( 'custom' ),
			),
		),
		array(
			'group'      => $back_tab,
			'heading'    => esc_html__( 'Opacity', 'brook' ),
			'type'       => 'number',
			'param_name' => 'back_overlay_opacity',
			'value'      => 100,
			'min'        => 0,
			'max'        => 100,
			'step'       => 1,
			'suffix'     => '%',
			'std'        => 80,
			'dependency' => array(
				'element'   => 'back_background_overlay',
				'not_empty' => true,
			),
		),
	), Brook_VC::get_vc_spacing_tab() ),

) );
