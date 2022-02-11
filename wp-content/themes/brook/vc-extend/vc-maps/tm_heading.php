<?php

class WPBakeryShortCode_TM_Heading extends WPBakeryShortCode {

	/**
	 * Defines fields names for google_fonts, font_container and etc
	 *
	 * @since 4.4
	 * @var array
	 */
	protected $fields = array(
		'google_fonts' => 'google_fonts',
		'el_class'     => 'el_class',
		'css'          => 'css',
		'text'         => 'text',
	);

	/**
	 * Parses shortcode attributes and set defaults based on vc_map function relative to shortcode and fields names
	 *
	 * @param $atts
	 *
	 * @since 4.3
	 * @return array
	 */
	public function getAttributes( $atts ) {
		/**
		 * Shortcode attributes
		 *
		 * @var $text
		 * @var $google_fonts
		 * @var $el_class
		 * @var $css
		 */
		$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
		extract( $atts );

		/**
		 * Get default values from VC_MAP.
		 */
		$google_fonts_field = $this->getParamData( 'google_fonts' );

		$el_class                    = $this->getExtraClass( $el_class );
		$google_fonts_obj            = new Vc_Google_Fonts();
		$google_fonts_field_settings = isset( $google_fonts_field['settings'], $google_fonts_field['settings']['fields'] ) ? $google_fonts_field['settings']['fields'] : array();
		$google_fonts_data           = strlen( $google_fonts ) > 0 ? $google_fonts_obj->_vc_google_fonts_parse_attributes( $google_fonts_field_settings, $google_fonts ) : '';

		return array(
			'text'              => isset( $text ) ? $text : '',
			'google_fonts'      => $google_fonts,
			'el_class'          => $el_class,
			'css'               => $css,
			'google_fonts_data' => $google_fonts_data,
		);
	}

	/**
	 * Get param value by providing key
	 *
	 * @param $key
	 *
	 * @since 4.4
	 * @return array|bool
	 */
	protected function getParamData( $key ) {
		return WPBMap::getParam( $this->shortcode, $this->getField( $key ) );
	}

	/**
	 * Used to get field name in vc_map function for google_fonts, font_container and etc..
	 *
	 * @param $key
	 *
	 * @since 4.4
	 * @return bool
	 */
	protected function getField( $key ) {
		return isset( $this->fields[ $key ] ) ? $this->fields[ $key ] : false;
	}

	/**
	 * Parses google_fonts_data to get needed css styles to markup
	 *
	 * @param $el_class
	 * @param $css
	 * @param $google_fonts_data
	 * @param $atts
	 *
	 * @since 4.3
	 * @return array
	 */
	public function getStyles( $el_class, $css, $google_fonts_data, $atts ) {
		$styles = array();
		if ( ( ! isset( $atts['custom_google_font'] ) || 'yes' !== $atts['custom_google_font'] ) && ! empty( $google_fonts_data ) && isset( $google_fonts_data['values'], $google_fonts_data['values']['font_family'], $google_fonts_data['values']['font_style'] ) ) {
			$google_fonts_family = explode( ':', $google_fonts_data['values']['font_family'] );
			$styles[]            = 'font-family:' . $google_fonts_family[0];
		}

		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-heading ' . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

		return array(
			'css_class' => trim( preg_replace( '/\s+/', ' ', $css_class ) ),
			'styles'    => $styles,
		);
	}

