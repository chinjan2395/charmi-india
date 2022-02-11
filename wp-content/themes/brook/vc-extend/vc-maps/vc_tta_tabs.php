<?php

function brook_vc_tta_tabs_get_inline_css( $selector, $atts ) {
	global $brook_shortcode_lg_css;

	$border_color = $atts['custom_border_color'];

	if ( isset( $border_color ) && $border_color !== '' ) {
		$brook_shortcode_lg_css .= "$selector .vc_tta-tab { border-color: {$border_color}; }";
	}
}

$_color_field                                              = WPBMap::getParam( 'vc_tta_tabs', 'color' );
$_color_field['value'][ esc_html__( 'Primary', 'brook' ) ] = 'primary';
$_color_field['std']                                       = 'primary';
vc_update_shortcode_param( 'vc_tta_tabs', $_color_field );

vc_update_shortcode_param( 'vc_tta_tabs', array(
	'param_name' => 'style',
	'value'      => array(
		esc_html__( 'Brook 01', 'brook' ) => 'brook-01',
		esc_html__( 'Brook 02', 'brook' ) => 'brook-02',
		esc_html__( 'Brook 03', 'brook' ) => 'brook-03',
		esc_html__( 'Classic', 'brook' )  => 'classic',
		esc_html__( 'Modern', 'brook' )   => 'modern',
		esc_html__( 'Flat', 'brook' )     => 'flat',
		esc_html__( 'Outline', 'brook' )  => 'outline',
	),
) );

vc_add_params( 'vc_tta_tabs', array(
	array(
		'group'      => esc_html__( 'Styling', 'brook' ),
		'heading'    => esc_html__( 'Border Color', 'brook' ),
		'type'       => 'colorpicker',
		'param_name' => 'custom_border_color',
		'dependency' => array(
			'element' => 'style',
			'value'   => array( 'brook-02' ),
		),
		'std'        => '',
	),
) );
