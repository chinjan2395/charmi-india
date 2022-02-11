<?php

add_filter( 'vc_autocomplete_tm_product_taxonomies_callback', array(
	'WPBakeryShortCode_TM_Product',
	'autocomplete_taxonomies_field_search',
), 10, 1 );

add_filter( 'vc_autocomplete_tm_product_taxonomies_render', array(
	Brook_VC::instance(),
	'autocomplete_taxonomies_field_render',
), 10, 1 );

add_filter( 'vc_autocomplete_tm_product_filter_by_callback', array(
	'WPBakeryShortCode_TM_Product',
	'autocomplete_taxonomies_field_search',
), 10, 1 );

add_filter( 'vc_autocomplete_tm_product_filter_by_render', array(
	Brook_VC::instance(),
	'autocomplete_taxonomies_field_render',
), 10, 1 );

class WPBakeryShortCode_TM_Product extends WPBakeryShortCode {

	/**
	 * @param $search_string
	 *
	 * @return array|bool
	 */
	function autocomplete_taxonomies_field_search( $search_string ) {
		$data = Brook_VC::instance()->autocomplete_get_data_from_post_type( $search_string, 'product' );

		return $data;
	}

	public function get_inline_css( $selector, $atts ) {
		Brook_VC::get_grid_css( $selector, $atts );

		Brook_VC::get_vc_spacing_css( $selector, $atts );
	}
}

vc_map( array(
	'name'     => esc_html__( 'Product', 'brook' ),
	'base'     => 'tm_product',
	'category' => BROOK_VC_SHORTCODE_CATEGORY,
	'icon'     => 'insight-i insight-i-product',
	'params'   => array_merge( array(
		array(
			'heading'     => esc_html__( 'Product Style', 'brook' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Grid', 'brook' ) => 'grid',
			),
			'std'         => 'grid',
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
				'lg' => '4',
				'md' => '',
				'sm' => '2',
				'xs' => '1',
			),
			'dependency'  => array(
				'element' => 'style',
				'value'   => array( 'grid' ),
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
				),
			),
		),
		Brook_VC::get_animation_field( array( 'std' => 'move-up' ) ),
		Brook_VC::extra_class_field(),
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
			'std'         => 12,
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
	), Brook_VC::get_grid_filter_fields(), Brook_VC::get_grid_pagination_fields(), Brook_VC::get_vc_spacing_tab() ),
) );
