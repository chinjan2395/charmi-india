<?php
vc_update_shortcode_param( 'vc_tta_section', array(
	'param_name' => 'i_type',
	'value'      => array(
		esc_html__( 'Font Awesome 5', 'brook' ) => 'fontawesome5',
	),
) );

vc_update_shortcode_param( 'vc_tta_section', array(
	'param_name' => 'el_class',
	'weight'     => -1,
) );

vc_remove_param( 'vc_tta_section', 'i_icon_openiconic' );
vc_remove_param( 'vc_tta_section', 'i_icon_typicons' );
vc_remove_param( 'vc_tta_section', 'i_icon_entypo' );
vc_remove_param( 'vc_tta_section', 'i_icon_linecons' );
vc_remove_param( 'vc_tta_section', 'i_icon_monosocial' );
vc_remove_param( 'vc_tta_section', 'i_icon_material' );

vc_add_params( 'vc_tta_section', array(
	array(
		'type'        => 'iconpicker',
		'heading'     => esc_html__( 'Icon', 'brook' ),
		'param_name'  => 'i_icon_fontawesome5',
		'value'       => 'fa fa-adjust',
		'settings'    => array(
			'emptyIcon'    => false,
			'type'         => 'fontawesome5',
			'iconsPerPage' => 300,
		),
		'dependency'  => array(
			'element' => 'i_type',
			'value'   => 'fontawesome5',
		),
		'description' => esc_html__( 'Select icon from library.', 'brook' ),
	),
) );
