<?php

class WPBakeryShortCode_TM_Group extends WPBakeryShortCodesContainer {

}

vc_map( array(
	'name'                    => esc_html__( 'Group', 'brook' ),
	'base'                    => 'tm_group',
	'content_element'         => true,
	'show_settings_on_create' => false,
	'is_container'            => true,
	'category'                => BROOK_VC_SHORTCODE_CATEGORY,
	'icon'                    => 'insight-i insight-i-pricing-group',
	'js_view'                 => 'VcColumnView',
	'params'                  => array(
		array(
			'heading'     => esc_html__( 'Style', 'brook' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'None', 'brook' )         => '',
				esc_html__( 'With spacing', 'brook' ) => 'with-spacing',
			),
			'std'         => '',
		),
		Brook_VC::extra_class_field(),
	),
) );

