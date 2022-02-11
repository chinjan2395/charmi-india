<?php

class WPBakeryShortCode_TM_Timeline extends WPBakeryShortCode {

	public function get_inline_css( $selector, $atts ) {
		Brook_VC::get_vc_spacing_css( $selector, $atts );
	}
}

vc_map( array(
	'name'                      => esc_html__( 'Timeline', 'brook' ),
	'base'                      => 'tm_timeline',
	'category'                  => BROOK_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-timeline',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
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
		array(
			'heading'     => esc_html__( 'Skin', 'brook' ),
			'type'        => 'dropdown',
			'param_name'  => 'skin',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Dark', 'brook' )  => 'dark',
				esc_html__( 'Light', 'brook' ) => 'light',
			),
			'std'         => 'dark',
		),
		Brook_VC::extra_class_field(),
		Brook_VC::extra_id_field(),
		array(
			'group'      => esc_html__( 'Items', 'brook' ),
			'heading'    => esc_html__( 'Items', 'brook' ),
			'type'       => 'param_group',
			'param_name' => 'items',
			'params'     => array(
				array(
					'heading'    => esc_html__( 'Image', 'brook' ),
					'type'       => 'attach_image',
					'param_name' => 'image',
				),
				array(
					'heading'     => esc_html__( 'Title', 'brook' ),
					'type'        => 'textfield',
					'param_name'  => 'title',
					'admin_label' => true,
				),
				array(
					'heading'     => esc_html__( 'Date Time', 'brook' ),
					'description' => esc_html__( 'Date and time format (yyyy/mm/dd hh:mm).', 'brook' ),
					'type'        => 'datetimepicker',
					'param_name'  => 'datetime',
					'value'       => '',
					'admin_label' => true,
				),
				array(
					'heading'    => esc_html__( 'Text', 'brook' ),
					'type'       => 'textarea',
					'param_name' => 'text',
				),
			),
		),
	), Brook_VC::get_vc_spacing_tab(), Brook_VC::get_custom_style_tab() ),
) );
