<?php

add_filter( 'vc_autocomplete_tm_blog_taxonomies_callback', array(
	'WPBakeryShortCode_TM_Blog',
	'autocomplete_taxonomies_field_search',
), 10, 1 );

add_filter( 'vc_autocomplete_tm_blog_taxonomies_render', array(
	Brook_VC::instance(),
	'autocomplete_taxonomies_field_render',
), 10, 1 );

add_filter( 'vc_autocomplete_tm_blog_filter_by_callback', array(
	'WPBakeryShortCode_TM_Blog',
	'autocomplete_taxonomies_field_search',
), 10, 1 );

add_filter( 'vc_autocomplete_tm_blog_filter_by_render', array(
	Brook_VC::instance(),
	'autocomplete_taxonomies_field_render',
), 10, 1 );

class WPBakeryShortCode_TM_Blog extends WPBakeryShortCode {

	/**
	 * @param $search_string
	 *
	 * @return array|bool
	 */
	function autocomplete_taxonomies_field_search( $search_string ) {
		$data = Brook_VC::instance()->autocomplete_get_data_from_post_type( $search_string, 'post' );

		return $data;
	}

	public function get_inline_css( $selector, $atts ) {
		$style = isset( $atts['style'] ) ? $atts['style'] : '';

		if ( in_array( $style, array(
			'grid-classic',
			'grid-classic-02',
			'grid-classic-03',
			'grid-minimal',
			'grid-minimal-faded',
			'grid-minimal-outline',
			'grid-sticky',
			'grid-metro',
			'grid-simple',
			'grid-simple-02',
			'grid-standard',
			'grid-modern',
		), true ) ) {
			Brook_VC::get_grid_css( $selector, $atts );
		}

		Brook_VC::get_vc_spacing_css( $selector, $atts );
	}
}

$carousel_tab = esc_html__( 'Carousel Settings', 'brook' );

vc_map( array(
	'name'     => esc_html__( 'Blog', 'brook' ),
	'base'     => 'tm_blog',
	'category' => BROOK_VC_SHORTCODE_CATEGORY,
	'icon'     => 'insight-i insight-i-blog',
	'params'   => array_merge( array(
		array(
			'heading'     => esc_html__( 'Blog Style', 'brook' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'List Large Image', 'brook' )     => 'list',
				esc_html__( 'List Overlay Image', 'brook' )   => 'list-overlay',
				esc_html__( 'List Creative', 'brook' )        => 'list-creative',
				esc_html__( 'Grid Classic', 'brook' )         => 'grid-classic',
				esc_html__( 'Grid Classic 02', 'brook' )      => 'grid-classic-02',
				esc_html__( 'Grid Classic 03', 'brook' )      => 'grid-classic-03',
				esc_html__( 'Grid Minimal', 'brook' )         => 'grid-minimal',
				esc_html__( 'Grid Minimal Faded', 'brook' )   => 'grid-minimal-faded',
				esc_html__( 'Grid Minimal Outline', 'brook' ) => 'grid-minimal-outline',
				esc_html__( 'Grid Sticky', 'brook' )          => 'grid-sticky',
				esc_html__( 'Grid Masonry', 'brook' )         => 'grid-masonry',
				esc_html__( 'Grid Metro', 'brook' )           => 'grid-metro',
				esc_html__( 'Grid Simple', 'brook' )          => 'grid-simple',
				esc_html__( 'Grid Simple 02', 'brook' )       => 'grid-simple-02',
				esc_html__( 'Grid Standard', 'brook' )        => 'grid-standard',
				esc_html__( 'Grid Modern', 'brook' )          => 'grid-modern',
				esc_html__( 'Carousel Centered', 'brook' )    => 'carousel-centered',
			),
			'std'         => 'list',
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
				'value'   => array( 'grid-metro' ),
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
					'grid-classic',
					'grid-classic-02',
					'grid-classic-03',
					'grid-minimal',
					'grid-minimal-faded',
					'grid-minimal-outline',
					'grid-sticky',
					'grid-masonry',
					'grid-metro',
					'grid-simple',
					'grid-simple-02',
					'grid-standard',
					'grid-modern',
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
					'grid-classic',
					'grid-classic-02',
					'grid-classic-03',
					'grid-minimal',
					'grid-minimal-faded',
					'grid-minimal-outline',
					'grid-sticky',
					'grid-metro',
					'grid-simple',
					'grid-simple-02',
					'grid-standard',
					'grid-modern',
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
					'grid-classic',
					'grid-classic-02',
					'grid-classic-03',
					'grid-minimal',
					'grid-minimal-faded',
					'grid-minimal-outline',
					'grid-sticky',
					'grid-metro',
					'grid-simple',
					'grid-simple-02',
					'grid-standard',
					'grid-modern',
				),
			),
		),
		array(
			'heading'     => esc_html__( 'Grid Gutter', 'brook' ),
			'description' => esc_html__( 'Controls the gutter of grid. Default 30px', 'brook' ),
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
					'grid-masonry',
				),
			),
		),
		Brook_VC::get_animation_field(),
		Brook_VC::extra_class_field(),
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
					'carousel-centered',
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
					'carousel-centered',
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
					'carousel-centered',
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
					'carousel-centered',
				),
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
			'description' => esc_html__( 'Number of items to show per page.', 'brook' ),
			'type'        => 'number',
			'param_name'  => 'number',
			'std'         => 9,
			'min'         => 1,
			'max'         => 100,
			'step'        => 1,
		),
		array(
			'group'              => esc_html__( 'Data Settings', 'brook' ),
			'heading'            => esc_html__( 'Narrow data source', 'brook' ),
			'description'        => esc_html__( 'Enter categories, tags or custom taxonomies.', 'brook' ),
			'admin_label'        => true,
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
	), Brook_VC::get_grid_filter_fields(), Brook_VC::get_grid_pagination_fields(), Brook_VC::get_vc_spacing_tab(), Brook_VC::get_custom_style_tab() ),
) );
