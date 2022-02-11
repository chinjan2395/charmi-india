<?php

class WPBakeryShortCode_TM_Team_Member extends WPBakeryShortCode {

	public function get_inline_css( $selector, $atts ) {
		Brook_VC::get_vc_spacing_css( $selector, $atts );
	}
}

vc_map( array(
	'name'                      => esc_html__( 'Team Member', 'brook' ),
	'base'                      => 'tm_team_member',
	'category'                  => BROOK_VC_SHORTCODE_CATEGORY,
	'allowed_container_element' => 'vc_row',
	'icon'                      => 'insight-i insight-i-member',
	'params'                    => array_merge( array(
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Style', 'brook' ),
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( '01', 'brook' ) => '01',
				esc_html__( '02', 'brook' ) => '02',
				esc_html__( '03', 'brook' ) => '03',
				esc_html__( '04', 'brook' ) => '04',
				esc_html__( '05', 'brook' ) => '05',
			),
			'std'         => '01',
		),
		array(
			'type'        => 'attach_image',
			'heading'     => esc_html__( 'Photo of member', 'brook' ),
			'param_name'  => 'photo',
			'admin_label' => true,
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Name', 'brook' ),
			'admin_label' => true,
			'param_name'  => 'name',
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Position', 'brook' ),
			'param_name'  => 'position',
			'description' => esc_html__( 'Example: CEO/Founder', 'brook' ),
		),
		array(
			'type'       => 'textarea',
			'heading'    => esc_html__( 'Description', 'brook' ),
			'param_name' => 'desc',
		),
		array(
			'type'       => 'textfield',
			'heading'    => esc_html__( 'Profile url', 'brook' ),
			'param_name' => 'profile',
		),
		Brook_VC::get_animation_field(),
		Brook_VC::extra_class_field(),
		array(
			'group'      => esc_html__( 'Social Networks', 'brook' ),
			'heading'    => esc_html__( 'Show tooltip as item title.', 'brook' ),
			'type'       => 'checkbox',
			'param_name' => 'tooltip_enable',
			'value'      => array(
				esc_html__( 'Yes', 'brook' ) => '1',
			),
		),
		array(
			'group'      => esc_html__( 'Social Networks', 'brook' ),
			'heading'    => esc_html__( 'Tooltip Skin', 'brook' ),
			'type'       => 'dropdown',
			'param_name' => 'tooltip_skin',
			'value'      => Brook_VC::get_tooltip_skin_list(),
			'std'        => '',
			'dependency' => array(
				'element' => 'tooltip_enable',
				'value'   => '1',
			),
		),
		array(
			'group'      => esc_html__( 'Social Networks', 'brook' ),
			'heading'    => esc_html__( 'Tooltip Position', 'brook' ),
			'type'       => 'dropdown',
			'param_name' => 'tooltip_position',
			'value'      => array(
				esc_html__( 'Top', 'brook' )    => 'top',
				esc_html__( 'Right', 'brook' )  => 'right',
				esc_html__( 'Bottom', 'brook' ) => 'bottom',
				esc_html__( 'Left', 'brook' )   => 'left',
			),
			'std'        => 'top',
			'dependency' => array(
				'element' => 'tooltip_enable',
				'value'   => '1',
			),
		),
		array(
			'group'      => esc_html__( 'Social Networks', 'brook' ),
			'type'       => 'param_group',
			'heading'    => esc_html__( 'Social Networks', 'brook' ),
			'param_name' => 'social_networks',
			'params'     => array_merge( Brook_VC::icon_libraries( array( 'allow_none' => true ) ), array(
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Link', 'brook' ),
					'param_name'  => 'link',
					'admin_label' => true,
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Title', 'brook' ),
					'param_name'  => 'title',
					'admin_label' => true,
				),
			) ),
			'value'      => rawurlencode( wp_json_encode( array(
				array(
					'link'              => '#',
					'icon_type'         => 'fontawesome5',
					'icon_fontawesome5' => 'fab fa-facebook',
					'title'             => esc_html__( 'Facebook', 'brook' ),
				),
				array(
					'link'              => '#',
					'icon_type'         => 'fontawesome5',
					'icon_fontawesome5' => 'fab fa-twitter',
					'title'             => esc_html__( 'Twitter', 'brook' ),
				),
				array(
					'link'              => '#',
					'icon_type'         => 'fontawesome5',
					'icon_fontawesome5' => 'fab fa-instagram',
					'title'             => esc_html__( 'Instagram', 'brook' ),
				),
			) ) ),
		),
	), Brook_VC::get_vc_spacing_tab() ),
) );
