<?php

add_filter( 'vc_autocomplete_tm_portfolio_taxonomies_callback', array(
	'WPBakeryShortCode_TM_Portfolio',
	'autocomplete_taxonomies_field_search',
), 10, 1 );

add_filter( 'vc_autocomplete_tm_portfolio_taxonomies_render', array(
	Brook_VC::instance(),
	'autocomplete_taxonomies_field_render',
), 10, 1 );

add_filter( 'vc_autocomplete_tm_portfolio_filter_by_callback', array(
	'WPBakeryShortCode_TM_Portfolio',
	'autocomplete_taxonomies_field_search',
), 10, 1 );

add_filter( 'vc_autocomplete_tm_portfolio_filter_by_render', array(
	Brook_VC::instance(),
	'autocomplete_taxonomies_field_render',
), 10, 1 );

class WPBakeryShortCode_TM_Portfolio extends WPBakeryShortCode {

	/**
	 * @param $search_string
	 *
	 * @return array|bool
	 */
	public static function autocomplete_taxonomies_field_search( $search_string ) {
		$data = Brook_VC::instance()->autocomplete_get_data_from_post_type( $search_string, 'portfolio' );

		return $data;
	}

	public function get_inline_css( $selector, $atts ) {
		global $brook_shortcode_lg_css;
		global $brook_shortcode_md_css;
		global $brook_shortcode_sm_css;
		global $brook_shortcode_xs_css;
		extract( $atts );

		$style = isset( $atts['style'] ) ? $atts['style'] : '';

		if ( in_array( $style, array(
			'grid',
			'grid-caption',
			'grid-caption-video-popup',
			'metro',
			'metro-02',
			'metro-with-caption',
		), true ) ) {
			Brook_VC::get_grid_css( $selector, $atts );
		}

		if ( isset( $atts['carousel_height'] ) && $atts['carousel_height'] !== '' ) {
			$arr = explode( ';', $atts['carousel_height'] );

			foreach ( $arr as $value ) {
				$tmp = explode( ':', $value );
				if ( $tmp['0'] === 'lg' ) {
					$brook_shortcode_lg_css .= "$selector .swiper-slide img { height: {$tmp['1']}px; }";
				} elseif ( $tmp['0'] === 'md' ) {
					$brook_shortcode_md_css .= "$selector .swiper-slide img { height: {$tmp['1']}px; }";
				} elseif ( $tmp['0'] === 'sm' ) {
					$brook_shortcode_sm_css .= "$selector .swiper-slide img { height: {$tmp['1']}px; }";
				} elseif ( $tmp['0'] === 'xs' ) {
					$brook_shortcode_xs_css .= "$selector .swiper-slide img { height: {$tmp['1']}px; }";
				}
			}
		}

		$image_tmp = '';

		if ( isset( $atts['text_align'] ) ) {
			$brook_shortcode_lg_css .= "$selector .post-info { text-align: {$atts['text_align']}; }";
		}

		if ( $custom_styling_enable === '1' ) {
			Brook_VC::get_responsive_css( array(
				'element' => "$selector .post-overlay-title",
				'atts'    => array(
					'font-size' => array(
						'media_str' => $overlay_title_font_size,
						'unit'      => 'px',
					),
				),
			) );

			if ( isset( $atts['image_rounded'] ) && $atts['image_rounded'] !== '' ) {
				$image_tmp .= Brook_Helper::get_css_prefix( 'border-radius', $atts['image_rounded'] );
			}
		}

		if ( $image_tmp !== '' ) {
			$brook_shortcode_lg_css .= "$selector .post-thumbnail img { {$image_tmp} }";
		}

		Brook_VC::get_vc_spacing_css( $selector, $atts );
	}
}

$carousel_tab = esc_html__( 'Carousel Settings', 'brook' );
$styling_tab  = esc_html__( 'Styling', 'brook' );

