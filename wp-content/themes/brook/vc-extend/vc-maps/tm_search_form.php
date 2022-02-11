<?php

class WPBakeryShortCode_TM_Search_Form extends WPBakeryShortCode {

}

vc_map( array(
	'name'                      => esc_html__( 'Search Form', 'brook' ),
	'base'                      => 'tm_search_form',
	'category'                  => BROOK_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-mailchimp-form',
	'allowed_container_element' => 'vc_row',
	'params'                    => array(
		array(
			'heading'     => esc_html__( 'Style', 'brook' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( '1', 'brook' ) => '1',
			),
			'std'         => '1',
		),
		Brook_VC::extra_class_field(),
	),
) );
