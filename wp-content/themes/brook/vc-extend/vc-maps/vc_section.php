<?php
$styling_tab = esc_html__( 'Styling', 'brook' );

vc_remove_param( 'vc_section', 'css' );

vc_add_params( 'vc_section', array_merge( Brook_VC::get_vc_spacing_tab(), array(
	array(
		'group'       => $styling_tab,
		'heading'     => esc_html__( 'Border Radius', 'brook' ),
		'description' => esc_html__( 'For e.g: 5px or 50%', 'brook' ),
		'type'        => 'textfield',
		'param_name'  => 'border_radius',
	),
	array(
		'group'       => $styling_tab,
		'heading'     => esc_html__( 'Box Shadow', 'brook' ),
		'description' => esc_html__( 'For e.g: 0 20px 30px #ccc', 'brook' ),
		'type'        => 'textfield',
		'param_name'  => 'box_shadow',
	),
	array(
		'group'      => $styling_tab,
		'heading'    => esc_html__( 'Background Color', 'brook' ),
		'type'       => 'dropdown',
		'param_name' => 'background_color',
		'value'      => array(
			esc_html__( 'None', 'brook' )            => '',
			esc_html__( 'Primary Color', 'brook' )   => 'primary',
			esc_html__( 'Secondary Color', 'brook' ) => 'secondary',
			esc_html__( 'Custom Color', 'brook' )    => 'custom',
			esc_html__( 'Gradient Color', 'brook' )  => 'gradient',
		),
		'std'        => '',
	),
	array(
		'group'      => $styling_tab,
		'heading'    => esc_html__( 'Custom Background Color', 'brook' ),
		'type'       => 'colorpicker',
		'param_name' => 'custom_background_color',
		'dependency' => array(
			'element' => 'background_color',
			'value'   => array( 'custom' ),
		),
	),
	array(
		'group'      => $styling_tab,
		'heading'    => esc_html__( 'Background Gradient', 'brook' ),
		'type'       => 'gradient',
		'param_name' => 'background_gradient',
		'dependency' => array(
			'element' => 'background_color',
			'value'   => array( 'gradient' ),
		),
	),
	array(
		'group'      => $styling_tab,
		'heading'    => esc_html__( 'Background Image', 'brook' ),
		'type'       => 'attach_image',
		'param_name' => 'background_image',
	),
	array(
		'group'      => $styling_tab,
		'heading'    => esc_html__( 'Hide Background Image', 'brook' ),
		'type'       => 'dropdown',
		'param_name' => 'hide_background_image',
		'value'      => array(
			esc_html__( 'Always show', 'brook' )             => '',
			esc_html__( 'Medium Device Down', 'brook' )      => 'md',
			esc_html__( 'Small Device Down', 'brook' )       => 'sm',
			esc_html__( 'Extra Small Device Down', 'brook' ) => 'xs',
		),
		'std'        => '',
		'dependency' => array(
			'element'   => 'background_image',
			'not_empty' => true,
		),
	),
	array(
		'group'      => $styling_tab,
		'heading'    => esc_html__( 'Background Repeat', 'brook' ),
		'type'       => 'dropdown',
		'param_name' => 'background_repeat',
		'value'      => array(
			esc_html__( 'No repeat', 'brook' )         => 'no-repeat',
			esc_html__( 'Tile', 'brook' )              => 'repeat',
			esc_html__( 'Tile Horizontally', 'brook' ) => 'repeat-x',
			esc_html__( 'Tile Vertically', 'brook' )   => 'repeat-y',
		),
		'std'        => 'no-repeat',
		'dependency' => array(
			'element'   => 'background_image',
			'not_empty' => true,
		),
	),
	array(
		'group'      => $styling_tab,
		'heading'    => esc_html__( 'Background Size', 'brook' ),
		'type'       => 'dropdown',
		'param_name' => 'background_size',
		'value'      => array(
			esc_html__( 'Auto', 'brook' )    => 'auto',
			esc_html__( 'Cover', 'brook' )   => 'cover',
			esc_html__( 'Contain', 'brook' ) => 'contain',
			esc_html__( 'Manual', 'brook' )  => 'manual',
		),
		'std'        => 'cover',
		'dependency' => array(
			'element'   => 'background_image',
			'not_empty' => true,
		),
	),
	array(
		'group'       => $styling_tab,
		'heading'     => esc_html__( 'Background Size (Manual Setting)', 'brook' ),
		'description' => esc_html__( 'For e.g: 50% 100%', 'brook' ),
		'type'        => 'textfield',
		'param_name'  => 'background_size_manual',
		'dependency'  => array(
			'element' => 'background_size',
			'value'   => 'manual',
		),
	),
	array(
		'group'       => $styling_tab,
		'heading'     => esc_html__( 'Background Position', 'brook' ),
		'description' => esc_html__( 'For e.g: left center', 'brook' ),
		'type'        => 'textfield',
		'param_name'  => 'background_position',
		'dependency'  => array(
			'element'   => 'background_image',
			'not_empty' => true,
		),
	),
	array(
		'group'      => $styling_tab,
		'heading'    => esc_html__( 'Scroll Effect', 'brook' ),
		'type'       => 'dropdown',
		'param_name' => 'background_attachment',
		'value'      => array(
			esc_html__( 'Move with the content', 'brook' ) => 'scroll',
			esc_html__( 'Fixed at its position', 'brook' ) => 'fixed',
			esc_html__( 'Marque', 'brook' )                => 'marque',
		),
		'std'        => 'scroll',
		'dependency' => array(
			'element'   => 'background_image',
			'not_empty' => true,
		),
	),
	array(
		'group'      => $styling_tab,
		'heading'    => esc_html__( 'Marque Direction', 'brook' ),
		'type'       => 'dropdown',
		'param_name' => 'marque_direction',
		'value'      => array(
			esc_html__( 'To Left', 'brook' )  => 'to-left',
			esc_html__( 'To Right', 'brook' ) => 'to-right',
		),
		'std'        => 'to-right',
		'dependency' => array(
			'element' => 'background_attachment',
			'value'   => 'marque',
		),
	),
	array(
		'group'      => $styling_tab,
		'heading'    => esc_html__( 'Marque Pause On Hover.', 'brook' ),
		'type'       => 'checkbox',
		'param_name' => 'marque_pause_on_hover',
		'value'      => array(
			esc_html__( 'Yes', 'brook' ) => '1',
		),
		'dependency' => array(
			'element' => 'background_attachment',
			'value'   => 'marque',
		),
	),
	array(
		'group'       => $styling_tab,
		'heading'     => esc_html__( 'Background Overlay', 'brook' ),
		'description' => esc_html__( 'Choose an overlay background color.', 'brook' ),
		'type'        => 'dropdown',
		'param_name'  => 'overlay_background',
		'value'       => array(
			esc_html__( 'None', 'brook' )            => '',
			esc_html__( 'Primary Color', 'brook' )   => 'primary',
			esc_html__( 'Secondary Color', 'brook' ) => 'secondary',
			esc_html__( 'Gradient Color', 'brook' )  => 'gradient',
			esc_html__( 'Custom Color', 'brook' )    => 'custom',
		),
	),
	array(
		'group'       => $styling_tab,
		'heading'     => esc_html__( 'Custom Background Overlay', 'brook' ),
		'description' => esc_html__( 'Choose an custom background color overlay.', 'brook' ),
		'type'        => 'colorpicker',
		'param_name'  => 'overlay_custom_background',
		'std'         => '#000000',
		'dependency'  => array(
			'element' => 'overlay_background',
			'value'   => array( 'custom' ),
		),
	),
	array(
		'group'      => $styling_tab,
		'heading'    => esc_html__( 'Background Gradient Overlay', 'brook' ),
		'type'       => 'gradient',
		'param_name' => 'overlay_gradient_background',
		'dependency' => array(
			'element' => 'overlay_background',
			'value'   => array( 'gradient' ),
		),
	),
	array(
		'group'      => $styling_tab,
		'heading'    => esc_html__( 'Opacity', 'brook' ),
		'type'       => 'number',
		'param_name' => 'overlay_opacity',
		'value'      => 100,
		'min'        => 0,
		'max'        => 100,
		'step'       => 1,
		'suffix'     => '%',
		'std'        => 80,
		'dependency' => array(
			'element'   => 'overlay_background',
			'not_empty' => true,
		),
	),
	array(
		'group'       => esc_html__( 'Scrolling Effect', 'brook' ),
		'heading'     => esc_html__( 'Background Color', 'brook' ),
		'description' => esc_html__( 'Choose background color for site when scrolling to this row.', 'brook' ),
		'type'        => 'colorpicker',
		'param_name'  => 'scrolling_color',
		'std'         => '',
	),
) ) );
