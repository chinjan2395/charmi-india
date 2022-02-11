<?php

class WPBakeryShortCode_TM_Instagram extends WPBakeryShortCode {

	public function get_inline_css( $selector, $atts ) {
		global $brook_shortcode_lg_css;

		$tmp = '';

		if ( $atts['rounded'] !== '' ) {
			$tmp .= Brook_Helper::get_css_prefix( 'border-radius', "{$atts['rounded']}px" );
		}

		if ( $tmp !== '' ) {
			$brook_shortcode_lg_css .= "$selector .inner { $tmp }";
		}

		Brook_VC::get_grid_css( $selector, $atts );

		Brook_VC::get_vc_spacing_css( $selector, $atts );
	}
}

$styling_tab = esc_html__( 'Styling', 'brook' );

vc_map( array(
	'name'                      => esc_html__( 'Instagram', 'brook' ),
	'base'                      => 'tm_instagram',
	'category'                  => BROOK_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-instagram',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'heading'     => esc_html__( 'Widget title', 'brook' ),
			'description' => esc_html__( 'What text use as a widget title.', 'brook' ),
			'type'        => 'textfield',
			'param_name'  => 'widget_title',
			'std'         => '',
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Style', 'brook' ),
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Grid', 'brook' ) => 'grid',
			),
			'std'         => 'grid',
		),
		array(
			'heading'    => esc_html__( 'User Name', 'brook' ),
			'type'       => 'textfield',
			'param_name' => 'username',
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Image Size', 'brook' ),
			'param_name'  => 'size',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Thumbnail 150x150', 'brook' )   => 'thumbnail',
				esc_html__( 'Small 240x240', 'brook' )       => 'small',
				esc_html__( 'Small 320x320', 'brook' )       => 'medium',
				esc_html__( 'Large 480x480', 'brook' )       => 'large',
				esc_html__( 'Extra Large 640x640', 'brook' ) => 'extra_large',
				esc_html__( 'Original', 'brook' )            => 'original',
			),
			'std'         => 'large',
		),
		array(
			'heading'    => esc_html__( 'Number of items', 'brook' ),
			'type'       => 'number',
			'param_name' => 'number_items',
			'std'        => '6',
		),
		array(
			'heading'     => esc_html__( 'Columns', 'brook' ),
			'type'        => 'number_responsive',
			'param_name'  => 'columns',
			'min'         => 1,
			'max'         => 10,
			'step'        => 1,
			'suffix'      => 'column (s)',
			'media_query' => array(
				'lg' => 3,
				'md' => '',
				'sm' => '',
				'xs' => '',
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
					'metro',
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
					'metro',
				),
			),
		),
		array(
			'heading'    => esc_html__( 'Show User Name', 'brook' ),
			'type'       => 'checkbox',
			'param_name' => 'show_user_name',
			'value'      => array( esc_html__( 'Yes', 'brook' ) => '1' ),
		),
		array(
			'heading'    => esc_html__( 'Show overlay likes and comments', 'brook' ),
			'type'       => 'checkbox',
			'param_name' => 'overlay',
			'value'      => array( esc_html__( 'Yes', 'brook' ) => '1' ),
		),
		array(
			'heading'    => esc_html__( 'Open links in a new tab.', 'brook' ),
			'type'       => 'checkbox',
			'param_name' => 'link_target',
			'value'      => array(
				esc_html__( 'Yes', 'brook' ) => '1',
			),
			'std'        => '1',
		),
		Brook_VC::extra_class_field(),
		array(
			'group'       => $styling_tab,
			'heading'     => esc_html__( 'Rounded', 'brook' ),
			'description' => esc_html__( 'Controls the rounded of images', 'brook' ),
			'type'        => 'number',
			'param_name'  => 'rounded',
			'min'         => 0,
			'max'         => 100,
			'step'        => 1,
			'suffix'      => 'px',
		),
	), Brook_VC::get_vc_spacing_tab() ),
) );