vc_map( array(
	'name'     => esc_html__( 'Portfolio', 'brook' ),
	'base'     => 'tm_portfolio',
	'category' => BROOK_VC_SHORTCODE_CATEGORY,
	'icon'     => 'insight-i insight-i-portfoliogrid',
	'params'   => array_merge( array(
		array(
			'heading'     => esc_html__( 'Portfolio Style', 'brook' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Grid Classic', 'brook' )                    => 'grid',
				esc_html__( 'Grid With Caption', 'brook' )               => 'grid-caption',
				esc_html__( 'Grid With Caption - Video Popup', 'brook' ) => 'grid-caption-video-popup',
				esc_html__( 'Grid Metro', 'brook' )                      => 'metro',
				esc_html__( 'Grid Metro 02', 'brook' )                   => 'metro-02',
				esc_html__( 'Grid Metro With Caption', 'brook' )         => 'metro-with-caption',
				esc_html__( 'Grid Masonry', 'brook' )                    => 'masonry',
				esc_html__( 'Grid Masonry Caption', 'brook' )            => 'masonry-with-caption',
				esc_html__( 'Grid Justify Gallery', 'brook' )            => 'justified',
				esc_html__( 'Carousel Slider', 'brook' )                 => 'carousel',
				esc_html__( 'Carousel Auto Wide Slider', 'brook' )       => 'carousel-auto-wide',
				esc_html__( 'Carousel Auto Wide Slider 02', 'brook' )    => 'carousel-auto-wide-02',
				esc_html__( 'Carousel Auto Wide Large Slider', 'brook' ) => 'carousel-auto-wide-large',
				esc_html__( 'Fullscreen Slider', 'brook' )               => 'fullscreen-slider',
				esc_html__( 'Fullscreen Slider 02', 'brook' )            => 'fullscreen-slider-02',
			),
			'std'         => 'grid',
		),
		array(
			'heading'    => esc_html__( 'Text Align', 'brook' ),
			'type'       => 'dropdown',
			'param_name' => 'text_align',
			'value'      => array(
				esc_html__( 'Left', 'brook' )   => 'left',
				esc_html__( 'Center', 'brook' ) => 'center',
				esc_html__( 'Right', 'brook' )  => 'right',
			),
			'std'        => 'left',
			'dependency' => array(
				'element' => 'style',
				'value'   => array(
					'grid-caption',
					'grid-caption-video-popup',
				),
			),
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
					'size' => '1:1',
				),
				array(
					'size' => '2:2',
				),
				array(
					'size' => '1:2',
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
				array(
					'size' => '1:1',
				),
			) ) ),
			'dependency' => array(
				'element' => 'style',
				'value'   => array(
					'metro',
					'metro-02',
					'metro-with-caption',
				),
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
					'grid-caption',
					'grid-caption-video-popup',
					'metro',
					'metro-02',
					'metro-with-caption',
					'masonry',
					'masonry-with-caption',
				),
			),
		),
		array(
			'heading'     => esc_html__( 'Grid Gutter', 'brook' ),
			'description' => esc_html__( 'Controls the gutter of grid.', 'brook' ),
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
					'masonry-with-caption',
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
					'grid-caption',
					'grid-caption-video-popup',
					'metro',
					'metro-02',
					'metro-with-caption',
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
					'grid-caption',
					'grid-caption-video-popup',
					'metro',
					'metro-02',
					'metro-with-caption',
				),
			),
		),
		array(
			'heading'    => esc_html__( 'Image Size', 'brook' ),
			'type'       => 'dropdown',
			'param_name' => 'image_size',
			'value'      => array(
				esc_attr__( 'Default by style', 'brook' ) => '',
				esc_attr( '480x480' )                     => '480x480',
				esc_attr( '481x325' )                     => '481x325',
			),
			'std'        => '',
			'dependency' => array(
				'element' => 'style',
				'value'   => array(
					'grid',
					'grid-caption',
					'grid-caption-video-popup',
				),
			),
		),
		array(
			'heading'     => esc_html__( 'Image Size Width', 'brook' ),
			'description' => esc_html__( 'Controls the width of image that you want to crop. Leave blank to use default: 480px.', 'brook' ),
			'type'        => 'number',
			'param_name'  => 'masonry_image_size_width',
			'std'         => '',
			'min'         => 1,
			'max'         => 2000,
			'step'        => 10,
			'suffix'      => 'px',
			'dependency'  => array(
				'element' => 'style',
				'value'   => array( 'masonry', 'masonry-with-caption', 'metro' ),
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
		array(
			'heading'    => esc_html__( 'Overlay Style', 'brook' ),
			'type'       => 'dropdown',
			'param_name' => 'overlay_style',
			'value'      => array(
				esc_html__( 'None', 'brook' )     => '',
				esc_html__( 'Faded', 'brook' )    => 'faded',
				esc_html__( 'Faded 02', 'brook' ) => 'faded-02',
				esc_html__( 'Faded 03', 'brook' ) => 'faded-03',
				esc_html__( 'Faded 04', 'brook' ) => 'faded-04',
				esc_html__( 'Faded 05', 'brook' ) => 'faded-05',
				esc_html__( 'Caption', 'brook' )  => 'caption',
				esc_html__( 'Parallax', 'brook' ) => 'parallax',
			),
			'std'        => '',
			'dependency' => array(
				'element' => 'style',
				'value'   => array(
					'grid',
					'metro',
					'metro-02',
					'masonry',
					'masonry-with-caption',
					'carousel',
					'justified',
					'carousel-auto-wide-02',
				),
			),
		),
		Brook_VC::get_animation_field( array(
			'std'        => 'move-up',
			'dependency' => array(
				'element' => 'style',
				'value'   => array(
					'grid',
					'grid-caption',
					'grid-caption-video-popup',
					'metro',
					'metro-02',
					'metro-with-caption',
					'masonry',
					'masonry-with-caption',
					'justified',
				),
			),
		) ),
		Brook_VC::extra_class_field(),
		Brook_VC::extra_id_field(),
		array(
			'group'       => $carousel_tab,
			'heading'     => esc_html__( 'Auto Play', 'brook' ),
			'description' => esc_html__( 'Delay between transitions (in ms). For e.g: 3000. Leave blank to disabled.', 'brook' ),
			'type'        => 'number',
			'suffix'      => 'ms',
			'param_name'  => 'carousel_auto_play',
			'dependency'  => array(
				'element' => 'style',
				'value'   => array(
					'carousel',
					'carousel-auto-wide',
					'carousel-auto-wide-02',
					'carousel-auto-wide-large',
					'fullscreen-slider',
					'fullscreen-slider-02',
				),
			),
		),
		array(
			'group'      => $carousel_tab,
			'heading'    => esc_html__( 'Navigation', 'brook' ),
			'type'       => 'dropdown',
			'param_name' => 'carousel_nav',
			'value'      => Brook_VC::get_slider_navs(),
			'std'        => '',
			'dependency' => array(
				'element' => 'style',
				'value'   => array(
					'carousel',
					'carousel-auto-wide',
					'carousel-auto-wide-02',
					'carousel-auto-wide-large',
					'fullscreen-slider',
					'fullscreen-slider-02',
				),
			),
		),
		Brook_VC::extra_id_field( array(
			'group'      => $carousel_tab,
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
			'group'      => $carousel_tab,
			'heading'    => esc_html__( 'Pagination', 'brook' ),
			'type'       => 'dropdown',
			'param_name' => 'carousel_pagination',
			'value'      => Brook_VC::get_slider_dots(),
			'std'        => '',
			'dependency' => array(
				'element' => 'style',
				'value'   => array(
					'carousel',
					'carousel-auto-wide',
					'carousel-auto-wide-02',
					'carousel-auto-wide-large',
					'fullscreen-slider',
					'fullscreen-slider-02',
				),
			),
		),
		array(
			'group'      => $carousel_tab,
			'heading'    => esc_html__( 'Gutter', 'brook' ),
			'type'       => 'number',
			'param_name' => 'carousel_gutter',
			'std'        => 30,
			'min'        => 0,
			'max'        => 50,
			'step'       => 1,
			'suffix'     => 'px',
			'dependency' => array(
				'element' => 'style',
				'value'   => array(
					'carousel',
					'carousel-auto-wide',
					'carousel-auto-wide-02',
					'carousel-auto-wide-large',
					'fullscreen-slider-02',
				),
			),
		),
		array(
			'group'       => $carousel_tab,
			'heading'     => esc_html__( 'Items Display', 'brook' ),
			'type'        => 'number_responsive',
			'param_name'  => 'carousel_items_display',
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
				'element' => 'style',
				'value'   => 'carousel',
			),
		),
		array(
			'group'      => esc_html__( 'Data Settings', 'brook' ),
			'type'       => 'hidden',
			'param_name' => 'main_query',
			'std'        => '',
		),
		array(
			'group'       => esc_html__( 'Data Settings', 'brook' ),
			'heading'     => esc_html__( 'Items per page', 'brook' ),
			'description' => esc_html__( 'Number of items to show per page. Leave blank to use default option.', 'brook' ),
			'type'        => 'number',
			'param_name'  => 'number',
			'std'         => '',
			'min'         => 1,
			'max'         => 100,
			'step'        => 1,
		),
		array(
			'group'              => esc_html__( 'Data Settings', 'brook' ),
			'heading'            => esc_html__( 'Narrow data source', 'brook' ),
			'description'        => esc_html__( 'Enter categories, tags or custom taxonomies.', 'brook' ),
			'type'               => 'autocomplete',
			'param_name'         => 'taxonomies',
			'settings'           => array(
				'multiple'       => true,
				'min_length'     => 1,
				'groups'         => true,
				'unique_values'  => true,
				'display_inline' => true,
				'delay'          => 500,
				'auto_focus'     => true,
			),
			'param_holder_class' => 'vc_not-for-custom',
		),
		array(
			'group'       => esc_html__( 'Data Settings', 'brook' ),
			'heading'     => esc_html__( 'Order by', 'brook' ),
			'type'        => 'dropdown',
			'param_name'  => 'orderby',
			'value'       => array(
				esc_html__( 'Date', 'brook' )                  => 'date',
				esc_html__( 'Post ID', 'brook' )               => 'ID',
				esc_html__( 'Author', 'brook' )                => 'author',
				esc_html__( 'Title', 'brook' )                 => 'title',
				esc_html__( 'Last modified date', 'brook' )    => 'modified',
				esc_html__( 'Post/page parent ID', 'brook' )   => 'parent',
				esc_html__( 'Number of comments', 'brook' )    => 'comment_count',
				esc_html__( 'Menu order/Page Order', 'brook' ) => 'menu_order',
				esc_html__( 'Meta value', 'brook' )            => 'meta_value',
				esc_html__( 'Meta value number', 'brook' )     => 'meta_value_num',
				esc_html__( 'Random order', 'brook' )          => 'rand',
			),
			'description' => esc_html__( 'Select order type. If "Meta value" or "Meta value Number" is chosen then meta key is required.', 'brook' ),
			'std'         => 'date',
		),
		array(
			'group'       => esc_html__( 'Data Settings', 'brook' ),
			'heading'     => esc_html__( 'Sort order', 'brook' ),
			'type'        => 'dropdown',
			'param_name'  => 'order',
			'value'       => array(
				esc_html__( 'Descending', 'brook' ) => 'DESC',
				esc_html__( 'Ascending', 'brook' )  => 'ASC',
			),
			'description' => esc_html__( 'Select sorting order.', 'brook' ),
			'std'         => 'DESC',
		),
		array(
			'group'       => esc_html__( 'Data Settings', 'brook' ),
			'heading'     => esc_html__( 'Meta key', 'brook' ),
			'description' => esc_html__( 'Input meta key for grid ordering.', 'brook' ),
			'type'        => 'textfield',
			'param_name'  => 'meta_key',
			'dependency'  => array(
				'element' => 'orderby',
				'value'   => array(
					'meta_value',
					'meta_value_num',
				),
			),
		),
		array(
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Custom Styling Enable', 'brook' ),
			'type'       => 'checkbox',
			'param_name' => 'custom_styling_enable',
			'value'      => array( esc_html__( 'Yes', 'brook' ) => '1' ),
		),
		array(
			'group'       => $styling_tab,
			'heading'     => esc_html__( 'Overlay Title Font Size', 'brook' ),
			'type'        => 'number_responsive',
			'param_name'  => 'overlay_title_font_size',
			'min'         => 8,
			'suffix'      => 'px',
			'media_query' => array(
				'lg' => '',
				'md' => '',
				'sm' => '',
				'xs' => '',
			),
		),
		array(
			'group'       => $styling_tab,
			'heading'     => esc_html__( 'Image Rounded', 'brook' ),
			'type'        => 'textfield',
			'param_name'  => 'image_rounded',
			'description' => esc_html__( 'Input a valid radius. For e.g: 10px. Leave blank to use default.', 'brook' ),
		),
	), Brook_VC::get_grid_filter_fields(), Brook_VC::get_grid_pagination_fields(), Brook_VC::get_vc_spacing_tab() ),
) );