	public function get_inline_css( $selector = '' ) {
		global $brook_shortcode_lg_css;
		global $brook_shortcode_md_css;
		global $brook_shortcode_sm_css;
		global $brook_shortcode_xs_css;
		$atts = vc_map_get_attributes( $this->getShortcode(), $this->getAtts() );
		$css  = $tmp = '';

		$css .= "$selector{ text-align: {$atts['align']} }";

		if ( $atts['md_align'] !== '' ) {
			$brook_shortcode_md_css .= "$selector { text-align: {$atts['md_align']} }";
		}

		if ( $atts['sm_align'] !== '' ) {
			$brook_shortcode_sm_css .= "$selector { text-align: {$atts['sm_align']} }";
		}

		if ( $atts['xs_align'] !== '' ) {
			$brook_shortcode_xs_css .= "$selector { text-align: {$atts['xs_align']} }";
		}

		$font_size = $atts['font_size'];
		$title     = "$selector .heading";

		if ( $atts['max_width'] !== '' ) {
			$tmp .= "max-width: {$atts['max_width']};";
		}

		if ( $atts['line_height'] !== '' ) {
			$tmp .= "line-height: {$atts['line_height']};";
		}

		if ( $atts['letter_spacing'] !== '' ) {
			$tmp .= "letter-spacing: {$atts['letter_spacing']};";
		}

		if ( $atts['font_weight'] !== '' ) {
			$tmp .= "font-weight: {$atts['font_weight']};";
		}

		if ( $atts['font_decoration'] !== '' ) {
			$tmp .= "text-decoration: {$atts['font_decoration']};";
		}

		if ( $atts['text_transform'] !== '' ) {
			$tmp .= "text-transform: {$atts['text_transform']};";
		}

		if ( $atts['font_style'] !== '' ) {
			$tmp .= "font-style: {$atts['font_style']};";
		}

		$tmp .= Brook_Helper::get_shortcode_css_color_inherit( 'color', $atts['text_color'], $atts['custom_text_color'], $atts['gradient_text_color'] );

		$hover_tmp = Brook_Helper::get_shortcode_css_color_inherit( 'color', $atts['hover_text_color'], $atts['custom_hover_text_color'], $atts['hover_text_color_gradient'] );

		if ( $tmp !== '' ) {
			$css .= "$title { $tmp }";
		}

		if ( $hover_tmp !== '' ) {
			$css .= "$title:hover { $hover_tmp }";
		}

		Brook_VC::get_responsive_css( array(
			'element' => $title,
			'atts'    => array(
				'font-size' => array(
					'media_str' => $font_size,
					'unit'      => 'px',
				),
			),
		) );

		$brook_shortcode_lg_css .= $css;


		$icon_tmp = Brook_Helper::get_shortcode_css_color_inherit( 'color', $atts['icon_color'], $atts['custom_icon_color'] );

		if ( $icon_tmp !== '' ) {
			$brook_shortcode_lg_css .= "$selector .icon { $icon_tmp }";
		}

		if ( isset( $atts['icon_font_size'] ) ) {
			Brook_VC::get_responsive_css( array(
				'element' => "$selector .icon",
				'atts'    => array(
					'font-size' => array(
						'media_str' => $atts['icon_font_size'],
						'unit'      => 'px',
					),
				),
			) );
		}

		Brook_VC::get_vc_spacing_css( $selector, $atts );
	}
}

