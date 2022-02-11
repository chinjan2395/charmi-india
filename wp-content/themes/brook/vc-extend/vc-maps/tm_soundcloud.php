<?php

class WPBakeryShortCode_TM_SoundCloud extends WPBakeryShortCode {

	public function get_inline_css( $selector, $atts ) {
		Brook_VC::get_vc_spacing_css( $selector, $atts );
	}
}

vc_map( array(
	'name'                      => esc_html__( 'SoundCloud', 'brook' ),
	'base'                      => 'tm_soundcloud',
	'category'                  => BROOK_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-icons',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'heading'    => esc_html__( 'Embed Code', 'brook' ),
			'type'       => 'textarea_html',
			'param_name' => 'content',
		),
		Brook_VC::extra_class_field(),
	), Brook_VC::get_vc_spacing_tab() ),
) );
