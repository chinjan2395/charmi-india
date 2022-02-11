<?php

class WPBakeryShortCode_TM_List extends WPBakeryShortCode {

	public function get_inline_css( $selector, $atts ) {
		global $brook_shortcode_lg_css;
		global $brook_shortcode_md_css;
		global $brook_shortcode_sm_css;
		global $brook_shortcode_xs_css;

		$marker_tmp  = Brook_Helper::get_shortcode_css_color_inherit( 'color', $atts['marker_color'], $atts['custom_marker_color'] );
		$marker_tmp  .= Brook_Helper::get_shortcode_css_color_inherit( 'background-color', $atts['marker_background_color'], $atts['custom_marker_background_color'] );
		$heading_tmp = Brook_Helper::get_shortcode_css_color_inherit( 'color', $atts['title_color'], $atts['custom_title_color'] );
		$text_tmp    = Brook_Helper::get_shortcode_css_color_inherit( 'color', $atts['desc_color'], $atts['custom_desc_color'] );

		if ( $marker_tmp !== '' ) {
			$brook_shortcode_lg_css .= "$selector .marker { $marker_tmp }";
		}

		if ( $heading_tmp !== '' ) {
			$brook_shortcode_lg_css .= "$selector .title { $heading_tmp }";
		}

		if ( $text_tmp !== '' ) {
			$brook_shortcode_lg_css .= "$selector .desc { $text_tmp }";
		}

		if ( isset( $atts['columns'] ) && $atts['columns'] !== '' ) {
			$arr = explode( ';', $atts['columns'] );
			foreach ( $arr as $value ) {
				$tmp = explode( ':', $value );

				switch ( $tmp[0] ) {
					case 'sm' :
						$brook_shortcode_sm_css .= "$selector { grid-template-columns: repeat({$tmp[1]}, 1fr); }";
						break;
					case 'md' :
						$brook_shortcode_md_css .= "$selector { grid-template-columns: repeat({$tmp[1]}, 1fr); }";
						break;
					case 'xs' :
						$brook_shortcode_xs_css .= "$selector { grid-template-columns: repeat({$tmp[1]}, 1fr); }";
						break;
					case 'lg' :
						$brook_shortcode_lg_css .= "$selector { grid-template-columns: repeat({$tmp[1]}, 1fr); }";
						break;
				}
			}
		}

		Brook_VC::get_responsive_css( array(
			'element' => "$selector .title",
			'atts'    => array(
				'font-size' => array(
					'media_str' => $atts['heading_font_size'],
					'unit'      => 'px',
				),
			),
		) );

		Brook_VC::get_vc_spacing_css( $selector, $atts );
	}
}

$styling_tab = esc_html__( 'Styling', 'brook' );

