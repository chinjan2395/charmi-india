<?php

class WPBakeryShortCode_TM_Widget_Title extends WPBakeryShortCode {

	public function get_inline_css( $selector, $atts ) {
		Brook_VC::get_vc_spacing_css( $selector, $atts );
	}
}

vc_map( array(
	'name'                      => esc_html__( 'Widget Title', 'brook' ),
	'base'                      => 'tm_widget_title',
	'category'                  => BROOK_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-typography',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'heading'     => esc_html__( 'Widget title', 'brook' ),
			'description' => esc_html__( 'What text use as a widget title.', 'brook' ),
			'type'        => 'textfield',
			'param_name'  => 'widget_title',
			'admin_label' => true,
			'std'         => '',
		),
		Brook_VC::extra_class_field(),
	), Brook_VC::get_vc_spacing_tab() ),
) );
