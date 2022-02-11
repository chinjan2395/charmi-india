<?php

class WPBakeryShortCode_TM_Client extends WPBakeryShortCode {

	public function get_inline_css( $selector, $atts ) {
		if ( in_array( $atts['style'], array( 'grid', 'grid-small', 'grid-no-border', 'grid-no-border-small' ) ) ) {

			if ( isset( $atts['gutter'] ) && $atts['gutter'] !== '' ) {
				$atts['column_gutter'] = $atts['gutter'];
				$atts['row_gutter']    = $atts['gutter'];
			}

			Brook_VC::get_grid_css( $selector, $atts );
		}

		Brook_VC::get_vc_spacing_css( $selector, $atts );
	}
}

$slides_tab = esc_html__( 'Slides', 'brook' );

vc_map( array(
	'name'                      => esc_html__( 'Client Logos', 'brook' ),
	'base'                      => 'tm_client',
	'category'                  => BROOK_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-carousel',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'heading'     => esc_html__( 'Style', 'brook' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Carousel', 'brook' )               => 'carousel',
				esc_html__( 'Grid', 'brook' )                   => 'grid',
				esc_html__( 'Grid Small', 'brook' )             => 'grid-small',
				esc_html__( 'Grid No Border', 'brook' )         => 'grid-no-border',
				esc_html__( 'Grid No Border - Small', 'brook' ) => 'grid-no-border-small',
			),
			'std'         => 'carousel',
		),
		array(
			'heading'     => esc_html__( 'Effect', 'brook' ),
			'type'        => 'dropdown',
			'param_name'  => 'effect',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Grayscale', 'brook' ) => 'grayscale',
				esc_html__( 'Move up', 'brook' )   => 'move-up',
			),
			'std'         => 'grayscale',
		),
		array(
			'heading'     => esc_html__( 'Items Display', 'brook' ),
			'type'        => 'number_responsive',
			'param_name'  => 'columns',
			'min'         => 1,
			'max'         => 10,
			'suffix'      => 'item (s)',
			'media_query' => array(
				'lg' => 4,
				'md' => 3,
				'sm' => 2,
				'xs' => 1,
			),
			'dependency'  => array(
				'element' => 'style',
				'value'   => array(
					'grid',
					'grid-small',
					'grid-no-border',
					'grid-no-border-small',
				),
			),
		),
		array(
			'heading'     => esc_html__( 'Items Display', 'brook' ),
			'type'        => 'number_responsive',
			'param_name'  => 'items_display',
			'min'         => 1,
			'max'         => 10,
			'suffix'      => 'item (s)',
			'media_query' => array(
				'lg' => 6,
				'md' => 4,
				'sm' => 3,
				'xs' => 2,
			),
			'dependency'  => array(
				'element' => 'style',
				'value'   => array(
					'carousel',
				),
			),
		),
		array(
			'heading'    => esc_html__( 'Gutter', 'brook' ),
			'type'       => 'number',
			'param_name' => 'gutter',
			'std'        => 30,
			'min'        => 0,
			'max'        => 50,
			'step'       => 1,
			'suffix'     => 'px',
		),
		array(
			'heading'    => esc_html__( 'Loop', 'brook' ),
			'type'       => 'checkbox',
			'param_name' => 'loop',
			'value'      => array( esc_html__( 'Yes', 'brook' ) => '1' ),
			'std'        => '1',
			'dependency' => array(
				'element' => 'style',
				'value'   => array(
					'carousel',
				),
			),
		),
		array(
			'heading'     => esc_html__( 'Auto Play', 'brook' ),
			'description' => esc_html__( 'Delay between transitions (in ms). For e.g: 3000. Leave blank to disabled.', 'brook' ),
			'type'        => 'number',
			'suffix'      => 'ms',
			'param_name'  => 'auto_play',
			'std'         => 5000,
			'dependency'  => array(
				'element' => 'style',
				'value'   => array(
					'carousel',
				),
			),
		),
		array(
			'heading'    => esc_html__( 'Navigation', 'brook' ),
			'type'       => 'dropdown',
			'param_name' => 'carousel_nav',
			'value'      => Brook_VC::get_slider_navs(),
			'std'        => '',
			'dependency' => array(
				'element' => 'style',
				'value'   => array(
					'carousel',
				),
			),
		),
		Brook_VC::extra_id_field( array(
			'heading'    => esc_html__( 'Slider Button ID', 'brook' ),
			'param_name' => 'slider_button_id',
			'dependency' => array(
				'element' => 'carousel_nav',
				'value'   => array(
					'custom',
				),
			),
		) ),
		array(
			'heading'    => esc_html__( 'Pagination', 'brook' ),
			'type'       => 'dropdown',
			'param_name' => 'carousel_pagination',
			'value'      => Brook_VC::get_slider_dots(),
			'std'        => '',
			'dependency' => array(
				'element' => 'style',
				'value'   => array(
					'carousel',
				),
			),
		),
		Brook_VC::extra_class_field(),
		array(
			'group'      => $slides_tab,
			'heading'    => esc_html__( 'Slides', 'brook' ),
			'type'       => 'param_group',
			'param_name' => 'items',
			'params'     => array(
				array(
					'heading'     => esc_html__( 'Image', 'brook' ),
					'type'        => 'attach_image',
					'param_name'  => 'image',
					'admin_label' => true,
				),
				array(
					'heading'     => esc_html__( 'Image Hover', 'brook' ),
					'type'        => 'attach_image',
					'param_name'  => 'image_hover',
					'admin_label' => true,
				),
				array(
					'heading'    => esc_html__( 'Link', 'brook' ),
					'type'       => 'vc_link',
					'param_name' => 'link',
					'value'      => esc_html__( 'Link', 'brook' ),
				),
			),
		),
	), Brook_VC::get_vc_spacing_tab() ),
) );
