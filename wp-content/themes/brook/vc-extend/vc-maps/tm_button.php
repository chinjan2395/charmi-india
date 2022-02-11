<?php

class WPBakeryShortCode_TM_Button extends WPBakeryShortCode {

	public function get_inline_css( $selector, $atts ) {
		global $brook_shortcode_lg_css;
		global $brook_shortcode_md_css;
		global $brook_shortcode_sm_css;
		global $brook_shortcode_xs_css;

		$wrapper_tmp     = '';
		$button_tmp      = $button_hover_tmp = '';
		$button_icon_tmp = $button_hover_icon_tmp = '';

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

		if ( $atts['rounded'] !== '' ) {
			$button_tmp .= Brook_Helper::get_css_prefix( 'border-radius', $atts['rounded'] );
		}

		if ( $atts['box_shadow'] !== '' ) {
			$button_tmp .= Brook_Helper::get_css_prefix( 'box-shadow', $atts['box_shadow'] );
		}

		if ( $atts['size'] === 'custom' ) {
			if ( $atts['width'] !== '' ) {
				$button_tmp .= "min-width: {$atts['width']}px;";
			}

			if ( $atts['advanced_border_width'] === '1' ) {

				if ( $atts['border_top_width'] !== '' ) {
					$button_tmp .= "border-top-width: {$atts['border_top_width']}px;";
				}

				if ( $atts['border_bottom_width'] !== '' ) {
					$button_tmp .= "border-bottom-width: {$atts['border_bottom_width']}px;";
				}

				if ( $atts['border_left_width'] !== '' ) {
					$button_tmp .= "border-left-width: {$atts['border_left_width']}px;";
				}

				if ( $atts['border_right_width'] !== '' ) {
					$button_tmp .= "border-right-width: {$atts['border_right_width']}px;";
				}

			} else {
				if ( $atts['border_width'] !== '' ) {
					$button_tmp .= "border-width: {$atts['border_width']}px;";
				}
			}

			if ( $atts['height'] !== '' ) {
				$button_tmp   .= "min-height: {$atts['height']}px;";
				$_line_height = $atts['height'];
				if ( $atts['border_width'] !== '' ) {
					$_line_height = $_line_height - ( $atts['border_width'] * 2 );
				}

				$button_tmp .= "line-height: {$_line_height}px;";
			}
		}

		if ( isset( $atts['icon_font_size'] ) ) {
			Brook_VC::get_responsive_css( array(
				'element' => "$selector .button-icon",
				'atts'    => array(
					'font-size' => array(
						'media_str' => $atts['icon_font_size'],
						'unit'      => 'px',
					),
				),
			) );
		}

		if ( isset( $atts['text_font_size'] ) ) {
			Brook_VC::get_responsive_css( array(
				'element' => "$selector .button-text",
				'atts'    => array(
					'font-size' => array(
						'media_str' => $atts['text_font_size'],
						'unit'      => 'px',
					),
				),
			) );
		}

		if ( $atts['color'] === 'custom' ) {
			$button_tmp            .= Brook_Helper::get_shortcode_css_color_inherit( 'color', $atts['font_color'], $atts['custom_font_color'] );
			$button_tmp            .= Brook_Helper::get_shortcode_css_color_inherit( 'border-color', $atts['button_border_color'], $atts['custom_button_border_color'] );
			$button_tmp            .= Brook_Helper::get_shortcode_css_color_inherit( 'background-color', $atts['button_bg_color'], $atts['custom_button_bg_color'], $atts['button_bg_gradient'] );
			$button_hover_tmp      .= Brook_Helper::get_shortcode_css_color_inherit( 'color', $atts['font_color_hover'], $atts['custom_font_color_hover'] );
			$button_hover_tmp      .= Brook_Helper::get_shortcode_css_color_inherit( 'border-color', $atts['button_border_color_hover'], $atts['custom_button_border_color_hover'] );
			$button_hover_tmp      .= Brook_Helper::get_shortcode_css_color_inherit( 'background-color', $atts['button_bg_color_hover'], $atts['custom_button_bg_color_hover'], $atts['button_bg_gradient_hover'] );
			$button_icon_tmp       .= Brook_Helper::get_shortcode_css_color_inherit( 'color', $atts['button_icon_color'], $atts['custom_button_icon_color'] );
			$button_hover_icon_tmp .= Brook_Helper::get_shortcode_css_color_inherit( 'color', $atts['button_icon_color_hover'], $atts['custom_button_icon_color_hover'] );
		}

		if ( $wrapper_tmp !== '' ) {
			$brook_shortcode_lg_css .= "$selector { $wrapper_tmp }";
		}

		if ( $button_tmp !== '' ) {
			$brook_shortcode_lg_css .= "$selector .tm-button{ $button_tmp }";
		}

		if ( $button_hover_tmp !== '' ) {
			if ( $atts['style'] === 'text' ) {
				$brook_shortcode_lg_css .= "$selector .tm-button:hover span { $button_hover_tmp }";
			} else {
				$brook_shortcode_lg_css .= "$selector .tm-button:hover { $button_hover_tmp }";
			}
		}

		if ( $button_icon_tmp !== '' ) {
			$brook_shortcode_lg_css .= "$selector .tm-button .button-icon { $button_icon_tmp }";
		}

		if ( $button_hover_icon_tmp !== '' ) {
			$brook_shortcode_lg_css .= "$selector .tm-button:hover .button-icon { $button_hover_icon_tmp }";
		}

		Brook_VC::get_vc_spacing_css( $selector, $atts );
	}
}

