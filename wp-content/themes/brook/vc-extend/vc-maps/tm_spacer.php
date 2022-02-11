<?php

class WPBakeryShortCode_TM_Spacer extends WPBakeryShortCode {

	public function get_inline_css( $selector, $atts ) {
		extract( $atts );

		Brook_VC::get_responsive_css( array(
			'element' => $selector,
			'atts'    => array(
				'height' => array(
					'media_str' => $size,
					'unit'      => 'px',
				),
			),
		) );
	}
}

vc_map( array(
	'name'                      => esc_html__( 'Spacer', 'brook' ),
	'base'                      => 'tm_spacer',
	'category'                  => BROOK_VC_SHORTCODE_CATEGORY,
	'allowed_container_element' => 'vc_row',
	'icon'                      => 'insight-i insight-i-spacer',
	'params'                    => array(
		array(
			'heading'     => esc_html__( 'Spacer Size', 'brook' ),
			'type'        => 'number_responsive',
			'param_name'  => 'size',
			'admin_label' => true,
			'min'         => 0,
			'suffix'      => 'px',
			'media_query' => array(
				'lg' => '10',
				'md' => '',
				'sm' => '',
				'xs' => '',
			),
		),
	),
) );
