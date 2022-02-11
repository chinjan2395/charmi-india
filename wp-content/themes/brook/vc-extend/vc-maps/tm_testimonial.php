<?php

add_filter( 'vc_autocomplete_tm_testimonial_taxonomies_callback', array(
	'WPBakeryShortCode_TM_Testimonial',
	'autocomplete_taxonomies_field_search',
), 10, 1 );

add_filter( 'vc_autocomplete_tm_testimonial_taxonomies_render', array(
	Brook_VC::instance(),
	'autocomplete_taxonomies_field_render',
), 10, 1 );

class WPBakeryShortCode_TM_Testimonial extends WPBakeryShortCode {

	/**
	 * @param $search_string
	 *
	 * @return array|bool
	 */
	public static function autocomplete_taxonomies_field_search( $search_string ) {
		$data = Brook_VC::instance()->autocomplete_get_data_from_post_type( $search_string, 'testimonial' );

		return $data;
	}

	public function get_inline_css( $selector, $atts ) {
		global $brook_shortcode_lg_css;

		$text_tmp    = Brook_Helper::get_shortcode_css_color_inherit( 'color', $atts['text_color'], $atts['custom_text_color'] );
		$name_tmp    = Brook_Helper::get_shortcode_css_color_inherit( 'color', $atts['name_color'], $atts['custom_name_color'] );
		$by_line_tmp = Brook_Helper::get_shortcode_css_color_inherit( 'color', $atts['by_line_color'], $atts['custom_by_line_color'] );

		if ( $text_tmp !== '' ) {
			$brook_shortcode_lg_css .= "$selector .testimonial-desc { $text_tmp }";
		}

		if ( $name_tmp !== '' ) {
			$brook_shortcode_lg_css .= "$selector .testimonial-name { $name_tmp }";
		}

		if ( $by_line_tmp !== '' ) {
			$brook_shortcode_lg_css .= "$selector .testimonial-by-line { $by_line_tmp }";
		}

		Brook_VC::get_vc_spacing_css( $selector, $atts );
	}
}

$carousel_group = esc_html__( 'Slider Options', 'brook' );
$styling_group  = esc_html__( 'Styling', 'brook' );

$slider_styles = array(
	'carousel',
	'carousel-02',
	'carousel-03',
	'carousel-04',
	'carousel-free-mode',
	'modern-slider',
	'modern-slider-02',
	'simple-slider',
	'simple-slider-02',
);