vc_map( array(
	'name'                      => esc_html__( 'Heading', 'brook' ),
	'base'                      => 'tm_heading',
	'category'                  => BROOK_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-typography',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'heading'     => esc_html__( 'Style', 'brook' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'None', 'brook' )                        => '',
				esc_html__( 'Common', 'brook' )                      => 'common',
				esc_html__( 'Gradient', 'brook' )                    => 'gradient',
				esc_html__( 'Highlight', 'brook' )                   => 'highlight',
				esc_html__( 'Highlight 02', 'brook' )                => 'highlight-02',
				esc_html__( 'Highlight 03', 'brook' )                => 'highlight-03',
				esc_html__( 'Highlight 04', 'brook' )                => 'highlight-04',
				esc_html__( 'Highlight - Secondary Color', 'brook' ) => 'highlight-secondary-color',
				esc_html__( 'Below Separator', 'brook' )             => 'below-separator',
				esc_html__( 'Below Thin Separator', 'brook' )        => 'below-thin-separator',
				esc_html__( 'Below Wavy Separator', 'brook' )        => 'below-wavy-separator',
				esc_html__( 'Vertical Text', 'brook' )               => 'vertical',
				esc_html__( 'Modern', 'brook' )                      => 'modern',
				esc_html__( 'Modern-02', 'brook' )                   => 'modern-02',
				esc_html__( 'Modern-03', 'brook' )                   => 'modern-03',
				esc_html__( 'Modern-04', 'brook' )                   => 'modern-04',
				esc_html__( 'Modern-05', 'brook' )                   => 'modern-05',
				esc_html__( 'Modern with image', 'brook' )           => 'modern-image',
				esc_html__( 'Float Shadow', 'brook' )                => 'float-shadow',
				esc_html__( 'Highlight - Typed', 'brook' )           => 'typed-text',
				esc_html__( 'Highlight - Typed 02', 'brook' )        => 'typed-text-02',
				esc_html__( 'Link Style 01', 'brook' )               => 'link-style-01',
				esc_html__( 'Link Style 02', 'brook' )               => 'link-style-02',
			),
			'std'         => '',
		),
		array(
			'heading'    => esc_html__( 'Image', 'brook' ),
			'type'       => 'attach_image',
			'param_name' => 'image',
			'dependency' => array(
				'element' => 'style',
				'value'   => array(
					'modern-image',
				),
			),
		),
		array(
			'heading'     => esc_html__( 'Text', 'brook' ),
			'type'        => 'textarea',
			'param_name'  => 'text',
			'description' => esc_html__( 'Wrap text in &lt;mark&gt;&lt;/mark&gt; tag to make text highlight', 'brook' ),
			'admin_label' => true,
		),
		array(
			'heading'    => esc_html__( 'Typed String', 'brook' ),
			'type'       => 'param_group',
			'param_name' => 'typed_list',
			'params'     => array_merge( array(
				array(
					'heading'     => esc_html__( 'Text', 'brook' ),
					'type'        => 'textfield',
					'param_name'  => 'text',
					'admin_label' => true,
				),
			) ),
			'dependency' => array(
				'element' => 'style',
				'value'   => array(
					'typed-text',
					'typed-text-02',
				),
			),

		),
		array(
			'heading'     => esc_html__( 'Link', 'brook' ),
			'type'        => 'textfield',
			'param_name'  => 'link',
			'description' => esc_html__( 'Input link for heading.', 'brook' ),
		),
		array(
			'heading'    => esc_html__( 'Element Tag', 'brook' ),
			'type'       => 'dropdown',
			'param_name' => 'tag',
			'value'      => array(
				esc_html__( 'h1', 'brook' )  => 'h1',
				esc_html__( 'h2', 'brook' )  => 'h2',
				esc_html__( 'h3', 'brook' )  => 'h3',
				esc_html__( 'h4', 'brook' )  => 'h4',
				esc_html__( 'h5', 'brook' )  => 'h5',
				esc_html__( 'h6', 'brook' )  => 'h6',
				esc_html__( 'p', 'brook' )   => 'p',
				esc_html__( 'div', 'brook' ) => 'div',
			),
			'std'        => 'h3',
		),
		array(
			'heading'    => esc_html__( 'Use custom font family', 'brook' ),
			'type'       => 'checkbox',
			'param_name' => 'custom_google_font',
			'value'      => array( esc_html__( 'Yes', 'brook' ) => 1 ),
			'std'        => 0,
		),
		array(
			'type'       => 'google_fonts',
			'param_name' => 'google_fonts',
			'value'      => 'font_family:' . rawurlencode( 'Poppins:300,regular,500,600,700' ) . '|font_style:' . rawurlencode( '600 semi-bold regular:600:normal' ),
			'settings'   => array(
				'fields' => array(
					'font_family_description' => esc_html__( 'Select font family.', 'brook' ),
					'font_style_description'  => esc_html__( 'Select font styling.', 'brook' ),
				),
			),
		),
		array(
			'heading'     => esc_html__( 'Font Size', 'brook' ),
			'type'        => 'number_responsive',
			'param_name'  => 'font_size',
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
			'heading'          => esc_html__( 'Letter Spacing', 'brook' ),
			'description'      => esc_html__( 'For e.g: 5px or 0.02em', 'brook' ),
			'type'             => 'textfield',
			'param_name'       => 'letter_spacing',
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'heading'          => esc_html__( 'Line Height', 'brook' ),
			'description'      => esc_html__( 'For e.g: 18px or 1.8', 'brook' ),
			'type'             => 'textfield',
			'param_name'       => 'line_height',
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'heading'          => esc_html__( 'Font Weight', 'brook' ),
			'type'             => 'dropdown',
			'param_name'       => 'font_weight',
			'value'            => array(
				esc_html__( 'Default', 'brook' )                  => '',
				esc_html__( '100 - Ultra Light', 'brook' )        => '100',
				esc_html__( '200 - Light', 'brook' )              => '200',
				esc_html__( '300 - Book', 'brook' )               => '300',
				esc_html__( '400 - Regular', 'brook' )            => '400',
				esc_html__( '500 - Medium', 'brook' )             => '500',
				esc_html__( '600 - SemiBold', 'brook' )           => '600',
				esc_html__( '700 - Bold', 'brook' )               => '700',
				esc_html__( '800 - Extra Bold', 'brook' )         => '800',
				esc_html__( '900 - Ultra Bold (Black)', 'brook' ) => '900',
			),
			'std'              => '',
			'edit_field_class' => 'vc_col-sm-3',
		),
		array(
			'heading'          => esc_html__( 'Font Style', 'brook' ),
			'type'             => 'dropdown',
			'param_name'       => 'font_style',
			'value'            => array(
				esc_html__( 'Default', 'brook' ) => '',
				esc_html__( 'Italic', 'brook' )  => 'italic',
			),
			'std'              => '',
			'edit_field_class' => 'vc_col-sm-3',
		),
		array(
			'heading'          => esc_html__( 'Font Decoration', 'brook' ),
			'type'             => 'dropdown',
			'param_name'       => 'font_decoration',
			'value'            => array(
				esc_html__( 'None', 'brook' )         => '',
				esc_html__( 'Underline', 'brook' )    => 'underline',
				esc_html__( 'Overline', 'brook' )     => 'overline',
				esc_html__( 'Line Through', 'brook' ) => 'line-through',
			),
			'std'              => '',
			'edit_field_class' => 'vc_col-sm-3',
		),
		array(
			'heading'          => esc_html__( 'Text Transform', 'brook' ),
			'type'             => 'dropdown',
			'param_name'       => 'text_transform',
			'value'            => array(
				esc_html__( 'None', 'brook' )       => '',
				esc_html__( 'lowercase', 'brook' )  => 'lowercase',
				esc_html__( 'UPPERCASE', 'brook' )  => 'uppercase',
				esc_html__( 'Capitalize', 'brook' ) => 'capitalize',
			),
			'std'              => '',
			'edit_field_class' => 'vc_col-sm-3',
		),
	), Brook_VC::get_alignment_fields(), array(
		array(
			'heading'    => esc_html__( 'Text Color', 'brook' ),
			'type'       => 'dropdown',
			'param_name' => 'text_color',
			'value'      => array(
				esc_html__( 'Default Color', 'brook' )   => '',
				esc_html__( 'Primary Color', 'brook' )   => 'primary',
				esc_html__( 'Secondary Color', 'brook' ) => 'secondary',
				esc_html__( 'Gradient Color', 'brook' )  => 'gradient',
				esc_html__( 'Custom Color', 'brook' )    => 'custom',
			),
			'std'        => '',
		),
		array(
			'heading'    => esc_html__( 'Custom Text Color', 'brook' ),
			'type'       => 'colorpicker',
			'param_name' => 'custom_text_color',
			'dependency' => array(
				'element' => 'text_color',
				'value'   => array( 'custom' ),
			),
			'std'        => '#222',
		),
		array(
			'heading'    => esc_html__( 'Gradient Color', 'brook' ),
			'type'       => 'gradient',
			'param_name' => 'gradient_text_color',
			'dependency' => array(
				'element' => 'text_color',
				'value'   => array( 'gradient' ),
			),
		),
		array(
			'heading'    => esc_html__( 'Hover Text Color', 'brook' ),
			'type'       => 'dropdown',
			'param_name' => 'hover_text_color',
			'value'      => array(
				esc_html__( 'Default Color', 'brook' )   => '',
				esc_html__( 'Primary Color', 'brook' )   => 'primary',
				esc_html__( 'Secondary Color', 'brook' ) => 'secondary',
				esc_html__( 'Gradient Color', 'brook' )  => 'gradient',
				esc_html__( 'Custom Color', 'brook' )    => 'custom',
			),
			'std'        => '',
		),
		array(
			'heading'    => esc_html__( 'Custom Hover Text Color', 'brook' ),
			'type'       => 'colorpicker',
			'param_name' => 'custom_hover_text_color',
			'dependency' => array(
				'element' => 'hover_text_color',
				'value'   => array( 'custom' ),
			),
			'std'        => '#222',
		),
		array(
			'heading'    => esc_html__( 'Hover Gradient Color', 'brook' ),
			'type'       => 'gradient',
			'param_name' => 'hover_text_color_gradient',
			'dependency' => array(
				'element' => 'hover_text_color',
				'value'   => array( 'gradient' ),
			),
		),
		array(
			'heading'     => esc_html__( 'Max Width', 'brook' ),
			'description' => esc_html__( 'Input the max width that makes text multi lines. For e.g: 400px', 'brook' ),
			'type'        => 'textfield',
			'param_name'  => 'max_width',
		),
		Brook_VC::get_animation_field(),
		Brook_VC::extra_class_field(),
		Brook_VC::css_editor_field(),
		array(
			'group'        => esc_html__( 'Design Options', 'brook' ),
			'heading'      => esc_html__( 'Medium Device Spacing', 'brook' ),
			'type'         => 'spacing',
			'param_name'   => 'md_spacing',
			'spacing_icon' => 'fa-tablet fa-rotate-270',
		),
		array(
			'group'        => esc_html__( 'Design Options', 'brook' ),
			'heading'      => esc_html__( 'Small Device Spacing', 'brook' ),
			'type'         => 'spacing',
			'param_name'   => 'sm_spacing',
			'spacing_icon' => 'fa-tablet',
		),
		array(
			'group'        => esc_html__( 'Design Options', 'brook' ),
			'heading'      => esc_html__( 'Extra Small Spacing', 'brook' ),
			'type'         => 'spacing',
			'param_name'   => 'xs_spacing',
			'spacing_icon' => 'fa-mobile',
		),
	), Brook_VC::icon_libraries( array(
		'allow_none' => true,
	) ), array(
		array(
			'group'       => esc_html__( 'Icon', 'brook' ),
			'heading'     => esc_html__( 'Icon Font Size', 'brook' ),
			'description' => esc_html__( 'Leave blank to inherit from title', 'brook' ),
			'type'        => 'number_responsive',
			'param_name'  => 'icon_font_size',
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
			'group'      => esc_html__( 'Icon', 'brook' ),
			'heading'    => esc_html__( 'Icon Color', 'brook' ),
			'type'       => 'dropdown',
			'param_name' => 'icon_color',
			'value'      => array(
				esc_html__( 'Inherit', 'brook' )         => '',
				esc_html__( 'Primary Color', 'brook' )   => 'primary',
				esc_html__( 'Secondary Color', 'brook' ) => 'secondary',
				esc_html__( 'Custom Color', 'brook' )    => 'custom',
			),
			'std'        => '',
		),
		array(
			'group'      => esc_html__( 'Icon', 'brook' ),
			'heading'    => esc_html__( 'Custom Icon Color', 'brook' ),
			'type'       => 'colorpicker',
			'param_name' => 'custom_icon_color',
			'dependency' => array(
				'element' => 'icon_color',
				'value'   => 'custom',
			),
			'std'        => '#fff',
		),
	), Brook_VC::get_custom_style_tab() ),
) );
