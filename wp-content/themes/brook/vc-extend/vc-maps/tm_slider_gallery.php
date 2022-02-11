<?php

class WPBakeryShortCode_TM_Slider_Gallery extends WPBakeryShortCode {

	public function get_inline_css( $selector, $atts ) {
		if ( isset( $atts['carousel_height'] ) && $atts['carousel_height'] !== '' ) {
			Brook_VC::get_responsive_css( array(
				'element' => "$selector .swiper-slide img",
				'atts'    => array(
					'height' => array(
						'media_str' => $atts['carousel_height'],
						'unit'      => 'px',
					),
				),
			) );
		}

		Brook_VC::get_vc_spacing_css( $selector, $atts );
	}
}

$styling_tab = esc_html__( 'Styling', 'brook' );

vc_map( array(
	'name'                      => esc_html__( 'Slider Gallery', 'brook' ),
	'base'                      => 'tm_slider_gallery',
	'category'                  => BROOK_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-carousel',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'heading'     => esc_html__( 'Style', 'brook' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'value'       => array(
				esc_html__( 'Normal', 'brook' )                 => '',
				esc_html__( 'Carousel Centered', 'brook' )      => 'carousel-centered',
				esc_html__( 'Carousel Auto Wide', 'brook' )     => 'carousel-auto-wide',
				esc_html__( 'Full Wide - Left Image', 'brook' ) => 'full-wide-left-image',
			),
			'admin_label' => true,
			'std'         => '',
		),
		array(
			'heading'     => esc_html__( 'Shadow Style', 'brook' ),
			'type'        => 'dropdown',
			'param_name'  => 'shadow',
			'value'       => array(
				esc_html__( 'None', 'brook' )       => '',
				esc_html__( 'Big Shadow', 'brook' ) => 'big-shadow',
			),
			'admin_label' => true,
			'std'         => '',
		),
		array(
			'heading'     => esc_html__( 'Image', 'brook' ),
			'type'        => 'attach_images',
			'param_name'  => 'images',
			'admin_label' => true,
		),
		array(
			'heading'    => esc_html__( 'Image Size', 'brook' ),
			'type'       => 'dropdown',
			'param_name' => 'image_size',
			'value'      => array(
				esc_html__( 'Default By Style', 'brook' )    => '',
				esc_html__( 'Custom', 'brook' )              => 'custom',
				esc_html__( 'Full', 'brook' )                => 'full',
				esc_html__( '1170x600 (1 Column)', 'brook' ) => '1170x600',
				esc_html__( '500x338 (3 Columns)', 'brook' ) => '500x338',
				esc_html__( '900x678 (3 Columns)', 'brook' ) => '900x678',
			),
			'std'        => '',
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
			'heading'    => esc_html__( 'Lightbox Enable', 'brook' ),
			'type'       => 'checkbox',
			'param_name' => 'lightbox_enable',
			'value'      => array( esc_html__( 'Yes', 'brook' ) => '1' ),
		),
		array(
			'heading'    => esc_html__( 'Auto Height', 'brook' ),
			'type'       => 'checkbox',
			'param_name' => 'auto_height',
			'value'      => array( esc_html__( 'Yes', 'brook' ) => '1' ),
			'std'        => '1',
		),
		array(
			'heading'     => esc_html__( 'Items Height', 'brook' ),
			'type'        => 'number_responsive',
			'param_name'  => 'carousel_height',
			'min'         => 100,
			'max'         => 1000,
			'suffix'      => 'px',
			'media_query' => array(
				'lg' => 678,
				'md' => 440,
				'sm' => '',
				'xs' => 320,
			),
			'dependency'  => array(
				'element' => 'style',
				'value'   => array(
					'carousel-centered',
					'carousel-auto-wide',
				),
			),
		),
		array(
			'heading'    => esc_html__( 'Loop', 'brook' ),
			'type'       => 'checkbox',
			'param_name' => 'loop',
			'value'      => array( esc_html__( 'Yes', 'brook' ) => '1' ),
			'std'        => '1',
		),
		array(
			'heading'     => esc_html__( 'Auto Play', 'brook' ),
			'description' => esc_html__( 'Delay between transitions (in ms). For e.g: 3000. Leave blank to disabled.', 'brook' ),
			'type'        => 'number',
			'suffix'      => 'ms',
			'param_name'  => 'auto_play',
		),
		array(
			'heading'    => esc_html__( 'Equal Height', 'brook' ),
			'type'       => 'checkbox',
			'param_name' => 'equal_height',
			'value'      => array( esc_html__( 'Yes', 'brook' ) => '1' ),
		),
		array(
			'heading'    => esc_html__( 'Vertically Center', 'brook' ),
			'type'       => 'checkbox',
			'param_name' => 'v_center',
			'value'      => array( esc_html__( 'Yes', 'brook' ) => '1' ),
		),
		array(
			'heading'    => esc_html__( 'Horizontal Center', 'brook' ),
			'type'       => 'checkbox',
			'param_name' => 'h_center',
			'value'      => array( esc_html__( 'Yes', 'brook' ) => '1' ),
		),
		array(
			'heading'    => esc_html__( 'Navigation', 'brook' ),
			'type'       => 'dropdown',
			'param_name' => 'nav',
			'value'      => Brook_VC::get_slider_navs(),
			'std'        => '',
		),
		Brook_VC::extra_id_field( array(
			'heading'    => esc_html__( 'Slider Button ID', 'brook' ),
			'param_name' => 'slider_button_id',
			'dependency' => array(
				'element' => 'nav',
				'value'   => array(
					'custom',
				),
			),
		) ),
		array(
			'heading'    => esc_html__( 'Pagination', 'brook' ),
			'type'       => 'dropdown',
			'param_name' => 'pagination',
			'value'      => Brook_VC::get_slider_dots(),
			'std'        => '',
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
			'heading'     => esc_html__( 'Items Display', 'brook' ),
			'type'        => 'number_responsive',
			'param_name'  => 'items_display',
			'min'         => 1,
			'max'         => 10,
			'suffix'      => 'item (s)',
			'media_query' => array(
				'lg' => 3,
				'md' => 3,
				'sm' => 2,
				'xs' => 1,
			),
			'dependency'  => array(
				'element'            => 'style',
				'value_not_equal_to' => array( 'carousel-auto-wide' ),
			),
		),
		array(
			'heading'    => esc_html__( 'Full-width Image', 'brook' ),
			'type'       => 'checkbox',
			'param_name' => 'fw_image',
			'value'      => array( esc_html__( 'Yes', 'brook' ) => '1' ),
			'dependency' => array(
				'element'            => 'style',
				'value_not_equal_to' => array( 'carousel-auto-wide' ),
			),
		),
		Brook_VC::extra_class_field(),
	), Brook_VC::get_vc_spacing_tab() ),
) );
