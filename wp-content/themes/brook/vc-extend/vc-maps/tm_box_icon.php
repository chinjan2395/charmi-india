<?php

class WPBakeryShortCode_TM_Box_Icon extends WPBakeryShortCode {

	public function get_inline_css( $selector, $atts ) {
		global $brook_shortcode_lg_css;
		global $brook_shortcode_md_css;
		global $brook_shortcode_sm_css;
		global $brook_shortcode_xs_css;
		$btn_tmp = '';

		$tmp         = Brook_Helper::get_shortcode_css_color_inherit( 'background-color', $atts['background_color'], $atts['custom_background_color'], $atts['background_gradient'] );
		$icon_tmp    = Brook_Helper::get_shortcode_css_color_inherit( 'color', $atts['icon_color'], $atts['custom_icon_color'] );
		$icon_tmp    .= Brook_Helper::get_shortcode_css_color_inherit( 'border-color', $atts['icon_color'], $atts['custom_icon_color'] );
		$heading_tmp = Brook_Helper::get_shortcode_css_color_inherit( 'color', $atts['heading_color'], $atts['custom_heading_color'] );
		$text_tmp    = Brook_Helper::get_shortcode_css_color_inherit( 'color', $atts['text_color'], $atts['custom_text_color'] );

		if ( $atts['background_image'] !== '' ) {
			$_url = wp_get_attachment_image_url( $atts['background_image'], 'full' );
			if ( $_url !== false ) {
				$tmp .= "background-image: url( $_url );";

				if ( $atts['background_size'] !== 'auto' ) {
					$tmp .= "background-size: {$atts['background_size']};";
				}

				$tmp .= "background-repeat: {$atts['background_repeat']};";
				if ( $atts['background_position'] !== '' ) {
					$tmp .= "background-position: {$atts['background_position']};";
				}
			}
		}

		if ( $tmp !== '' ) {
			$brook_shortcode_lg_css .= "$selector{ $tmp }";
		}

		if ( isset( $atts['icon_font_size'] ) ) {
			Brook_VC::get_responsive_css( array(
				'element' => "$selector .icon",
				'atts'    => array(
					'font-size' => array(
						'media_str' => $atts['icon_font_size'],
						'unit'      => 'px',
					),
				),
			) );
		}

		if ( $atts['text_width'] !== '' ) {
			$text_tmp .= "max-width: {$atts['text_width']};";
		}

		if ( $icon_tmp !== '' ) {
			$brook_shortcode_lg_css .= "$selector .icon{ $icon_tmp }";
		}

		if ( $heading_tmp !== '' ) {
			$brook_shortcode_lg_css .= "$selector .heading { $heading_tmp }";
		}

		if ( $text_tmp !== '' ) {
			$brook_shortcode_lg_css .= "$selector .text{ $text_tmp }";
		}

		if ( $atts['text'] === '' && $atts['heading'] === '' ) {
			$brook_shortcode_lg_css .= "$selector .image { margin-bottom: 0; }";
		}

		if ( $atts['button_color'] === 'custom' ) {
			$btn_tmp .= "color: {$atts['custom_button_color']}; ";
		}

		if ( $btn_tmp !== '' ) {
			$brook_shortcode_lg_css .= "$selector .tm-button .button-text{ $btn_tmp }";
		}

		$tmp = "text-align: {$atts['align']}; ";
		if ( $atts['align'] === 'left' ) {
			$tmp .= 'align-items: flex-start';
		} elseif ( $atts['align'] === 'center' ) {
			$tmp .= 'align-items: center;';
		} elseif ( $atts['align'] === 'right' ) {
			$tmp .= 'align-items: flex-end;';
		}

		$brook_shortcode_lg_css .= "$selector .content-wrap { $tmp }";

		$tmp = '';
		if ( $atts['md_align'] !== '' ) {
			$tmp .= "text-align: {$atts['md_align']};";

			if ( $atts['md_align'] === 'left' ) {
				$tmp .= 'align-items: flex-start';
			} elseif ( $atts['md_align'] === 'center' ) {
				$tmp .= 'align-items: center;';
			} elseif ( $atts['md_align'] === 'right' ) {
				$tmp .= 'align-items: flex-end;';
			}

			$brook_shortcode_md_css .= "$selector .content-wrap { $tmp }";
		}

		$tmp = '';
		if ( $atts['sm_align'] !== '' ) {
			$tmp .= "text-align: {$atts['sm_align']};";

			if ( $atts['sm_align'] === 'left' ) {
				$tmp .= 'align-items: flex-start';
			} elseif ( $atts['sm_align'] === 'center' ) {
				$tmp .= 'align-items: center;';
			} elseif ( $atts['sm_align'] === 'right' ) {
				$tmp .= 'align-items: flex-end;';
			}

			$brook_shortcode_sm_css .= "$selector .content-wrap { $tmp }";
		}

		$tmp = '';
		if ( $atts['xs_align'] !== '' ) {
			$tmp .= "text-align: {$atts['xs_align']};";

			if ( $atts['xs_align'] === 'left' ) {
				$tmp .= 'align-items: flex-start';
			} elseif ( $atts['xs_align'] === 'center' ) {
				$tmp .= 'align-items: center;';
			} elseif ( $atts['xs_align'] === 'right' ) {
				$tmp .= 'align-items: flex-end;';
			}

			$brook_shortcode_xs_css .= "$selector .content-wrap { $tmp }";
		}

		Brook_VC::get_vc_spacing_css( $selector, $atts );
	}
}

