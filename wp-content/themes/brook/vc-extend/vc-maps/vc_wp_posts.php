<?php

function brook_vc_wp_posts_get_inline_css( $selector, $atts ) {
	global $brook_shortcode_lg_css;

	$link_tmp       = Brook_Helper::get_shortcode_css_color_inherit( 'color', $atts['link_color'], $atts['custom_link_color'] );
	$link_hover_tmp = Brook_Helper::get_shortcode_css_color_inherit( 'color', $atts['link_hover_color'], $atts['custom_link_hover_color'] );

	if ( $link_tmp !== '' ) {
		$brook_shortcode_lg_css .= "$selector a { $link_tmp }";
	}

	if ( $link_hover_tmp !== '' ) {
		$brook_shortcode_lg_css .= "$selector a:hover { $link_hover_tmp }";
	}
}

$styling_tab = esc_html__( 'Styling', 'brook' );

vc_add_params( 'vc_wp_posts', array(
	array(
		'heading'    => esc_html__( 'Sidebar Position', 'brook' ),
		'type'       => 'dropdown',
		'param_name' => 'sidebar_position',
		'value'      => array(
			esc_html__( 'Left', 'brook' )  => 'left',
			esc_html__( 'Right', 'brook' ) => 'right',
		),
		'std'        => 'right',
	),
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
) );
