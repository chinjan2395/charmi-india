<?php
vc_map_update( 'vc_progress_bar', array(
	'category' => BROOK_VC_SHORTCODE_CATEGORY,
	'icon'     => 'insight-i insight-i-processbar',
) );

vc_remove_param( 'vc_progress_bar', 'bgcolor' );
vc_remove_param( 'vc_progress_bar', 'custombgcolor' );
vc_remove_param( 'vc_progress_bar', 'customtxtcolor' );
vc_remove_param( 'vc_progress_bar', 'values' );
vc_remove_param( 'vc_progress_bar', 'css' );
vc_remove_param( 'vc_progress_bar', 'title' );

$weight = 100;

vc_add_params( 'vc_progress_bar', array_merge( Brook_VC::get_vc_spacing_tab(), array(
	array(
		'heading'    => esc_html__( 'Style', 'brook' ),
		'type'       => 'dropdown',
		'param_name' => 'style',
		'value'      => array(
			esc_html__( '01', 'brook' ) => '1',
			esc_html__( '02', 'brook' ) => '2',
			esc_html__( '03', 'brook' ) => '3',
		),
		'std'        => '1',
		'weight'     => $weight--,
	),
	array(
		'heading'     => esc_html__( 'Bar height', 'brook' ),
		'description' => esc_html__( 'Controls the height of bar.', 'brook' ),
		'type'        => 'number',
		'param_name'  => 'bar_height',
		'std'         => 4,
		'min'         => 1,
		'max'         => 50,
		'step'        => 1,
		'suffix'      => 'px',
		'weight'      => $weight--,
	),
	array(
		'heading'    => esc_html__( 'Background Color', 'brook' ),
		'type'       => 'dropdown',
		'param_name' => 'background_color',
		'value'      => array(
			esc_html__( 'Default Color', 'brook' )   => '',
			esc_html__( 'Primary Color', 'brook' )   => 'primary',
			esc_html__( 'Secondary Color', 'brook' ) => 'secondary',
			esc_html__( 'Custom Color', 'brook' )    => 'custom',
		),
		'std'        => '',
		'weight'     => $weight--,
	),
	array(
		'heading'    => esc_html__( 'Custom Background Color', 'brook' ),
		'type'       => 'colorpicker',
		'param_name' => 'custom_background_color',
		'dependency' => array(
			'element' => 'background_color',
			'value'   => array( 'custom' ),
		),
		'std'        => '#222',
		'weight'     => $weight--,
	),
	array(
		'heading'    => esc_html__( 'Track Color', 'brook' ),
		'type'       => 'dropdown',
		'param_name' => 'track_color',
		'value'      => array(
			esc_html__( 'Default Color', 'brook' )   => '',
			esc_html__( 'Primary Color', 'brook' )   => 'primary',
			esc_html__( 'Secondary Color', 'brook' ) => 'secondary',
			esc_html__( 'Custom Color', 'brook' )    => 'custom',
		),
		'std'        => '',
		'weight'     => $weight--,
	),
	array(
		'heading'    => esc_html__( 'Custom Track Color', 'brook' ),
		'type'       => 'colorpicker',
		'param_name' => 'custom_track_color',
		'dependency' => array(
			'element' => 'track_color',
			'value'   => array( 'custom' ),
		),
		'std'        => '#ededed',
		'weight'     => $weight--,
	),
	array(
		'heading'    => esc_html__( 'Text Color', 'brook' ),
		'type'       => 'dropdown',
		'param_name' => 'text_color',
		'value'      => array(
			esc_html__( 'Default Color', 'brook' )   => '',
			esc_html__( 'Primary Color', 'brook' )   => 'primary',
			esc_html__( 'Secondary Color', 'brook' ) => 'secondary',
			esc_html__( 'Custom Color', 'brook' )    => 'custom',
		),
		'std'        => '',
		'weight'     => $weight--,
	),
	array(
		'heading'    => esc_html__( 'Custom Text Color', 'brook' ),
		'type'       => 'colorpicker',
		'param_name' => 'custom_text_color',
		'dependency' => array(
			'element' => 'text_color',
			'value'   => array( 'custom' ),
		),
		'std'        => '#333',
		'weight'     => $weight--,
	),
	array(
		'heading'    => esc_html__( 'Units Color', 'brook' ),
		'type'       => 'dropdown',
		'param_name' => 'units_color',
		'value'      => array(
			esc_html__( 'Default Color', 'brook' )   => '',
			esc_html__( 'Primary Color', 'brook' )   => 'primary',
			esc_html__( 'Secondary Color', 'brook' ) => 'secondary',
			esc_html__( 'Custom Color', 'brook' )    => 'custom',
		),
		'std'        => '',
		'weight'     => $weight--,
	),
	array(
		'heading'    => esc_html__( 'Custom Units Color', 'brook' ),
		'type'       => 'colorpicker',
		'param_name' => 'custom_units_color',
		'dependency' => array(
			'element' => 'units_color',
			'value'   => array( 'custom' ),
		),
		'std'        => '#333',
		'weight'     => $weight--,
	),
	array(
		'group'       => esc_html__( 'Items', 'brook' ),
		'type'        => 'param_group',
		'heading'     => esc_html__( 'Values', 'brook' ),
		'param_name'  => 'values',
		'description' => esc_html__( 'Enter values for graph - value, title and color.', 'brook' ),
		'value'       => rawurlencode( wp_json_encode( array(
			array(
				'label' => esc_html__( 'Development', 'brook' ),
				'value' => '90',
			),
			array(
				'label' => esc_html__( 'Design', 'brook' ),
				'value' => '80',
			),
			array(
				'label' => esc_html__( 'Marketing', 'brook' ),
				'value' => '70',
			),
		) ) ),
		'params'      => array(
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Label', 'brook' ),
				'param_name'  => 'label',
				'description' => esc_html__( 'Enter text used as title of bar.', 'brook' ),
				'admin_label' => true,
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Value', 'brook' ),
				'param_name'  => 'value',
				'description' => esc_html__( 'Enter value of bar.', 'brook' ),
				'admin_label' => true,
			),
			array(
				'heading'    => esc_html__( 'Background Color', 'brook' ),
				'type'       => 'dropdown',
				'param_name' => 'background_color',
				'value'      => array(
					esc_html__( 'Default', 'brook' )         => '',
					esc_html__( 'Primary Color', 'brook' )   => 'primary',
					esc_html__( 'Secondary Color', 'brook' ) => 'secondary',
					esc_html__( 'Custom Color', 'brook' )    => 'custom',
				),
				'std'        => '',
			),
			array(
				'heading'    => esc_html__( 'Custom Background Color', 'brook' ),
				'type'       => 'colorpicker',
				'param_name' => 'custom_background_color',
				'dependency' => array(
					'element' => 'background_color',
					'value'   => array( 'custom' ),
				),
				'std'        => '#222',
			),
			array(
				'heading'    => esc_html__( 'Track Color', 'brook' ),
				'type'       => 'dropdown',
				'param_name' => 'track_color',
				'value'      => array(
					esc_html__( 'Default', 'brook' )         => '',
					esc_html__( 'Primary Color', 'brook' )   => 'primary',
					esc_html__( 'Secondary Color', 'brook' ) => 'secondary',
					esc_html__( 'Custom Color', 'brook' )    => 'custom',
				),
				'std'        => '',
			),
			array(
				'heading'    => esc_html__( 'Custom Track Color', 'brook' ),
				'type'       => 'colorpicker',
				'param_name' => 'custom_track_color',
				'dependency' => array(
					'element' => 'track_color',
					'value'   => array( 'custom' ),
				),
				'std'        => '#ededed',
			),
			array(
				'heading'    => esc_html__( 'Text Color', 'brook' ),
				'type'       => 'dropdown',
				'param_name' => 'text_color',
				'value'      => array(
					esc_html__( 'Default', 'brook' )         => '',
					esc_html__( 'Primary Color', 'brook' )   => 'primary',
					esc_html__( 'Secondary Color', 'brook' ) => 'secondary',
					esc_html__( 'Custom Color', 'brook' )    => 'custom',
				),
				'std'        => '',
			),
			array(
				'heading'    => esc_html__( 'Custom Text Color', 'brook' ),
				'type'       => 'colorpicker',
				'param_name' => 'custom_text_color',
				'dependency' => array(
					'element' => 'text_color',
					'value'   => array( 'custom' ),
				),
				'std'        => '#333',
			),
		),
	),
) ) );
