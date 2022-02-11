<?php

class WPBakeryShortCode_TM_Social_Networks extends WPBakeryShortCode {

	public function get_inline_css( $selector, $atts ) {
		global $brook_shortcode_lg_css;
		global $brook_shortcode_md_css;
		global $brook_shortcode_sm_css;
		global $brook_shortcode_xs_css;

		$tmp = $link_css = $link_hover_css = $icon_css = $icon_hover_css = $text_css = $text_hover_css = '';
		extract( $atts );

		$icon_css       .= Brook_Helper::get_shortcode_css_color_inherit( 'color', $atts['icon_color'], $atts['custom_icon_color'] );
		$icon_hover_css .= Brook_Helper::get_shortcode_css_color_inherit( 'color', $atts['icon_hover_color'], $atts['custom_icon_hover_color'] );
		$text_css       .= Brook_Helper::get_shortcode_css_color_inherit( 'color', $atts['text_color'], $atts['custom_text_color'] );
		$text_hover_css .= Brook_Helper::get_shortcode_css_color_inherit( 'color', $atts['text_hover_color'], $atts['custom_text_hover_color'] );
		$link_css       .= Brook_Helper::get_shortcode_css_color_inherit( 'border-color', $atts['border_color'], $atts['custom_border_color'] );
		$link_hover_css .= Brook_Helper::get_shortcode_css_color_inherit( 'border-color', $atts['border_hover_color'], $atts['custom_border_hover_color'] );
		$link_css       .= Brook_Helper::get_shortcode_css_color_inherit( 'background-color', $atts['background_color'], $atts['custom_background_color'] );
		$link_hover_css .= Brook_Helper::get_shortcode_css_color_inherit( 'background-color', $atts['background_hover_color'], $atts['custom_background_hover_color'] );

		if ( $atts['align'] !== '' ) {
			$tmp .= "text-align: {$atts['align']};";
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

		if ( $tmp !== '' ) {
			$brook_shortcode_lg_css .= "$selector { $tmp }";
		}

		if ( $icon_css !== '' ) {
			$brook_shortcode_lg_css .= "$selector .link-icon { $icon_css }";
		}

		if ( $icon_hover_css !== '' ) {
			$brook_shortcode_lg_css .= "$selector .item:hover .link-icon { $icon_hover_css }";
		}

		if ( $text_css !== '' ) {
			$brook_shortcode_lg_css .= "$selector .link-text { $text_css }";
		}

		if ( $text_hover_css !== '' ) {
			$brook_shortcode_lg_css .= "$selector .item:hover .link-text { $text_hover_css }";
		}

		if ( $link_css !== '' ) {
			$brook_shortcode_lg_css .= "$selector .link { $link_css }";
		}

		if ( $link_hover_css !== '' ) {
			$brook_shortcode_lg_css .= "$selector .item:hover .link { $link_hover_css }";
		}
	}
}

$styling_tab = esc_html__( 'Styling', 'brook' );

vc_map( array(
	'name'                      => esc_html__( 'Social Networks', 'brook' ),
	'base'                      => 'tm_social_networks',
	'category'                  => BROOK_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-social-networks',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'heading'     => esc_html__( 'Style', 'brook' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Icons', 'brook' )                   => 'icons',
				esc_html__( 'Large Icons', 'brook' )             => 'large-icons',
				esc_html__( 'Extra Large Icons', 'brook' )       => 'extra-large-icons',
				esc_html__( 'Flat Rounded Icon', 'brook' )       => 'flat-rounded-icon',
				esc_html__( 'Solid Rounded Icon', 'brook' )      => 'solid-rounded-icon',
				esc_html__( 'Solid Thin Rounded Icon', 'brook' ) => 'solid-thin-rounded-icon',
				esc_html__( 'Title', 'brook' )                   => 'title',
				esc_html__( 'Icon + Title', 'brook' )            => 'icon-title',
			),
			'std'         => 'icons',
		),
		array(
			'heading'     => esc_html__( 'Layout', 'brook' ),
			'type'        => 'dropdown',
			'param_name'  => 'layout',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Inline', 'brook' )    => 'inline',
				esc_html__( 'List', 'brook' )      => 'list',
				esc_html__( '2 Columns', 'brook' ) => 'two-columns',
			),
			'std'         => 'inline',
		),
	), Brook_VC::get_alignment_fields(), array(
		array(
			'heading'    => esc_html__( 'Open link in a new tab.', 'brook' ),
			'type'       => 'checkbox',
			'param_name' => 'target',
			'value'      => array(
				esc_html__( 'Yes', 'brook' ) => '1',
			),
			'std'        => '1',
		),
		array(
			'heading'    => esc_html__( 'Show tooltip as item title.', 'brook' ),
			'type'       => 'checkbox',
			'param_name' => 'tooltip_enable',
			'value'      => array(
				esc_html__( 'Yes', 'brook' ) => '1',
			),
		),
		array(
			'heading'    => esc_html__( 'Tooltip Skin', 'brook' ),
			'type'       => 'dropdown',
			'param_name' => 'tooltip_skin',
			'value'      => Brook_VC::get_tooltip_skin_list(),
			'std'        => '',
			'dependency' => array(
				'element' => 'tooltip_enable',
				'value'   => '1',
			),
		),
		array(
			'heading'    => esc_html__( 'Tooltip Position', 'brook' ),
			'type'       => 'dropdown',
			'param_name' => 'tooltip_position',
			'value'      => array(
				esc_html__( 'Top', 'brook' )    => 'top',
				esc_html__( 'Right', 'brook' )  => 'right',
				esc_html__( 'Bottom', 'brook' ) => 'bottom',
				esc_html__( 'Left', 'brook' )   => 'left',
			),
			'std'        => 'top',
			'dependency' => array(
				'element' => 'tooltip_enable',
				'value'   => '1',
			),
		),
		Brook_VC::extra_class_field(),
		array(
			'group'      => esc_html__( 'Items', 'brook' ),
			'heading'    => esc_html__( 'Items', 'brook' ),
			'type'       => 'param_group',
			'param_name' => 'items',
			'params'     => array(
				array(
					'heading'     => esc_html__( 'Title', 'brook' ),
					'type'        => 'textfield',
					'param_name'  => 'title',
					'admin_label' => true,
				),
				array(
					'heading'    => esc_html__( 'Link', 'brook' ),
					'type'       => 'textfield',
					'param_name' => 'link',
				),
				array(
					'type'        => 'iconpicker',
					'heading'     => esc_html__( 'Icon', 'brook' ),
					'param_name'  => 'icon_fontawesome5',
					'value'       => 'fab fa-facebook',
					'settings'    => array(
						'emptyIcon'    => true,
						'type'         => 'fontawesome5',
						'iconsPerPage' => 400,
					),
					'description' => esc_html__( 'Select icon from library.', 'brook' ),
				),
			),
			'value'      => rawurlencode( wp_json_encode( array(
				array(
					'title'             => esc_html__( 'Facebook', 'brook' ),
					'link'              => '#',
					'icon_fontawesome5' => 'fab fa-facebook',
				),
				array(
					'title'             => esc_html__( 'Twitter', 'brook' ),
					'link'              => '#',
					'icon_fontawesome5' => 'fab fa-twitter',
				),
				array(
					'title'             => esc_html__( 'Instagram', 'brook' ),
					'link'              => '#',
					'icon_fontawesome5' => 'fab fa-instagram',
				),
				array(
					'title'             => esc_html__( 'Dribbble', 'brook' ),
					'link'              => '#',
					'icon_fontawesome5' => 'fab fa-dribbble',
				),
				array(
					'title'             => esc_html__( 'Pinterest', 'brook' ),
					'link'              => '#',
					'icon_fontawesome5' => 'fab fa-pinterest',
				),
			) ) ),

		),
		array(
			'group'            => $styling_tab,
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
			'group'            => $styling_tab,
			'heading'          => esc_html__( 'Custom Icon Color', 'brook' ),
			'type'             => 'colorpicker',
			'param_name'       => 'custom_icon_color',
			'dependency'       => array(
				'element' => 'icon_color',
				'value'   => 'custom',
			),
			'std'              => '#fff',
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'group'            => $styling_tab,
			'heading'          => esc_html__( 'Icon Hover Color', 'brook' ),
			'type'             => 'dropdown',
			'param_name'       => 'icon_hover_color',
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
			'group'            => $styling_tab,
			'heading'          => esc_html__( 'Custom Icon Hover Color', 'brook' ),
			'type'             => 'colorpicker',
			'param_name'       => 'custom_icon_hover_color',
			'dependency'       => array(
				'element' => 'icon_hover_color',
				'value'   => 'custom',
			),
			'std'              => '#fff',
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'group'            => $styling_tab,
			'heading'          => esc_html__( 'Text Color', 'brook' ),
			'type'             => 'dropdown',
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
			'group'            => $styling_tab,
			'heading'          => esc_html__( 'Custom Text Color', 'brook' ),
			'type'             => 'colorpicker',
			'param_name'       => 'custom_text_color',
			'dependency'       => array(
				'element' => 'text_color',
				'value'   => array( 'custom' ),
			),
			'std'              => '#fff',
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'group'            => $styling_tab,
			'heading'          => esc_html__( 'Text Hover Color', 'brook' ),
			'type'             => 'dropdown',
			'param_name'       => 'text_hover_color',
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
			'group'            => $styling_tab,
			'heading'          => esc_html__( 'Custom Text Hover Color', 'brook' ),
			'type'             => 'colorpicker',
			'param_name'       => 'custom_text_hover_color',
			'dependency'       => array(
				'element' => 'text_hover_color',
				'value'   => array( 'custom' ),
			),
			'std'              => '#fff',
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'group'            => $styling_tab,
			'heading'          => esc_html__( 'Border Color', 'brook' ),
			'type'             => 'dropdown',
			'param_name'       => 'border_color',
			'value'            => array(
				esc_html__( 'Default Color', 'brook' )     => '',
				esc_html__( 'Primary Color', 'brook' )     => 'primary',
				esc_html__( 'Secondary Color', 'brook' )   => 'secondary',
				esc_html__( 'Custom Color', 'brook' )      => 'custom',
				esc_html__( 'Transparent Color', 'brook' ) => 'transparent',
			),
			'std'              => '',
			'edit_field_class' => 'vc_col-sm-6 col-break',
		),
		array(
			'group'            => $styling_tab,
			'heading'          => esc_html__( 'Custom Border Color', 'brook' ),
			'type'             => 'colorpicker',
			'param_name'       => 'custom_border_color',
			'dependency'       => array(
				'element' => 'border_color',
				'value'   => array( 'custom' ),
			),
			'std'              => '#fff',
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'group'            => $styling_tab,
			'heading'          => esc_html__( 'Border Hover Color', 'brook' ),
			'type'             => 'dropdown',
			'param_name'       => 'border_hover_color',
			'value'            => array(
				esc_html__( 'Default Color', 'brook' )     => '',
				esc_html__( 'Primary Color', 'brook' )     => 'primary',
				esc_html__( 'Secondary Color', 'brook' )   => 'secondary',
				esc_html__( 'Custom Color', 'brook' )      => 'custom',
				esc_html__( 'Transparent Color', 'brook' ) => 'transparent',
			),
			'std'              => '',
			'edit_field_class' => 'vc_col-sm-6 col-break',
		),
		array(
			'group'            => $styling_tab,
			'heading'          => esc_html__( 'Custom Border Hover Color', 'brook' ),
			'type'             => 'colorpicker',
			'param_name'       => 'custom_border_hover_color',
			'dependency'       => array(
				'element' => 'border_hover_color',
				'value'   => array( 'custom' ),
			),
			'std'              => '#fff',
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'group'            => $styling_tab,
			'heading'          => esc_html__( 'Background Color', 'brook' ),
			'type'             => 'dropdown',
			'param_name'       => 'background_color',
			'value'            => array(
				esc_html__( 'Default Color', 'brook' )     => '',
				esc_html__( 'Primary Color', 'brook' )     => 'primary',
				esc_html__( 'Secondary Color', 'brook' )   => 'secondary',
				esc_html__( 'Custom Color', 'brook' )      => 'custom',
				esc_html__( 'Transparent Color', 'brook' ) => 'transparent',
			),
			'std'              => '',
			'edit_field_class' => 'vc_col-sm-6 col-break',
		),
		array(
			'group'            => $styling_tab,
			'heading'          => esc_html__( 'Custom Background Color', 'brook' ),
			'type'             => 'colorpicker',
			'param_name'       => 'custom_background_color',
			'dependency'       => array(
				'element' => 'background_color',
				'value'   => array( 'custom' ),
			),
			'std'              => '#fff',
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'group'            => $styling_tab,
			'heading'          => esc_html__( 'Background Hover Color', 'brook' ),
			'type'             => 'dropdown',
			'param_name'       => 'background_hover_color',
			'value'            => array(
				esc_html__( 'Default Color', 'brook' )     => '',
				esc_html__( 'Primary Color', 'brook' )     => 'primary',
				esc_html__( 'Secondary Color', 'brook' )   => 'secondary',
				esc_html__( 'Custom Color', 'brook' )      => 'custom',
				esc_html__( 'Transparent Color', 'brook' ) => 'transparent',
			),
			'std'              => '',
			'edit_field_class' => 'vc_col-sm-6 col-break',
		),
		array(
			'group'            => $styling_tab,
			'heading'          => esc_html__( 'Custom Background Hover Color', 'brook' ),
			'type'             => 'colorpicker',
			'param_name'       => 'custom_background_hover_color',
			'dependency'       => array(
				'element' => 'background_hover_color',
				'value'   => array( 'custom' ),
			),
			'std'              => '#fff',
			'edit_field_class' => 'vc_col-sm-6',
		),
	) ),
) );
