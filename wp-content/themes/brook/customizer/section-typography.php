<?php
$section  = 'typography';
$priority = 1;
$prefix   = 'typography_';

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="desc"><strong class="insight-label insight-label-info">' . esc_html__( 'IMPORTANT NOTE: ', 'brook' ) . '</strong>' . esc_html__( 'This section contains general typography options. Additional typography options for specific areas can be found within other sections. Example: For breadcrumb typography options go to the breadcrumb section.', 'brook' ) . '</div>',
) );

Brook_Kirki::add_field( 'theme', array(
	'type'      => 'kirki_typography',
	'settings'  => 'secondary_font',
	'label'     => esc_html__( 'Secondary Font family', 'brook' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'auto',
	'default'   => array(
		'font-family' => 'Playfair Display',
	),
	'choices'   => array(
		'variant' => array(
			'regular',
			'italic',
			'500',
			'500italic',
			'600',
			'600italic',
			'700',
			'700italic',
			'900',
			'900italic',
		),
	),
	'output'    => array(
		array(
			'element' => '.secondary-font,
			.tm-heading.highlight-02 mark,
			.tm-heading.highlight-03 mark,
			.typed-text-02 mark',
		),
	),
) );

/*--------------------------------------------------------------
# Link color
--------------------------------------------------------------*/
Brook_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Link', 'brook' ) . '</div>',
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => 'link_color',
	'label'       => esc_html__( 'Color', 'brook' ),
	'description' => esc_html__( 'Controls the color of all links.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#999999',
	'output'      => array(
		array(
			'element'  => '
			a,
			.tm-blog.style-list .post-categories
			',
			'property' => 'color',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => 'link_color_hover',
	'label'       => esc_html__( 'Hover Color', 'brook' ),
	'description' => esc_html__( 'Controls the color of all links when hover.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => Brook::PRIMARY_COLOR,
	'output'      => array(
		array(
			'element'  => '
			a:hover,
			a:focus,
			.tm-maps .gmap-info-template .gmap-marker-content a:hover
			',
			'property' => 'color',
		),
	),
) );

/*--------------------------------------------------------------
# Body Typography
--------------------------------------------------------------*/
Brook_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Body Typography', 'brook' ) . '</div>',
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'kirki_typography',
	'settings'    => $prefix . 'body',
	'label'       => esc_html__( 'Font family', 'brook' ),
	'description' => esc_html__( 'These settings control the typography for all body text.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => array(
		'font-family'    => Brook::PRIMARY_FONT,
		'variant'        => '500',
		'line-height'    => '1.58',
		'letter-spacing' => '0em',
	),
	'choices'     => array(
		'variant' => array(
			'300',
			'300italic',
			'regular',
			'italic',
			'500',
			'500italic',
			'700',
			'700italic',
			'900',
			'900italic',
		),
	),
	'output'      => array(
		array(
			'element' => 'body, .gmap-marker-wrap',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => 'body_color',
	'label'       => esc_html__( 'Body Text Color', 'brook' ),
	'description' => esc_html__( 'Controls the color of body text.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#999',
	'output'      => array(
		array(
			'element'  => '
			.tm-testimonial,
			.gmap-marker-wrap,
			body
			',
			'property' => 'color',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => 'body_font_size',
	'label'     => esc_html__( 'Font size', 'brook' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => 14,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 10,
		'max'  => 50,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => 'body, .gmap-marker-wrap',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
) );

/*--------------------------------------------------------------
# Heading typography
--------------------------------------------------------------*/
Brook_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Heading Typography', 'brook' ) . '</div>',
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'kirki_typography',
	'settings'    => $prefix . 'heading',
	'label'       => esc_html__( 'Font family', 'brook' ),
	'description' => esc_html__( 'These settings control the typography for all heading text.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => array(
		'font-family'    => Brook::PRIMARY_FONT,
		'variant'        => '600',
		'line-height'    => '1.23',
		'letter-spacing' => '0em',
	),
	'choices'     => array(
		'variant' => array(
			'300',
			'300italic',
			'regular',
			'italic',
			'500',
			'500italic',
			'600',
			'600italic',
			'700',
			'700italic',
			'900',
			'900italic',
		),
	),
	'output'      => array(
		array(
			'element' => 'h1,h2,h3,h4,h5,h6,th,[class*="hint--"]:after, .tm-countdown.style-06 .number',
		),
		array(
			'element'  => '.tm-grid-wrapper .btn-filter',
			'property' => 'font-weight',
			'choice'   => 'variant',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => 'heading_color',
	'label'       => esc_html__( 'Heading Color', 'brook' ),
	'description' => esc_html__( 'Controls the color of heading.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => Brook::HEADING_COLOR,
	'output'      => array(
		array(
			'element'  => 'h1,h2,h3,h4,h5,h6,caption,th,
			blockquote,
			.heading-color,
			.vc_progress_bar .vc_single_bar_title,
			.vc_chart.vc_chart .vc_chart-legend li,
			.tm-countdown .number,
			.tm-drop-cap.style-01 .drop-cap,
			.tm-drop-cap.style-02,
			.tm-table caption,
            .tm-counter.style-01 .number-wrap,
            .tm-counter.style-02 .number-wrap,
            .tm-counter.style-05 .number-wrap,
            .tm-grid-wrapper.filter-counter-style-02 .btn-filter.current,
			.tm-grid-wrapper.filter-counter-style-02 .btn-filter:hover,
			.tm-grid-wrapper.filter-counter-style-02 .btn-filter.current .filter-counter,
			.tm-grid-wrapper.filter-counter-style-02 .btn-filter:hover .filter-counter,
			.tm-portfolio.style-metro-with-caption .post-view-detail,
            .tm-social-networks.style-title .item:hover .link-text,
            .tm-social-networks.style-large-icons .link,
            .single-post .entry-footer .post-share a,
            .portfolio-details-list label,
            .single-portfolio .portfolio-share a,
			.woocommerce div.product .woocommerce-tabs ul.tabs li a,
			.woocommerce.single-product #reviews .comment-reply-title,
			.product-sharing-list a,
			.woocommerce.single-product div.product form.cart label
			',
			'property' => 'color',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'slider',
	'settings'    => 'h1_font_size',
	'label'       => esc_html__( 'Font size', 'brook' ),
	'description' => esc_html__( 'H1', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 56,
	'transport'   => 'auto',
	'choices'     => array(
		'min'  => 10,
		'max'  => 100,
		'step' => 1,
	),
	'output'      => array(
		array(
			'element'  => 'h1',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'slider',
	'settings'    => 'h2_font_size',
	'description' => esc_html__( 'H2', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 48,
	'transport'   => 'auto',
	'choices'     => array(
		'min'  => 10,
		'max'  => 100,
		'step' => 1,
	),
	'output'      => array(
		array(
			'element'  => 'h2',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'slider',
	'settings'    => 'h3_font_size',
	'description' => esc_html__( 'H3', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 36,
	'transport'   => 'auto',
	'choices'     => array(
		'min'  => 10,
		'max'  => 100,
		'step' => 1,
	),
	'output'      => array(
		array(
			'element'  => 'h3',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'slider',
	'settings'    => 'h4_font_size',
	'description' => esc_html__( 'H4', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 24,
	'transport'   => 'auto',
	'choices'     => array(
		'min'  => 10,
		'max'  => 100,
		'step' => 1,
	),
	'output'      => array(
		array(
			'element'  => 'h4',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'slider',
	'settings'    => 'h5_font_size',
	'description' => esc_html__( 'H5', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 18,
	'transport'   => 'auto',
	'choices'     => array(
		'min'  => 10,
		'max'  => 100,
		'step' => 1,
	),
	'output'      => array(
		array(
			'element'  => 'h5',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'slider',
	'settings'    => 'h6_font_size',
	'description' => esc_html__( 'H6', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 14,
	'transport'   => 'auto',
	'choices'     => array(
		'min'  => 10,
		'max'  => 100,
		'step' => 1,
	),
	'output'      => array(
		array(
			'element'  => 'h6',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
) );

/*--------------------------------------------------------------
# Button Color
--------------------------------------------------------------*/
Brook_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Button', 'brook' ) . '</div>',
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'kirki_typography',
	'settings'    => 'button_typography',
	'label'       => esc_html__( 'Font family', 'brook' ),
	'description' => esc_html__( 'These settings control the typography for buttons.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => array(
		'font-family'    => 'Poppins',
		'variant'        => '600',
		'letter-spacing' => '0em',
		'font-size'      => '14px',
		'text-transform' => '',
	),
	'choices'     => array(
		'variant' => array(
			'300',
			'300italic',
			'regular',
			'italic',
			'500',
			'500italic',
			'700',
			'700italic',
			'900',
			'900italic',
		),
	),
	'output'      => array(
		array(
			'element' => Brook_Helper::get_button_css_selector(),
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'button_style',
	'label'    => esc_html__( 'Button Style', 'brook' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => 'solid',
	'choices'  => array(
		'solid'    => esc_html__( 'Solid', 'brook' ),
		'gradient' => esc_html__( 'Gradient', 'brook' ),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'            => 'multicolor',
	'settings'        => 'button_color',
	'label'           => esc_html__( 'Button Color', 'brook' ),
	'description'     => esc_html__( 'Controls the color of button.', 'brook' ),
	'section'         => $section,
	'priority'        => $priority++,
	'transport'       => 'auto',
	'choices'         => array(
		'color'      => esc_attr__( 'Color', 'brook' ),
		'background' => esc_attr__( 'Background', 'brook' ),
		'border'     => esc_attr__( 'Border', 'brook' ),
	),
	'default'         => array(
		'color'      => '#ffffff',
		'background' => Brook::PRIMARY_COLOR,
		'border'     => Brook::PRIMARY_COLOR,
	),
	'output'          => array(
		array(
			'choice'   => 'color',
			'element'  => Brook_Helper::get_button_css_selector(),
			'property' => 'color',
		),
		array(
			'choice'   => 'border',
			'element'  => Brook_Helper::get_button_css_selector(),
			'property' => 'border-color',
		),
		array(
			'choice'   => 'background',
			'element'  => Brook_Helper::get_button_css_selector(),
			'property' => 'background-color',
		),
	),
	'active_callback' => array(
		array(
			'setting'  => 'button_style',
			'operator' => '==',
			'value'    => 'solid',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'            => 'multicolor',
	'settings'        => 'button_hover_color',
	'label'           => esc_html__( 'Button Hover Color', 'brook' ),
	'description'     => esc_html__( 'Controls the color of button when hover.', 'brook' ),
	'section'         => $section,
	'priority'        => $priority++,
	'transport'       => 'auto',
	'choices'         => array(
		'color'      => esc_attr__( 'Color', 'brook' ),
		'background' => esc_attr__( 'Background', 'brook' ),
		'border'     => esc_attr__( 'Border', 'brook' ),
	),
	'default'         => array(
		'color'      => '#ffffff',
		'background' => Brook::PRIMARY_COLOR,
		'border'     => Brook::PRIMARY_COLOR,
	),
	'output'          => array(
		array(
			'choice'   => 'color',
			'element'  => Brook_Helper::get_button_hover_css_selector(),
			'property' => 'color',
		),
		array(
			'choice'   => 'border',
			'element'  => Brook_Helper::get_button_hover_css_selector(),
			'property' => 'border-color',
		),
		array(
			'choice'   => 'background',
			'element'  => Brook_Helper::get_button_hover_css_selector(),
			'property' => 'background-color',
		),
	),
	'active_callback' => array(
		array(
			'setting'  => 'button_style',
			'operator' => '==',
			'value'    => 'solid',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'            => 'multicolor',
	'settings'        => 'button_gradient_color',
	'label'           => esc_html__( 'Button Gradient Color', 'brook' ),
	'description'     => esc_html__( 'Controls the gradient color of button', 'brook' ),
	'section'         => $section,
	'priority'        => $priority++,
	'transport'       => 'auto',
	'choices'         => array(
		'color_1'    => esc_attr__( 'Color 1', 'brook' ),
		'color_2'    => esc_attr__( 'Color 2', 'brook' ),
		'text_color' => esc_attr__( 'Text Color', 'brook' ),
	),
	'default'         => array(
		'color_1'    => '#58FFA4',
		'color_2'    => '#0068FF',
		'text_color' => '#fff',
	),
	'active_callback' => array(
		array(
			'setting'  => 'button_style',
			'operator' => '==',
			'value'    => 'gradient',
		),
	),
) );

/*--------------------------------------------------------------
# Form
--------------------------------------------------------------*/
Brook_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Form Input', 'brook' ) . '</div>',
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'kirki_typography',
	'settings'    => 'form_typography',
	'label'       => esc_html__( 'Font family', 'brook' ),
	'description' => esc_html__( 'These settings control the typography for form inputs.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => array(
		'font-family'    => '',
		'variant'        => '',
		'letter-spacing' => '0em',
		'font-size'      => '',
		'text-transform' => '',
	),
	'choices'     => array(
		'variant' => array(
			'300',
			'300italic',
			'regular',
			'italic',
			'500',
			'500italic',
			'700',
			'700italic',
			'900',
			'900italic',
		),
	),
	'output'      => array(
		array(
			'element' => Brook_Helper::get_form_input_css_selector(),
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'multicolor',
	'settings'    => 'form_input_color',
	'label'       => esc_html__( 'Form Input Color', 'brook' ),
	'description' => esc_html__( 'Controls the color of form inputs.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'choices'     => array(
		'color'      => esc_attr__( 'Color', 'brook' ),
		'background' => esc_attr__( 'Background', 'brook' ),
		'border'     => esc_attr__( 'Border', 'brook' ),
	),
	'default'     => array(
		'color'      => '#777',
		'background' => '#fff',
		'border'     => '#eee',
	),
	'output'      => array(
		array(
			'choice'   => 'color',
			'element'  => Brook_Helper::get_form_input_css_selector(),
			'property' => 'color',
		),
		array(
			'choice'   => 'border',
			'element'  => Brook_Helper::get_form_input_css_selector(),
			'property' => 'border-color',
		),
		array(
			'choice'   => 'background',
			'element'  => Brook_Helper::get_form_input_css_selector(),
			'property' => 'background-color',
		),
	),
) );

Brook_Kirki::add_field( 'theme', array(
	'type'        => 'multicolor',
	'settings'    => 'form_input_focus_color',
	'label'       => esc_html__( 'Form Input Focus Color', 'brook' ),
	'description' => esc_html__( 'Controls the color of form inputs when focus.', 'brook' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'choices'     => array(
		'color'      => esc_attr__( 'Color', 'brook' ),
		'background' => esc_attr__( 'Background', 'brook' ),
		'border'     => esc_attr__( 'Border', 'brook' ),
	),
	'default'     => array(
		'color'      => Brook::PRIMARY_COLOR,
		'background' => '#fff',
		'border'     => Brook::PRIMARY_COLOR,
	),
	'output'      => array(
		array(
			'choice'   => 'color',
			'element'  => Brook_Helper::get_form_input_focus_css_selector(),
			'property' => 'color',
		),
		array(
			'choice'   => 'border',
			'element'  => Brook_Helper::get_form_input_focus_css_selector(),
			'property' => 'border-color',
		),
		array(
			'choice'   => 'background',
			'element'  => Brook_Helper::get_form_input_focus_css_selector(),
			'property' => 'background-color',
		),
	),
) );
