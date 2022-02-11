<?php

class WPBakeryShortCode_TM_Gallery extends WPBakeryShortCode {

	public function get_inline_css( $selector, $atts ) {
		global $brook_shortcode_lg_css;
		$image_tmp = '';

		if ( isset( $atts['image_rounded'] ) && $atts['image_rounded'] !== '' ) {
			$image_tmp .= Brook_Helper::get_css_prefix( 'border-radius', $atts['image_rounded'] );
		}

		if ( $image_tmp !== '' ) {
			$brook_shortcode_lg_css .= "$selector .grid-item { {$image_tmp} }";
		}

		Brook_VC::get_grid_css( $selector, $atts );

		Brook_VC::get_vc_spacing_css( $selector, $atts );
	}
}

$styling_tab = esc_html__( 'Styling', 'brook' );

vc_map( array(
	'name'     => esc_html__( 'Gallery', 'brook' ),
	'base'     => 'tm_gallery',
	'category' => BROOK_VC_SHORTCODE_CATEGORY,
	'icon'     => 'insight-i insight-i-gallery',
	'params'   => array_merge( array(
		array(
			'heading'    => esc_html__( 'Images', 'brook' ),
			'type'       => 'attach_images',
			'param_name' => 'images',
		),
		array(
			'heading'     => esc_html__( 'Gallery Style', 'brook' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Grid Classic', 'brook' )    => 'grid',
				esc_html__( 'Grid Metro', 'brook' )      => 'metro',
				esc_html__( 'Grid Metro 02', 'brook' )   => 'metro-02',
				esc_html__( 'Grid Masonry', 'brook' )    => 'masonry',
				esc_html__( 'Justify Gallery', 'brook' ) => 'justified',
			),
			'std'         => 'grid',
		),
		array(
			'heading'    => esc_html__( 'Image Size', 'brook' ),
			'type'       => 'dropdown',
			'param_name' => 'image_size',
			'value'      => array(
				esc_attr( '480x480' )           => '480x480',
				esc_attr( '370x250' )           => '370x250',
				esc_attr( '570x385' )           => '570x385',
				esc_attr__( 'Custom', 'brook' ) => 'custom',
			),
			'std'        => '480x480',
			'dependency' => array(
				'element' => 'style',
				'value'   => array(
					'grid',
				),
			),
		),
		array(
			'heading'          => esc_html__( 'Image Width', 'brook' ),
			'type'             => 'number',
			'param_name'       => 'image_size_width',
			'min'              => 0,
			'max'              => 1920,
			'step'             => 10,
			'suffix'           => 'px',
			'dependency'       => array(
				'element' => 'image_size',
				'value'   => array( 'custom' ),
			),
			'edit_field_class' => 'vc_col-sm-6 col-break',
		),
		array(
			'heading'          => esc_html__( 'Image Height', 'brook' ),
			'type'             => 'number',
			'param_name'       => 'image_size_height',
			'min'              => 0,
			'max'              => 1920,
			'step'             => 10,
			'suffix'           => 'px',
			'dependency'       => array(
				'element' => 'image_size',
				'value'   => array( 'custom' ),
			),
			'edit_field_class' => 'vc_col-sm-6',
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
					'size' => '2:2',
				),
				array(
					'size' => '1:1',
				),
				array(
					'size' => '1:1',
				),
				array(
					'size' => '2:2',
				),
				array(
					'size' => '1:1',
				),
				array(
					'size' => '1:1',
				),
			) ) ),
			'dependency' => array(
				'element' => 'style',
				'value'   => array( 'metro', 'metro-02' ),
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
				'value'   => array(
					'grid',
					'metro',
					'metro-02',
					'masonry',
				),
			),
		),
		array(
			'heading'     => esc_html__( 'Gutter', 'brook' ),
			'description' => esc_html__( 'Controls the gutter of grid columns.', 'brook' ),
			'type'        => 'number',
			'param_name'  => 'gutter',
			'std'         => 30,
			'min'         => 0,
			'max'         => 100,
			'step'        => 1,
			'suffix'      => 'px',
			'dependency'  => array(
				'element' => 'style',
				'value'   => array(
					'masonry',
					'justified',
				),
			),
		),
		array(
			'heading'     => esc_html__( 'Columns Gutter', 'brook' ),
			'type'        => 'number_responsive',
			'param_name'  => 'column_gutter',
			'min'         => 0,
			'max'         => 100,
			'step'        => 1,
			'suffix'      => 'px',
			'media_query' => array(
				'lg' => '',
				'md' => '',
				'sm' => '',
				'xs' => '',
			),
			'dependency'  => array(
				'element' => 'style',
				'value'   => array(
					'grid',
					'metro',
					'metro-02',
				),
			),
		),
		array(
			'heading'     => esc_html__( 'Row Gutter', 'brook' ),
			'type'        => 'number_responsive',
			'param_name'  => 'row_gutter',
			'min'         => 0,
			'max'         => 200,
			'step'        => 1,
			'suffix'      => 'px',
			'media_query' => array(
				'lg' => '',
				'md' => '',
				'sm' => '',
				'xs' => '',
			),
			'dependency'  => array(
				'element' => 'style',
				'value'   => array(
					'grid',
					'metro',
					'metro-02',
				),
			),
		),
		array(
			'heading'     => esc_html__( 'Row Height', 'brook' ),
			'description' => esc_html__( 'Controls the height of grid row.', 'brook' ),
			'type'        => 'number',
			'param_name'  => 'justify_row_height',
			'std'         => 300,
			'min'         => 50,
			'max'         => 500,
			'step'        => 10,
			'suffix'      => 'px',
			'dependency'  => array(
				'element' => 'style',
				'value'   => array( 'justified' ),
			),
		),
		array(
			'heading'     => esc_html__( 'Max Row Height', 'brook' ),
			'description' => esc_html__( 'Controls the max height of grid row. Leave blank or 0 keep it disabled.', 'brook' ),
			'type'        => 'number',
			'param_name'  => 'justify_max_row_height',
			'std'         => 0,
			'min'         => 0,
			'max'         => 500,
			'step'        => 10,
			'suffix'      => 'px',
			'dependency'  => array(
				'element' => 'style',
				'value'   => array( 'justified' ),
			),
		),
		array(
			'heading'    => esc_html__( 'Last row alignment', 'brook' ),
			'type'       => 'dropdown',
			'param_name' => 'justify_last_row_alignment',
			'value'      => array(
				esc_html__( 'Justify', 'brook' )                              => 'justify',
				esc_html__( 'Left', 'brook' )                                 => 'nojustify',
				esc_html__( 'Center', 'brook' )                               => 'center',
				esc_html__( 'Right', 'brook' )                                => 'right',
				esc_html__( 'Hide ( if row can not be justified )', 'brook' ) => 'hide',
			),
			'std'        => 'justify',
			'dependency' => array(
				'element' => 'style',
				'value'   => array( 'justified' ),
			),
		),
		Brook_VC::get_animation_field( array(
			'std'        => 'move-up',
			'dependency' => array(
				'element' => 'style',
				'value'   => array(
					'grid',
					'metro',
					'metro-02',
					'masonry',
					'justified',
				),
			),
		) ),
		Brook_VC::extra_class_field(),
		array(
			'group'       => $styling_tab,
			'heading'     => esc_html__( 'Image Rounded', 'brook' ),
			'type'        => 'textfield',
			'param_name'  => 'image_rounded',
			'description' => esc_html__( 'Input a valid radius. For e.g: 10px. Leave blank to use default.', 'brook' ),
		),
	), Brook_VC::get_vc_spacing_tab(), Brook_VC::get_custom_style_tab() ),
) );

