<?php

class WPBakeryShortCode_TM_Contact_Form_7_Box extends WPBakeryShortCode {

}

vc_map( array(
	'name'                      => esc_html__( 'Contact Form 7 Box', 'brook' ),
	'base'                      => 'tm_contact_form_7_box',
	'category'                  => BROOK_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-contact-form-7',
	'allowed_container_element' => 'vc_row',
	'params'                    => array(
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Form', 'brook' ),
			'param_name'  => 'id',
			'value'       => Brook_VC::instance()->get_contact_form_7_list(),
			'save_always' => true,
			'admin_label' => true,
			'description' => esc_html__( 'Choose previously created contact form from the drop down list.', 'brook' ),
		),
		array(
			'heading'     => esc_html__( 'Style', 'brook' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( '01', 'brook' ) => '01',
				esc_html__( '02', 'brook' ) => '02',
			),
			'std'         => '01',
		),
		Brook_VC::extra_class_field(),
	),
) );