$content_tab = esc_html__( 'Content', 'brook' );
$styling_tab = esc_html__( 'Styling', 'brook' );

vc_map( array(
	'name'                      => esc_html__( 'Box Icon', 'brook' ),
	'base'                      => 'tm_box_icon',
	'category'                  => BROOK_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-icons',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'heading'     => esc_html__( 'Style', 'brook' ),
			'description' => esc_html__( 'Select style for box icon.', 'brook' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'value'       => array(
				esc_html__( 'Style 01', 'brook' ) => '01',
				esc_html__( 'Style 02', 'brook' ) => '02',
				esc_html__( 'Style 03', 'brook' ) => '03',
				esc_html__( 'Style 04', 'brook' ) => '04',
				esc_html__( 'Style 05', 'brook' ) => '05',
				esc_html__( 'Style 06', 'brook' ) => '06',
				esc_html__( 'Style 07', 'brook' ) => '07',
				esc_html__( 'Style 08', 'brook' ) => '08',
			),
			'admin_label' => true,
			'std'         => '01',
		),
		array(
			'group'      => $content_tab,
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
				esc_html__( 'Default', 'brook' ) => '',
				esc_html__( 'Full', 'brook' )    => 'full',
				esc_html__( 'Custom', 'brook' )  => 'custom',
			),
			'std'         => '',
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
	), Brook_VC::get_alignment_fields(), Brook_VC::icon_libraries( array(
		'group'      => $content_tab,
		'allow_none' => true,
		'allow_svg'  => true,
	) ), array(
		array(
			'group'       => $content_tab,
			'heading'     => esc_html__( 'Box Link', 'brook' ),
			'description' => esc_html__( 'Add a link wrap box icon. This ignore heading link & button link option.', 'brook' ),
			'type'        => 'vc_link',
			'param_name'  => 'box_link',
		),
		array(
			'group'       => $content_tab,
			'heading'     => esc_html__( 'Heading', 'brook' ),
			'type'        => 'textfield',
			'param_name'  => 'heading',
			'admin_label' => true,
		),
		array(
			'group'       => $content_tab,
			'heading'     => esc_html__( 'Heading Link', 'brook' ),
			'description' => esc_html__( 'Add a link to heading. Notice: Box Link option will ignore this option.', 'brook' ),
			'type'        => 'vc_link',
			'param_name'  => 'link',
		),
		array(
			'group'      => $content_tab,
			'heading'    => esc_html__( 'Text', 'brook' ),
			'type'       => 'textarea',
			'param_name' => 'text',
		),
		array(
			'group'       => $content_tab,
			'heading'     => esc_html__( 'Text Width', 'brook' ),
			'description' => esc_html__( 'Input width of box text. For e.g: 300px', 'brook' ),
			'type'        => 'textfield',
			'param_name'  => 'text_width',
		),
		array(
			'group'       => $content_tab,
			'heading'     => esc_html__( 'Button', 'brook' ),
			'description' => esc_html__( 'Notice: Box Link option will ignore this option.', 'brook' ),
			'type'        => 'vc_link',
			'param_name'  => 'button',
		),
		Brook_VC::get_animation_field(),
		Brook_VC::extra_class_field(),
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
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Heading Color', 'brook' ),
			'type'       => 'dropdown',
			'param_name' => 'heading_color',
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
			'heading'    => esc_html__( 'Custom Heading Color', 'brook' ),
			'type'       => 'colorpicker',
			'param_name' => 'custom_heading_color',
			'dependency' => array(
				'element' => 'heading_color',
				'value'   => array( 'custom' ),
			),
			'std'        => '#222',
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
			'std'        => '#999',
		),
		array(
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Text Color', 'brook' ),
			'type'       => 'dropdown',
			'param_name' => 'text_color',
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
			'heading'    => esc_html__( 'Custom Text Color', 'brook' ),
			'type'       => 'colorpicker',
			'param_name' => 'custom_text_color',
			'dependency' => array(
				'element' => 'text_color',
				'value'   => array( 'custom' ),
			),
			'std'        => '#999',
		),
		array(
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Button Color', 'brook' ),
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
			'heading'    => esc_html__( 'Custom Button Color', 'brook' ),
			'type'       => 'colorpicker',
			'param_name' => 'custom_button_color',
			'dependency' => array(
				'element' => 'button_color',
				'value'   => array( 'custom' ),
			),
			'std'        => '#fff',
		),
		array(
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Background Color', 'brook' ),
			'type'       => 'dropdown',
			'param_name' => 'background_color',
			'value'      => array(
				esc_html__( 'None', 'brook' )            => '',
				esc_html__( 'Primary Color', 'brook' )   => 'primary',
				esc_html__( 'Secondary Color', 'brook' ) => 'secondary',
				esc_html__( 'Gradient Color', 'brook' )  => 'gradient',
				esc_html__( 'Custom Color', 'brook' )    => 'custom',
			),
			'std'        => '',
		),

		array(
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Custom Background Color', 'brook' ),
			'type'       => 'colorpicker',
			'param_name' => 'custom_background_color',
			'dependency' => array(
				'element' => 'background_color',
				'value'   => array( 'custom' ),
			),
		),
		array(
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Background Gradient', 'brook' ),
			'type'       => 'gradient',
			'param_name' => 'background_gradient',
			'dependency' => array(
				'element' => 'background_color',
				'value'   => array( 'gradient' ),
			),
		),
		array(
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Background Image', 'brook' ),
			'type'       => 'attach_image',
			'param_name' => 'background_image',
		),
		array(
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Background Repeat', 'brook' ),
			'type'       => 'dropdown',
			'param_name' => 'background_repeat',
			'value'      => array(
				esc_html__( 'No repeat', 'brook' )         => 'no-repeat',
				esc_html__( 'Tile', 'brook' )              => 'repeat',
				esc_html__( 'Tile Horizontally', 'brook' ) => 'repeat-x',
				esc_html__( 'Tile Vertically', 'brook' )   => 'repeat-y',
			),
			'std'        => 'no-repeat',
			'dependency' => array(
				'element'   => 'background_image',
				'not_empty' => true,
			),
		),
		array(
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Background Size', 'brook' ),
			'type'       => 'dropdown',
			'param_name' => 'background_size',
			'value'      => array(
				esc_html__( 'Auto', 'brook' )    => 'auto',
				esc_html__( 'Cover', 'brook' )   => 'cover',
				esc_html__( 'Contain', 'brook' ) => 'contain',
			),
			'std'        => 'cover',
			'dependency' => array(
				'element'   => 'background_image',
				'not_empty' => true,
			),
		),
		array(
			'group'       => $styling_tab,
			'heading'     => esc_html__( 'Background Position', 'brook' ),
			'description' => esc_html__( 'For e.g: left center', 'brook' ),
			'type'        => 'textfield',
			'param_name'  => 'background_position',
			'dependency'  => array(
				'element'   => 'background_image',
				'not_empty' => true,
			),
		),
		array(
			'group'       => $styling_tab,
			'heading'     => esc_html__( 'Background Overlay', 'brook' ),
			'description' => esc_html__( 'Choose an overlay background color.', 'brook' ),
			'type'        => 'dropdown',
			'param_name'  => 'overlay_background',
			'value'       => array(
				esc_html__( 'None', 'brook' )          => '',
				esc_html__( 'Primary Color', 'brook' ) => 'primary',
				esc_html__( 'Custom Color', 'brook' )  => 'overlay_custom_background',
			),
		),
		array(
			'group'       => $styling_tab,
			'heading'     => esc_html__( 'Custom Background Overlay', 'brook' ),
			'description' => esc_html__( 'Choose an custom background color overlay.', 'brook' ),
			'type'        => 'colorpicker',
			'param_name'  => 'overlay_custom_background',
			'std'         => '#000000',
			'dependency'  => array(
				'element' => 'overlay_background',
				'value'   => array( 'overlay_custom_background' ),
			),
		),
		array(
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Opacity', 'brook' ),
			'type'       => 'number',
			'param_name' => 'overlay_opacity',
			'value'      => 100,
			'min'        => 0,
			'max'        => 100,
			'step'       => 1,
			'suffix'     => '%',
			'std'        => 80,
			'dependency' => array(
				'element'   => 'overlay_background',
				'not_empty' => true,
			),
		),
	), Brook_VC::get_vc_spacing_tab() ),

) );