$styling_tab = esc_html__( 'Styling', 'brook' );

vc_map( array(
	'name'     => esc_html__( 'Button', 'brook' ),
	'base'     => 'tm_button',
	'category' => BROOK_VC_SHORTCODE_CATEGORY,
	'icon'     => 'insight-i insight-i-button',
	'params'   => array_merge( array(
		array(
			'heading'     => esc_html__( 'Style', 'brook' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Border Icon', 'brook' )               => 'border-icon',
				esc_html__( 'Flat', 'brook' )                      => 'flat',
				esc_html__( 'Flat - Rounded', 'brook' )            => 'flat-rounded',
				esc_html__( 'Flat - Gradient', 'brook' )           => 'flat-gradient',
				esc_html__( 'Solid', 'brook' )                     => 'solid',
				esc_html__( 'Icon - Rounded - Gradient', 'brook' ) => 'icon-rounded-gradient',
				esc_html__( 'Text', 'brook' )                      => 'text',
				esc_html__( 'Border Text', 'brook' )               => 'border-text',
				esc_html__( 'Image', 'brook' )                     => 'image',
				esc_html__( 'Image Text', 'brook' )                => 'image-text',
				esc_html__( 'Image Text - Alt', 'brook' )          => 'image-text-alt',
				esc_html__( 'Text - Long Arrow', 'brook' )         => 'text-long-arrow',
				esc_html__( 'Text - Left Line', 'brook' )          => 'text-left-line',
			),
			'std'         => 'flat',
		),
		array(
			'heading'    => esc_html__( 'Image', 'brook' ),
			'type'       => 'attach_image',
			'param_name' => 'image',
			'dependency' => array( 'element' => 'style', 'value' => array( 'image', 'image-text', 'image-text-alt' ) ),
		),
		array(
			'heading'     => esc_html__( 'Size', 'brook' ),
			'type'        => 'dropdown',
			'param_name'  => 'size',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Large', 'brook' )       => 'lg',
				esc_html__( 'Normal', 'brook' )      => 'nm',
				esc_html__( 'Small', 'brook' )       => 'sm',
				esc_html__( 'Extra Small', 'brook' ) => 'xs',
				esc_html__( 'Custom', 'brook' )      => 'custom',
			),
			'std'         => 'nm',
		),
		array(
			'heading'     => esc_html__( 'Width', 'brook' ),
			'description' => esc_html__( 'Controls the width of button.', 'brook' ),
			'type'        => 'number',
			'suffix'      => 'px',
			'param_name'  => 'width',
			'dependency'  => array( 'element' => 'size', 'value' => 'custom' ),
		),
		array(
			'heading'     => esc_html__( 'Height', 'brook' ),
			'description' => esc_html__( 'Controls the height of button.', 'brook' ),
			'type'        => 'number',
			'suffix'      => 'px',
			'param_name'  => 'height',
			'dependency'  => array( 'element' => 'size', 'value' => 'custom' ),
		),
		array(
			'heading'    => esc_html__( 'Advanced Border Width?', 'brook' ),
			'type'       => 'checkbox',
			'param_name' => 'advanced_border_width',
			'value'      => array( esc_html__( 'Yes', 'brook' ) => '1' ),
			'dependency' => array( 'element' => 'size', 'value' => 'custom' ),
		),
		array(
			'heading'    => esc_html__( 'Border Width', 'brook' ),
			'type'       => 'number',
			'suffix'     => 'px',
			'param_name' => 'border_width',
			'dependency' => array( 'element' => 'advanced_border_width', 'value_not_equal_to' => '1' ),
		),
		array(
			'heading'          => esc_html__( 'Border Top Width', 'brook' ),
			'type'             => 'number',
			'suffix'           => 'px',
			'param_name'       => 'border_top_width',
			'dependency'       => array( 'element' => 'advanced_border_width', 'value' => '1' ),
			'edit_field_class' => 'vc_col-sm-3',
		),
		array(
			'heading'          => esc_html__( 'Border Bottom Width', 'brook' ),
			'type'             => 'number',
			'suffix'           => 'px',
			'param_name'       => 'border_bottom_width',
			'dependency'       => array( 'element' => 'advanced_border_width', 'value' => '1' ),
			'edit_field_class' => 'vc_col-sm-3',
		),
		array(
			'heading'          => esc_html__( 'Border Right Width', 'brook' ),
			'type'             => 'number',
			'suffix'           => 'px',
			'param_name'       => 'border_right_width',
			'dependency'       => array( 'element' => 'advanced_border_width', 'value' => '1' ),
			'edit_field_class' => 'vc_col-sm-3',
		),
		array(
			'heading'          => esc_html__( 'Border Left Width', 'brook' ),
			'type'             => 'number',
			'suffix'           => 'px',
			'param_name'       => 'border_left_width',
			'dependency'       => array( 'element' => 'advanced_border_width', 'value' => '1' ),
			'edit_field_class' => 'vc_col-sm-3',
		),
		array(
			'heading'     => esc_html__( 'Force Full Width', 'brook' ),
			'description' => esc_html__( 'Make button full wide.', 'brook' ),
			'type'        => 'checkbox',
			'param_name'  => 'full_wide',
			'value'       => array( esc_html__( 'Yes', 'brook' ) => '1' ),
		),
		array(
			'heading'     => esc_html__( 'Rounded', 'brook' ),
			'type'        => 'textfield',
			'param_name'  => 'rounded',
			'description' => esc_html__( 'Input a valid radius. For e.g: 10px. Leave blank to use default.', 'brook' ),
		),
		array(
			'heading'     => esc_html__( 'Box Shadow', 'brook' ),
			'type'        => 'textfield',
			'param_name'  => 'box_shadow',
			'description' => esc_html__( 'Input a valid box shadow. For e.g: "0 0 20px rgba(0, 0, 0, 0.15)" Leave blank to use default.', 'brook' ),
		),
		array(
			'heading'    => esc_html__( 'Button', 'brook' ),
			'type'       => 'vc_link',
			'param_name' => 'button',
			'value'      => esc_html__( 'Button', 'brook' ),
		),
		array(
			'group'      => esc_html__( 'Icon', 'brook' ),
			'heading'    => esc_html__( 'Icon Align', 'brook' ),
			'type'       => 'dropdown',
			'param_name' => 'icon_align',
			'value'      => array(
				esc_html__( 'Left', 'brook' )  => 'left',
				esc_html__( 'Right', 'brook' ) => 'right',
			),
			'std'        => 'right',
		),
		array(
			'heading'     => esc_html__( 'Button Action', 'brook' ),
			'description' => esc_html__( 'To make smooth scroll action work then input button url like this: #about-us-section.', 'brook' ),
			'type'        => 'dropdown',
			'param_name'  => 'action',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Default', 'brook' )                    => '',
				esc_html__( 'Smooth scroll to a section', 'brook' ) => 'smooth_scroll',
				esc_html__( 'Open link as popup video', 'brook' )   => 'popup_video',

			),
			'std'         => '',
		),
		array(
			'heading'     => esc_html__( 'Hover Animation', 'brook' ),
			'type'        => 'dropdown',
			'param_name'  => 'hover_animation',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Default', 'brook' )   => '',
				esc_html__( 'Icon Move', 'brook' ) => 'icon-move',
				esc_html__( 'Move Up', 'brook' )   => 'move-up',
			),
			'std'         => '',
		),
	), Brook_VC::get_alignment_fields(), array(
		Brook_VC::get_animation_field(),
		Brook_VC::extra_class_field(),
		Brook_VC::extra_id_field(),
	), Brook_VC::icon_libraries( array(
		'allow_none' => true,
	) ), array(
		array(
			'group'       => $styling_tab,
			'heading'     => esc_html__( 'Icon Font Size', 'brook' ),
			'type'        => 'number_responsive',
			'param_name'  => 'icon_font_size',
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
			'group'       => $styling_tab,
			'heading'     => esc_html__( 'Text Font Size', 'brook' ),
			'type'        => 'number_responsive',
			'param_name'  => 'text_font_size',
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
			'group'       => $styling_tab,
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Color', 'brook' ),
			'param_name'  => 'color',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Primary', 'brook' )   => 'primary',
				esc_html__( 'Secondary', 'brook' ) => 'secondary',
				esc_html__( 'Custom', 'brook' )    => 'custom',
			),
			'std'         => 'primary',
		),
		array(
			'group'            => $styling_tab,
			'type'             => 'dropdown',
			'heading'          => esc_html__( 'Background color', 'brook' ),
			'param_name'       => 'button_bg_color',
			'value'            => array(
				esc_html__( 'Default', 'brook' )     => '',
				esc_html__( 'Primary', 'brook' )     => 'primary',
				esc_html__( 'Secondary', 'brook' )   => 'secondary',
				esc_html__( 'Gradient', 'brook' )    => 'gradient',
				esc_html__( 'Transparent', 'brook' ) => 'transparent',
				esc_html__( 'Custom', 'brook' )      => 'custom',
			),
			'std'              => '',
			'dependency'       => array(
				'element' => 'color',
				'value'   => 'custom',
			),
			'edit_field_class' => 'vc_col-sm-6 col-break',
		),
		array(
			'group'            => $styling_tab,
			'type'             => 'colorpicker',
			'heading'          => esc_html__( 'Custom background color', 'brook' ),
			'param_name'       => 'custom_button_bg_color',
			'dependency'       => array(
				'element' => 'button_bg_color',
				'value'   => 'custom',
			),
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Background Gradient', 'brook' ),
			'type'       => 'gradient',
			'param_name' => 'button_bg_gradient',
			'dependency' => array(
				'element' => 'button_bg_color',
				'value'   => array( 'gradient' ),
			),
		),
		array(
			'group'            => $styling_tab,
			'type'             => 'dropdown',
			'heading'          => esc_html__( 'Text color', 'brook' ),
			'param_name'       => 'font_color',
			'value'            => array(
				esc_html__( 'Default', 'brook' )   => '',
				esc_html__( 'Primary', 'brook' )   => 'primary',
				esc_html__( 'Secondary', 'brook' ) => 'secondary',
				esc_html__( 'Custom', 'brook' )    => 'custom',
			),
			'std'              => '',
			'dependency'       => array(
				'element' => 'color',
				'value'   => 'custom',
			),
			'edit_field_class' => 'vc_col-sm-6 col-break',
		),
		array(
			'group'            => $styling_tab,
			'type'             => 'colorpicker',
			'heading'          => esc_html__( 'Custom text color', 'brook' ),
			'param_name'       => 'custom_font_color',
			'dependency'       => array(
				'element' => 'font_color',
				'value'   => 'custom',
			),
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'group'            => $styling_tab,
			'type'             => 'dropdown',
			'heading'          => esc_html__( 'Border color', 'brook' ),
			'param_name'       => 'button_border_color',
			'value'            => array(
				esc_html__( 'Default', 'brook' )     => '',
				esc_html__( 'Primary', 'brook' )     => 'primary',
				esc_html__( 'Secondary', 'brook' )   => 'secondary',
				esc_html__( 'Transparent', 'brook' ) => 'transparent',
				esc_html__( 'Custom', 'brook' )      => 'custom',
			),
			'std'              => '',
			'dependency'       => array(
				'element' => 'color',
				'value'   => 'custom',
			),
			'edit_field_class' => 'vc_col-sm-6 col-break',
		),
		array(
			'group'            => $styling_tab,
			'type'             => 'colorpicker',
			'heading'          => esc_html__( 'Custom Border color', 'brook' ),
			'param_name'       => 'custom_button_border_color',
			'dependency'       => array(
				'element' => 'button_border_color',
				'value'   => 'custom',
			),
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'group'            => $styling_tab,
			'type'             => 'dropdown',
			'heading'          => esc_html__( 'Icon color', 'brook' ),
			'param_name'       => 'button_icon_color',
			'value'            => array(
				esc_html__( 'Default', 'brook' )   => '',
				esc_html__( 'Primary', 'brook' )   => 'primary',
				esc_html__( 'Secondary', 'brook' ) => 'secondary',
				esc_html__( 'Custom', 'brook' )    => 'custom',
			),
			'std'              => '',
			'dependency'       => array(
				'element' => 'color',
				'value'   => 'custom',
			),
			'edit_field_class' => 'vc_col-sm-6 col-break',
		),
		array(
			'group'            => $styling_tab,
			'type'             => 'colorpicker',
			'heading'          => esc_html__( 'Custom Icon color', 'brook' ),
			'param_name'       => 'custom_button_icon_color',
			'dependency'       => array(
				'element' => 'button_icon_color',
				'value'   => 'custom',
			),
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'group'            => $styling_tab,
			'type'             => 'dropdown',
			'heading'          => esc_html__( 'Background color (on hover)', 'brook' ),
			'param_name'       => 'button_bg_color_hover',
			'value'            => array(
				esc_html__( 'Default', 'brook' )     => '',
				esc_html__( 'Primary', 'brook' )     => 'primary',
				esc_html__( 'Secondary', 'brook' )   => 'secondary',
				esc_html__( 'Gradient', 'brook' )    => 'gradient',
				esc_html__( 'Transparent', 'brook' ) => 'transparent',
				esc_html__( 'Custom', 'brook' )      => 'custom',
			),
			'std'              => '',
			'dependency'       => array(
				'element' => 'color',
				'value'   => 'custom',
			),
			'edit_field_class' => 'vc_col-sm-6 col-break',
		),
		array(
			'group'            => $styling_tab,
			'type'             => 'colorpicker',
			'heading'          => esc_html__( 'Custom background color (on hover)', 'brook' ),
			'param_name'       => 'custom_button_bg_color_hover',
			'dependency'       => array(
				'element' => 'button_bg_color_hover',
				'value'   => 'custom',
			),
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Background Gradient (on hover)', 'brook' ),
			'type'       => 'gradient',
			'param_name' => 'button_bg_gradient_hover',
			'dependency' => array(
				'element' => 'button_bg_color_hover',
				'value'   => array( 'gradient' ),
			),
		),
		array(
			'group'            => $styling_tab,
			'type'             => 'dropdown',
			'heading'          => esc_html__( 'Text color (on hover)', 'brook' ),
			'param_name'       => 'font_color_hover',
			'value'            => array(
				esc_html__( 'Default', 'brook' )   => '',
				esc_html__( 'Primary', 'brook' )   => 'primary',
				esc_html__( 'Secondary', 'brook' ) => 'secondary',
				esc_html__( 'Custom', 'brook' )    => 'custom',
			),
			'std'              => '',
			'dependency'       => array(
				'element' => 'color',
				'value'   => 'custom',
			),
			'edit_field_class' => 'vc_col-sm-6 col-break',
		),
		array(
			'group'            => $styling_tab,
			'type'             => 'colorpicker',
			'heading'          => esc_html__( 'Custom Text color (on hover)', 'brook' ),
			'param_name'       => 'custom_font_color_hover',
			'dependency'       => array(
				'element' => 'font_color_hover',
				'value'   => 'custom',
			),
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'group'            => $styling_tab,
			'type'             => 'dropdown',
			'heading'          => esc_html__( 'Border color (on hover)', 'brook' ),
			'param_name'       => 'button_border_color_hover',
			'value'            => array(
				esc_html__( 'Default', 'brook' )     => '',
				esc_html__( 'Primary', 'brook' )     => 'primary',
				esc_html__( 'Secondary', 'brook' )   => 'secondary',
				esc_html__( 'Transparent', 'brook' ) => 'transparent',
				esc_html__( 'Custom', 'brook' )      => 'custom',
			),
			'std'              => '',
			'dependency'       => array(
				'element' => 'color',
				'value'   => 'custom',
			),
			'edit_field_class' => 'vc_col-sm-6 col-break',
		),
		array(
			'group'            => $styling_tab,
			'type'             => 'colorpicker',
			'heading'          => esc_html__( 'Custom Border color (on hover)', 'brook' ),
			'param_name'       => 'custom_button_border_color_hover',
			'dependency'       => array(
				'element' => 'button_border_color_hover',
				'value'   => 'custom',
			),
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'group'            => $styling_tab,
			'type'             => 'dropdown',
			'heading'          => esc_html__( 'Icon color (on hover)', 'brook' ),
			'param_name'       => 'button_icon_color_hover',
			'value'            => array(
				esc_html__( 'Default', 'brook' )   => '',
				esc_html__( 'Primary', 'brook' )   => 'primary',
				esc_html__( 'Secondary', 'brook' ) => 'secondary',
				esc_html__( 'Custom', 'brook' )    => 'custom',
			),
			'std'              => '',
			'dependency'       => array(
				'element' => 'color',
				'value'   => 'custom',
			),
			'edit_field_class' => 'vc_col-sm-6 col-break',
		),
		array(
			'group'            => $styling_tab,
			'type'             => 'colorpicker',
			'heading'          => esc_html__( 'Custom Icon color (on hover)', 'brook' ),
			'param_name'       => 'custom_button_icon_color_hover',
			'dependency'       => array(
				'element' => 'button_icon_color_hover',
				'value'   => 'custom',
			),
			'edit_field_class' => 'vc_col-sm-6',
		),
	), Brook_VC::get_vc_spacing_tab() ),
) );