vc_map( array(
	'name'                      => esc_html__( 'List', 'brook' ),
	'base'                      => 'tm_list',
	'category'                  => BROOK_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-list',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'heading'     => esc_html__( 'Widget title', 'brook' ),
			'description' => esc_html__( 'What text use as a widget title.', 'brook' ),
			'type'        => 'textfield',
			'param_name'  => 'widget_title',
		),
		array(
			'heading'     => esc_html__( 'List Style', 'brook' ),
			'type'        => 'dropdown',
			'param_name'  => 'list_style',
			'value'       => array(
				esc_html__( 'Circle List', 'brook' )                  => 'circle',
				esc_html__( 'Check List', 'brook' )                   => 'check',
				esc_html__( 'Check List 02', 'brook' )                => 'check-02',
				esc_html__( 'Icon List', 'brook' )                    => 'icon',
				esc_html__( 'Icon List 02', 'brook' )                 => 'icon-02',
				esc_html__( 'Modern Icon List', 'brook' )             => 'modern-icon',
				esc_html__( '(Automatic) Numbered List 01', 'brook' ) => 'auto-numbered-01',
				esc_html__( '(Automatic) Numbered List 02', 'brook' ) => 'auto-numbered-02',
				esc_html__( '(Manual) Numbered List 01', 'brook' )    => 'manual-numbered-01',
				esc_html__( '(Manual) Numbered List 02', 'brook' )    => 'manual-numbered-02',
			),
			'admin_label' => true,
			'std'         => 'icon',
		),
		array(
			'heading'     => esc_html__( 'Columns', 'brook' ),
			'type'        => 'number_responsive',
			'param_name'  => 'columns',
			'min'         => 1,
			'max'         => 10,
			'suffix'      => 'item (s)',
			'media_query' => array(
				'lg' => 1,
				'md' => '',
				'sm' => '',
				'xs' => 1,
			),
		),
		array(
			'group'            => $styling_tab,
			'heading'          => esc_html__( 'Marker Color', 'brook' ),
			'type'             => 'dropdown',
			'param_name'       => 'marker_color',
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
			'group'            => $styling_tab,
			'heading'          => esc_html__( 'Custom Marker Color', 'brook' ),
			'type'             => 'colorpicker',
			'param_name'       => 'custom_marker_color',
			'dependency'       => array(
				'element' => 'marker_color',
				'value'   => array( 'custom' ),
			),
			'std'              => '#fff',
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'group'            => $styling_tab,
			'heading'          => esc_html__( 'Marker Background Color', 'brook' ),
			'type'             => 'dropdown',
			'param_name'       => 'marker_background_color',
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
			'group'            => $styling_tab,
			'heading'          => esc_html__( 'Custom Marker Background Color', 'brook' ),
			'type'             => 'colorpicker',
			'param_name'       => 'custom_marker_background_color',
			'dependency'       => array(
				'element' => 'marker_background_color',
				'value'   => array( 'custom' ),
			),
			'std'              => '#fff',
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'group'            => $styling_tab,
			'heading'          => esc_html__( 'Title Color', 'brook' ),
			'type'             => 'dropdown',
			'param_name'       => 'title_color',
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
			'group'            => $styling_tab,
			'heading'          => esc_html__( 'Custom Title Color', 'brook' ),
			'type'             => 'colorpicker',
			'param_name'       => 'custom_title_color',
			'dependency'       => array(
				'element' => 'title_color',
				'value'   => array( 'custom' ),
			),
			'std'              => '#fff',
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'group'            => $styling_tab,
			'heading'          => esc_html__( 'Description Color', 'brook' ),
			'type'             => 'dropdown',
			'param_name'       => 'desc_color',
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
			'group'            => $styling_tab,
			'heading'          => esc_html__( 'Custom Description Color', 'brook' ),
			'type'             => 'colorpicker',
			'param_name'       => 'custom_desc_color',
			'dependency'       => array(
				'element' => 'desc_color',
				'value'   => array( 'custom' ),
			),
			'std'              => '#fff',
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'group'       => $styling_tab,
			'heading'     => esc_html__( 'Heading Font Size', 'brook' ),
			'type'        => 'number_responsive',
			'param_name'  => 'heading_font_size',
			'min'         => 8,
			'suffix'      => 'px',
			'media_query' => array(
				'lg' => '',
				'md' => '',
				'sm' => '',
				'xs' => '',
			),
		),
	),

		Brook_VC::icon_libraries( array(
			'allow_none' => true,
			'group'      => '',
			'dependency' => array(
				'element' => 'list_style',
				'value'   => array(
					'icon',
					'icon-02',
					'modern-icon',
				),
			),
		) ), array(
			Brook_VC::get_animation_field(),
			Brook_VC::extra_class_field(),
			array(
				'group'      => esc_html__( 'Items', 'brook' ),
				'heading'    => esc_html__( 'Items', 'brook' ),
				'type'       => 'param_group',
				'param_name' => 'items',
				'params'     => array(
					array(
						'heading'     => esc_html__( 'Number', 'brook' ),
						'type'        => 'textfield',
						'param_name'  => 'item_number',
						'admin_label' => true,
						'description' => esc_html__( 'Only work with List Type: (Manual) Numbered list.', 'brook' ),
					),
					array(
						'heading'     => esc_html__( 'Title', 'brook' ),
						'type'        => 'textfield',
						'param_name'  => 'item_title',
						'admin_label' => true,
					),
					array(
						'heading'    => esc_html__( 'Sub Title', 'brook' ),
						'type'       => 'textfield',
						'param_name' => 'item_sub_title',
					),
					array(
						'heading'    => esc_html__( 'Link', 'brook' ),
						'type'       => 'vc_link',
						'param_name' => 'link',
					),
					array(
						'heading'    => esc_html__( 'Description', 'brook' ),
						'type'       => 'textarea',
						'param_name' => 'item_desc',
					),
					array(
						'type'       => 'iconpicker',
						'heading'    => esc_html__( 'Icon', 'brook' ),
						'param_name' => 'icon',
						'settings'   => array(
							'emptyIcon'    => true,
							'type'         => 'fontawesome5',
							'iconsPerPage' => 300,
						),
					),
				),
			),

		), Brook_VC::get_vc_spacing_tab() ),
) );