vc_map( array(
	'name'                      => esc_html__( 'Testimonials', 'brook' ),
	'base'                      => 'tm_testimonial',
	'category'                  => BROOK_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-testimonials',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'heading'     => esc_html__( 'Style', 'brook' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Grid', 'brook' )               => 'grid',
				esc_html__( 'Grid 2', 'brook' )             => 'grid-02',
				esc_html__( 'Carousel', 'brook' )           => 'carousel',
				esc_html__( 'Carousel 02', 'brook' )        => 'carousel-02',
				esc_html__( 'Carousel 03', 'brook' )        => 'carousel-03',
				esc_html__( 'Carousel 04', 'brook' )        => 'carousel-04',
				esc_html__( 'Modern Slider', 'brook' )      => 'modern-slider',
				esc_html__( 'Modern Slider 02', 'brook' )   => 'modern-slider-02',
				esc_html__( 'Simple Slider', 'brook' )      => 'simple-slider',
				esc_html__( 'Simple Slider 02', 'brook' )   => 'simple-slider-02',
				esc_html__( 'Carousel Free Mode', 'brook' ) => 'carousel-free-mode',
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
				'lg' => '3',
				'md' => '',
				'sm' => '2',
				'xs' => '1',
			),
			'dependency'  => array(
				'element' => 'style',
				'value'   => array(
					'grid',
					'grid-02',
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
					'grid',
					'grid-02',
				),
			),
		),
		Brook_VC::extra_class_field(),
		array(
			'group'       => esc_html__( 'Data Settings', 'brook' ),
			'heading'     => esc_html__( 'Number', 'brook' ),
			'description' => esc_html__( 'Number of items to show.', 'brook' ),
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
			'group'            => $styling_group,
			'type'             => 'dropdown',
			'heading'          => esc_html__( 'Text Color', 'brook' ),
			'param_name'       => 'text_color',
			'value'            => array(
				esc_html__( 'Default Color', 'brook' )   => '',
				esc_html__( 'Primary Color', 'brook' )   => 'primary',
				esc_html__( 'Secondary Color', 'brook' ) => 'secondary',
				esc_html__( 'Custom Color', 'brook' )    => 'custom',
			),
			'std'              => '',
			'edit_field_class' => 'vc_col-sm-6 col-break',
		),
		array(
			'group'            => $styling_group,
			'type'             => 'colorpicker',
			'heading'          => esc_html__( 'Custom Text Color', 'brook' ),
			'param_name'       => 'custom_text_color',
			'dependency'       => array(
				'element' => 'text_color',
				'value'   => array( 'custom' ),
			),
			'std'              => '#fff',
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'group'            => $styling_group,
			'type'             => 'dropdown',
			'heading'          => esc_html__( 'Name Color', 'brook' ),
			'param_name'       => 'name_color',
			'value'            => array(
				esc_html__( 'Default Color', 'brook' )   => '',
				esc_html__( 'Primary Color', 'brook' )   => 'primary',
				esc_html__( 'Secondary Color', 'brook' ) => 'secondary',
				esc_html__( 'Custom Color', 'brook' )    => 'custom',
			),
			'std'              => '',
			'edit_field_class' => 'vc_col-sm-6 col-break',
		),
		array(
			'group'            => $styling_group,
			'type'             => 'colorpicker',
			'heading'          => esc_html__( 'Custom Name Color', 'brook' ),
			'param_name'       => 'custom_name_color',
			'dependency'       => array(
				'element' => 'name_color',
				'value'   => array( 'custom' ),
			),
			'std'              => '#fff',
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'group'            => $styling_group,
			'type'             => 'dropdown',
			'heading'          => esc_html__( 'By Line Color', 'brook' ),
			'param_name'       => 'by_line_color',
			'value'            => array(
				esc_html__( 'Default Color', 'brook' )   => '',
				esc_html__( 'Primary Color', 'brook' )   => 'primary',
				esc_html__( 'Secondary Color', 'brook' ) => 'secondary',
				esc_html__( 'Custom Color', 'brook' )    => 'custom',
			),
			'std'              => '',
			'edit_field_class' => 'vc_col-sm-6 col-break',
		),
		array(
			'group'            => $styling_group,
			'type'             => 'colorpicker',
			'heading'          => esc_html__( 'Custom By Line Color', 'brook' ),
			'param_name'       => 'custom_by_line_color',
			'dependency'       => array(
				'element' => 'by_line_color',
				'value'   => array( 'custom' ),
			),
			'std'              => '#fff',
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'heading'    => esc_html__( 'Loop', 'brook' ),
			'group'      => $carousel_group,
			'type'       => 'checkbox',
			'param_name' => 'loop',
			'value'      => array( esc_html__( 'Yes', 'brook' ) => '1' ),
			'std'        => '1',
			'dependency' => array(
				'element' => 'style',
				'value'   => $slider_styles,
			),
		),
		array(
			'group'       => $carousel_group,
			'heading'     => esc_html__( 'Auto Play', 'brook' ),
			'description' => esc_html__( 'Delay between transitions (in ms). For e.g: 3000. Leave blank to disabled.', 'brook' ),
			'type'        => 'number',
			'suffix'      => 'ms',
			'param_name'  => 'auto_play',
			'std'         => 5000,
			'dependency'  => array(
				'element' => 'style',
				'value'   => $slider_styles,
			),
		),
		array(
			'group'      => $carousel_group,
			'heading'    => esc_html__( 'Navigation', 'brook' ),
			'type'       => 'dropdown',
			'param_name' => 'nav',
			'value'      => Brook_VC::get_slider_navs(),
			'std'        => '',
			'dependency' => array(
				'element' => 'style',
				'value'   => $slider_styles,
			),
		),
		Brook_VC::extra_id_field( array(
			'group'      => $carousel_group,
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
			'group'      => $carousel_group,
			'heading'    => esc_html__( 'Pagination', 'brook' ),
			'type'       => 'dropdown',
			'param_name' => 'pagination',
			'value'      => Brook_VC::get_slider_dots(),
			'std'        => '',
			'dependency' => array(
				'element' => 'style',
				'value'   => $slider_styles,
			),
		),
		array(
			'group'       => $carousel_group,
			'heading'     => esc_html__( 'Gutter', 'brook' ),
			'type'        => 'number_responsive',
			'param_name'  => 'carousel_gutter',
			'min'         => 0,
			'step'        => 1,
			'suffix'      => 'px',
			'media_query' => array(
				'lg' => 30,
				'md' => '',
				'sm' => '',
				'xs' => '',
			),
			'dependency'  => array(
				'element' => 'style',
				'value'   => $slider_styles,
			),
		),
		array(
			'group'       => $carousel_group,
			'heading'     => esc_html__( 'Items Display', 'brook' ),
			'type'        => 'number_responsive',
			'param_name'  => 'carousel_items_display',
			'min'         => 1,
			'max'         => 10,
			'suffix'      => 'item (s)',
			'media_query' => array(
				'lg' => 3,
				'md' => '',
				'sm' => 2,
				'xs' => 1,
			),
			'dependency'  => array(
				'element' => 'style',
				'value'   => array(
					'carousel',
					'carousel-02',
					'carousel-03',
					'carousel-04',
				),
			),
		),
	), Brook_VC::get_vc_spacing_tab() ),
) );
