<?php

add_filter( 'vc_autocomplete_tm_portfolio_featured_portfolio_callback', array(
	'WPBakeryShortCode_TM_Portfolio_Featured',
	'autocomplete_field_callback',
), 10, 1 );

add_filter( 'vc_autocomplete_tm_portfolio_featured_portfolio_render', array(
	'WPBakeryShortCode_TM_Portfolio_Featured',
	'autocomplete_field_render',
), 10, 1 );

class WPBakeryShortCode_TM_Portfolio_Featured extends WPBakeryShortCode {
	public function get_inline_css( $selector, $atts ) {
		global $brook_shortcode_lg_css;

		if ( isset( $atts['character_color'] ) && $atts['character_color'] !== '' ) {
			$brook_shortcode_lg_css .= "$selector .post-character { color: {$atts['character_color']}; }";
		}

		if( $atts['style'] ==='02' ) {

			$bg = Brook_Helper::get_shortcode_css_color_inherit( 'background-color', $atts['background_color'], $atts['custom_background_color'], $atts['background_gradient'] );

			$brook_shortcode_lg_css .= "$selector .post-gradient { $bg }";
		}

		Brook_VC::get_vc_spacing_css( $selector, $atts );
	}

	public static function autocomplete_field_render( $term ) {
		$args = array(
			'post_type'      => 'portfolio',
			'posts_per_page' => -1,
			'post_status'    => 'publish',
			'name'           => $term['value'],
			'no_found_rows'  => true,
		);

		$query = new WP_Query( $args );
		$data  = false;
		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) :
				$query->the_post();
				global $post;

				$data = array(
					'label' => get_the_title(),
					'value' => $post->post_name,
				);
			endwhile;
		}

		return $data;
	}

	public static function autocomplete_field_callback( $search_string ) {
		$data = array();
		$args = array(
			'post_type'      => 'portfolio',
			'posts_per_page' => -1,
			'post_status'    => 'publish',
			's'              => $search_string,
			'no_found_rows'  => true,
		);

		$query = new WP_Query( $args );

		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) :
				$query->the_post();
				global $post;

				$data[] = array(
					'label' => get_the_title(),
					'value' => $post->post_name,
				);
			endwhile;
		}

		return $data;
	}
}

vc_map( array(
	'name'     => esc_html__( 'Portfolio Featured', 'brook' ),
	'base'     => 'tm_portfolio_featured',
	'category' => BROOK_VC_SHORTCODE_CATEGORY,
	'icon'     => 'insight-i insight-i-portfoliogrid',
	'params'   => array_merge( array(
		array(
			'heading'     => esc_html__( 'Style', 'brook' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Style 01', 'brook' ) => '01',
				esc_html__( 'Style 02', 'brook' ) => '02',
			),
			'std'         => '01',
		),
		array(
			'heading'     => esc_html__( 'Page', 'brook' ),
			'type'        => 'autocomplete',
			'param_name'  => 'portfolio',
			'admin_label' => true,
		),
		array(
			'heading'    => esc_html__( 'Number', 'brook' ),
			'type'       => 'textfield',
			'param_name' => 'number',
		),
		array(
			'heading'    => esc_html__( 'Highlight Character', 'brook' ),
			'type'       => 'textfield',
			'param_name' => 'character',
			'dependency' => array(
				'element' => 'style',
				'value'   => array( '01' ),
			),
		),
		array(
			'type'       => 'colorpicker',
			'heading'    => esc_html__( 'Character Color', 'brook' ),
			'param_name' => 'character_color',
			'dependency' => array(
				'element' => 'style',
				'value'   => array( '01' ),
			),
		),
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
			'dependency' => array(
				'element' => 'style',
				'value'   => array( '02' ),
			),
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
			'heading'     => esc_html__( 'Custom Image', 'brook' ),
			'description' => esc_html__( 'Leave blank to use portfolio feature image.', 'brook' ),
			'type'        => 'attach_image',
			'param_name'  => 'image',
		),
	), Brook_VC::get_vc_spacing_tab() ),
) );

