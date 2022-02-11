<?php

class WPBakeryShortCode_TM_Grid extends WPBakeryShortCodesContainer {

	public function get_inline_css( $selector, $atts ) {
		global $brook_shortcode_lg_css;
		global $brook_shortcode_md_css;
		global $brook_shortcode_sm_css;
		global $brook_shortcode_xs_css;

		Brook_VC::get_grid_css( $selector, $atts );

		Brook_VC::get_vc_spacing_css( $selector, $atts );

		if ( isset( $atts['max_width'] ) && $atts['max_width'] !== '' ) {
			Brook_VC::get_responsive_css( array(
				'element' => "$selector .tm-grid",
				'atts'    => array(
					'width' => array(
						'media_str' => $atts['max_width'],
						'unit'      => 'px',
					),
				),
			) );
		}

		if ( isset( $atts['item_max_width'] ) && $atts['item_max_width'] !== '' ) {
			Brook_VC::get_responsive_css( array(
				'element' => "$selector .grid-item",
				'atts'    => array(
					'max-width' => array(
						'media_str' => $atts['item_max_width'],
						'unit'      => 'px',
					),
				),
			) );

			if ( isset( $atts['centered_items'] ) && $atts['centered_items'] === '1' ) {
				$brook_shortcode_lg_css .= "$selector .grid-item { margin-left: auto; margin-right: auto; }";
			}
		}

		$tmp = '';

		if ( $atts['align'] === 'left' ) {
			$tmp .= 'justify-content: flex-start';
		} elseif ( $atts['align'] === 'center' ) {
			$tmp .= 'justify-content: center;';
		} elseif ( $atts['align'] === 'right' ) {
			$tmp .= 'justify-content: flex-end;';
		}

		$brook_shortcode_lg_css .= "$selector { $tmp }";

		$tmp = '';
		if ( $atts['md_align'] !== '' ) {

			if ( $atts['md_align'] === 'left' ) {
				$tmp .= 'justify-content: flex-start';
			} elseif ( $atts['md_align'] === 'center' ) {
				$tmp .= 'justify-content: center;';
			} elseif ( $atts['md_align'] === 'right' ) {
				$tmp .= 'justify-content: flex-end;';
			}

			$brook_shortcode_md_css .= "$selector { $tmp }";
		}

		$tmp = '';
		if ( $atts['sm_align'] !== '' ) {

			if ( $atts['sm_align'] === 'left' ) {
				$tmp .= 'justify-content: flex-start';
			} elseif ( $atts['sm_align'] === 'center' ) {
				$tmp .= 'justify-content: center;';
			} elseif ( $atts['sm_align'] === 'right' ) {
				$tmp .= 'justify-content: flex-end;';
			}

			$brook_shortcode_sm_css .= "$selector { $tmp }";
		}

		$tmp = '';
		if ( $atts['xs_align'] !== '' ) {
			if ( $atts['xs_align'] === 'left' ) {
				$tmp .= 'justify-content: flex-start';
			} elseif ( $atts['xs_align'] === 'center' ) {
				$tmp .= 'justify-content: center;';
			} elseif ( $atts['xs_align'] === 'right' ) {
				$tmp .= 'justify-content: flex-end;';
			}

			$brook_shortcode_xs_css .= "$selector { $tmp }";
		}
	}
}

vc_map( array(
	'name'            => esc_html__( 'Grid Anything', 'brook' ),
	'base'            => 'tm_grid',
	'category'        => BROOK_VC_SHORTCODE_CATEGORY,
	'icon'            => 'insight-i insight-i-portfoliogrid',
	'as_parent'       => array( 'only' => array( 'tm_box_icon' ) ),
	'content_element' => true,
	'is_container'    => true,
	'js_view'         => 'VcColumnView',
	'params'          => array_merge( array(
		array(
			'heading'     => esc_html__( 'Style', 'brook' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'None', 'brook' )                   => '',
				esc_html__( 'Square', 'brook' )                 => 'square',
				esc_html__( 'With rounded', 'brook' )           => 'rounded',
				esc_html__( 'With separator', 'brook' )         => 'border',
				esc_html__( 'With separator rounded', 'brook' ) => 'border-rounded',
				esc_html__( 'With dasded separator', 'brook' )  => 'border-dashed',
			),
			'std'         => '',
		),
	), Brook_VC::get_alignment_fields(), array(
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
				'md' => '3',
				'sm' => '2',
				'xs' => '1',
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
		),
		array(
			'heading'     => esc_html__( 'Grid Max Width', 'brook' ),
			'description' => esc_html__( 'Controls the max width of grid', 'brook' ),
			'type'        => 'number_responsive',
			'param_name'  => 'max_width',
			'min'         => 1,
			'max'         => 2000,
			'step'        => 1,
			'suffix'      => 'px',
			'media_query' => array(
				'lg' => '',
				'md' => '',
				'sm' => '',
				'xs' => '',
			),
		),
		array(
			'heading'     => esc_html__( 'Grid Items Max Width', 'brook' ),
			'description' => esc_html__( 'Controls the max width of items', 'brook' ),
			'type'        => 'number_responsive',
			'param_name'  => 'item_max_width',
			'min'         => 1,
			'max'         => 1000,
			'step'        => 1,
			'suffix'      => 'px',
			'media_query' => array(
				'lg' => '',
				'md' => '',
				'sm' => '',
				'xs' => '',
			),
		),
		array(
			'heading'    => esc_html__( 'Centered Items', 'brook' ),
			'type'       => 'checkbox',
			'param_name' => 'centered_items',
			'value'      => array(
				esc_html__( 'Yes', 'brook' ) => '1',
			),
		),
		Brook_VC::get_animation_field( array(
			'std' => 'move-up',
		) ),
		Brook_VC::equal_height_class_field(),
		Brook_VC::extra_class_field(),
	), Brook_VC::get_vc_spacing_tab(), Brook_VC::get_custom_style_tab() ),
) );

