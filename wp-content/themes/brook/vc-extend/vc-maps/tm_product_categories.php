<?php

add_filter( 'vc_autocomplete_tm_product_categories_items_category_callback', array(
	'WPBakeryShortCode_TM_Product_Categories',
	'autocomplete_category_field_search',
), 10, 1 );

add_filter( 'vc_autocomplete_tm_product_categories_items_category_render', array(
	'WPBakeryShortCode_TM_Product_Categories',
	'autocomplete_category_field_render',
), 10, 1 );

class WPBakeryShortCode_TM_Product_Categories extends WPBakeryShortCode {

	/**
	 * @param $search_string
	 *
	 * @return array|bool
	 */
	function autocomplete_category_field_search( $search_string ) {
		$terms = get_terms( array(
			'taxonomy'   => 'product_cat',
			'hide_empty' => false,
			'search'     => $search_string,
		) );

		$data = array();
		if ( ! empty( $terms ) || ! is_wp_error( $terms ) ) {
			foreach ( $terms as $term ) {
				$data[] = array(
					'label' => $term->name,
					'value' => $term->slug,
				);
			}
		}

		return $data;
	}

	function autocomplete_category_field_render( $term ) {
		$term = get_term_by( 'slug', $term['value'], 'product_cat' );

		$data = false;
		if ( $term ) {
			$data = array(
				'label' => $term->name,
				'value' => $term->slug,
			);
		}

		return $data;
	}

	public function get_inline_css( $selector, $atts ) {
		Brook_VC::get_vc_spacing_css( $selector, $atts );
	}
}

vc_map( array(
	'name'     => esc_html__( 'Product Categories', 'brook' ),
	'base'     => 'tm_product_categories',
	'category' => BROOK_VC_SHORTCODE_CATEGORY,
	'icon'     => 'insight-i insight-i-product-categories',
	'params'   => array_merge( array(
		array(
			'heading'     => esc_html__( 'Categories Style', 'brook' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Carousel Slider', 'brook' ) => 'carousel',
			),
			'std'         => 'metro',
		),
		Brook_VC::extra_class_field(),
		array(
			'group'      => esc_html__( 'Items', 'brook' ),
			'heading'    => esc_html__( 'Items', 'brook' ),
			'type'       => 'param_group',
			'param_name' => 'items',
			'params'     => array(
				array(
					'heading'            => esc_html__( 'Category', 'brook' ),
					'description'        => esc_html__( 'Enter category name.', 'brook' ),
					'type'               => 'autocomplete',
					'param_name'         => 'category',
					'settings'           => array(
						'multiple'       => false,
						'min_length'     => 1,
						'unique_values'  => true,
						'display_inline' => true,
						'delay'          => 500,
						'auto_focus'     => true,
					),
					'param_holder_class' => 'vc_not-for-custom',
					'admin_label'        => true,
				),
			),
		),
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

	), Brook_VC::get_vc_spacing_tab() ),
) );
