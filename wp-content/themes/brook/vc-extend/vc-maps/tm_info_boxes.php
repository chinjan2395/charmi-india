<?php

class WPBakeryShortCode_TM_Info_Boxes extends WPBakeryShortCode {

	public function get_inline_css( $selector, $atts ) {
		Brook_VC::get_grid_css( $selector, $atts );
		Brook_VC::get_vc_spacing_css( $selector, $atts );
	}
}

$carousel_group = esc_html__( 'Carousel Settings', 'brook' );

vc_map( array(
	'name'     => esc_html__( 'Info Boxes', 'brook' ),
	'base'     => 'tm_info_boxes',
	'category' => BROOK_VC_SHORTCODE_CATEGORY,
	'icon'     => 'insight-i insight-i-info-boxes',
	'params'   => array_merge( array(
		array(
			'heading'     => esc_html__( 'Info Boxes Style', 'brook' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Grid Metro', 'brook' ) => 'metro',
			),
			'std'         => 'metro',
		),
		array(
			'heading'    => esc_html__( 'Metro Layout', 'brook' ),
			'type'       => 'param_group',
			'param_name' => 'metro_layout',
			'params'     => array(
				array(
					'heading'     => esc_html__( 'Item Size', 'brook' ),
					'type'        => 'dropdown',
					'param_name'  => 'size',
					'admin_label' => true,
					'value'       => array(
						esc_html__( 'Width 1 - Height 1', 'brook' ) => '1:1',
						esc_html__( 'Width 1 - Height 2', 'brook' ) => '1:2',
						esc_html__( 'Width 2 - Height 1', 'brook' ) => '2:1',
						esc_html__( 'Width 2 - Height 2', 'brook' ) => '2:2',
					),
					'std'         => '1:1',
				),
			),
			'value'      => rawurlencode( wp_json_encode( array(
				array(
					'size' => '2:1',
				),
				array(
					'size' => '1:1',
				),
				array(
					'size' => '1:1',
				),
				array(
					'size' => '1:1',
				),
				array(
					'size' => '1:1',
				),
				array(
					'size' => '2:1',
				),
			) ) ),
			'dependency' => array(
				'element' => 'style',
				'value'   => array( 'metro' ),
			),
		),
		array(
			'heading'     => esc_html__( 'Columns', 'brook' ),
			'type'        => 'number_responsive',
			'param_name'  => 'columns',
			'min'         => 1,
			'max'         => 6,
			'step'        => 1,
			'suffix'      => '',
			'media_query' => array(
				'lg' => '3',
				'md' => '',
				'sm' => '2',
				'xs' => '1',
			),
			'dependency'  => array(
				'element' => 'style',
				'value'   => array( 'metro' ),
			),
		),
		array(
			'heading'     => esc_html__( 'Grid Gutter', 'brook' ),
			'description' => esc_html__( 'Controls the gutter of grid.', 'brook' ),
			'type'        => 'number',
			'param_name'  => 'gutter',
			'std'         => 0,
			'min'         => 0,
			'max'         => 100,
			'step'        => 2,
			'suffix'      => 'px',
			'dependency'  => array(
				'element' => 'style',
				'value'   => array( 'metro' ),
			),
		),
		Brook_VC::get_animation_field(),
		Brook_VC::extra_class_field(),
		array(

			'group'      => esc_html__( 'Items', 'brook' ),
			'heading'    => esc_html__( 'Items', 'brook' ),
			'type'       => 'param_group',
			'param_name' => 'items',
			'params'     => array_merge( array(
				array(
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
					'heading'    => esc_html__( 'Custom Background Color', 'brook' ),
					'type'       => 'colorpicker',
					'param_name' => 'custom_background_color',
					'dependency' => array(
						'element' => 'background_color',
						'value'   => array( 'custom' ),
					),
				),
				array(
					'heading'    => esc_html__( 'Background Gradient', 'brook' ),
					'type'       => 'gradient',
					'param_name' => 'background_gradient',
					'dependency' => array(
						'element' => 'background_color',
						'value'   => array( 'gradient' ),
					),
				),
				array(
					'heading'     => esc_html__( 'Background Image', 'brook' ),
					'type'        => 'attach_image',
					'param_name'  => 'image',
					'admin_label' => true,
				),
				array(
					'heading'     => esc_html__( 'Title', 'brook' ),
					'type'        => 'textfield',
					'param_name'  => 'title',
					'admin_label' => true,
				),
				array(
					'heading'    => esc_html__( 'Text', 'brook' ),
					'type'       => 'textarea',
					'param_name' => 'text',
				),
				array(
					'heading'    => esc_html__( 'Button', 'brook' ),
					'type'       => 'vc_link',
					'param_name' => 'button',
				),
				array(
					'heading'    => esc_html__( 'Icon Color', 'brook' ),
					'type'       => 'colorpicker',
					'param_name' => 'icon_color',
				),
				array(
					'heading'    => esc_html__( 'Heading Color', 'brook' ),
					'type'       => 'colorpicker',
					'param_name' => 'heading_color',
				),
				array(
					'heading'    => esc_html__( 'Text Color', 'brook' ),
					'type'       => 'colorpicker',
					'param_name' => 'text_color',
				),
				array(
					'heading'    => esc_html__( 'Button Text Color', 'brook' ),
					'type'       => 'colorpicker',
					'param_name' => 'button_text_color',
				),
				array(
					'heading'    => esc_html__( 'Button Background Color', 'brook' ),
					'type'       => 'colorpicker',
					'param_name' => 'button_background_color',
				),
			), Brook_VC::icon_libraries( array(
				'allow_none' => true,
				'group'      => '',
			) ) ),
		),
	), Brook_VC::get_vc_spacing_tab() ),
) );

