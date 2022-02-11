<?php

class WPBakeryShortCode_TM_W_Better_Custom_Menu extends WPBakeryShortCode {

	public function get_inline_css( $selector, $atts ) {
		global $brook_shortcode_lg_css;
		global $brook_shortcode_md_css;
		global $brook_shortcode_sm_css;
		global $brook_shortcode_xs_css;

		$link_tmp       = Brook_Helper::get_shortcode_css_color_inherit( 'color', $atts['link_color'], $atts['custom_link_color'] );
		$link_hover_tmp = Brook_Helper::get_shortcode_css_color_inherit( 'color', $atts['link_hover_color'], $atts['custom_link_hover_color'] );


		if ( $atts['align'] !== '' ) {
			$brook_shortcode_lg_css .= "$selector .menu { text-align: {$atts['align']}; }";
		}

		if ( $atts['md_align'] !== '' ) {
			$brook_shortcode_md_css .= "$selector .menu { text-align: {$atts['md_align']} }";
		}

		if ( $atts['sm_align'] !== '' ) {
			$brook_shortcode_sm_css .= "$selector .menu { text-align: {$atts['sm_align']} }";
		}

		if ( $atts['xs_align'] !== '' ) {
			$brook_shortcode_xs_css .= "$selector .menu { text-align: {$atts['xs_align']} }";
		}

		if ( $link_tmp !== '' ) {
			$brook_shortcode_lg_css .= "$selector a { $link_tmp }";
		}

		if ( $link_hover_tmp !== '' ) {
			$brook_shortcode_lg_css .= "$selector a:hover { $link_hover_tmp }";
		}
	}
}

$custom_menus = array();
if ( 'vc_edit_form' === vc_post_param( 'action' ) && vc_verify_admin_nonce() ) {
	$menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
	if ( is_array( $menus ) && ! empty( $menus ) ) {
		foreach ( $menus as $single_menu ) {
			if ( is_object( $single_menu ) && isset( $single_menu->name, $single_menu->slug ) ) {
				$custom_menus[ $single_menu->name ] = $single_menu->slug;
			}
		}
	}
}

$styling_tab = esc_html__( 'Styling', 'brook' );

vc_map( array(
	'name'     => esc_html__( 'Widget Better Custom Menu', 'brook' ),
	'base'     => 'tm_w_better_custom_menu',
	'category' => BROOK_VC_SHORTCODE_CATEGORY,
	'icon'     => 'insight-i insight-i-custom-menu',
	'class'    => 'wpb_vc_wp_widget',
	'params'   => array_merge(
		array(
			array(
				'heading'     => esc_html__( 'Widget title', 'brook' ),
				'type'        => 'textfield',
				'param_name'  => 'title',
				'description' => esc_html__( 'What text use as a widget title. Leave blank to use default widget title.', 'brook' ),
			),
			array(
				'heading'    => esc_html__( 'Style', 'brook' ),
				'type'       => 'dropdown',
				'param_name' => 'style',
				'value'      => array(
					esc_html__( 'Normal', 'brook' )     => '01',
					esc_html__( '02 Columns', 'brook' ) => '02',
					esc_html__( 'Inline', 'brook' )     => '03',
				),
				'std'        => '01',
			),
			array(
				'heading'     => esc_html__( 'Menu', 'brook' ),
				'description' => empty( $custom_menus ) ? wp_kses( __( 'Custom menus not found. Please visit <b>Appearance > Menus</b> page to create new menu.', 'brook' ), array(
					'b' => array(),

				) ) : esc_html__( 'Select menu to display.', 'brook' ),
				'type'        => 'dropdown',
				'param_name'  => 'nav_menu',
				'value'       => $custom_menus,
				'save_always' => true,
				'admin_label' => true,
			),
		),
		Brook_VC::get_alignment_fields(),
		array(
			Brook_VC::extra_class_field(),
			array(
				'group'            => $styling_tab,
				'heading'          => esc_html__( 'Link Color', 'brook' ),
				'type'             => 'dropdown',
				'param_name'       => 'link_color',
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
				'heading'          => esc_html__( 'Custom Link Color', 'brook' ),
				'type'             => 'colorpicker',
				'param_name'       => 'custom_link_color',
				'dependency'       => array(
					'element' => 'link_color',
					'value'   => array( 'custom' ),
				),
				'std'              => '#fff',
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'group'            => $styling_tab,
				'heading'          => esc_html__( 'Link Hover Color', 'brook' ),
				'type'             => 'dropdown',
				'param_name'       => 'link_hover_color',
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
				'heading'          => esc_html__( 'Custom Link Hover Color', 'brook' ),
				'type'             => 'colorpicker',
				'param_name'       => 'custom_link_hover_color',
				'dependency'       => array(
					'element' => 'link_hover_color',
					'value'   => array( 'custom' ),
				),
				'std'              => '#fff',
				'edit_field_class' => 'vc_col-sm-6',
			),
		),
		Brook_VC::get_custom_style_tab()
	),

) );
