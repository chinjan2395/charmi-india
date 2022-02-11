<?php
defined( 'ABSPATH' ) || exit;

/**
 * Shortcode attributes
 *
 * @var $atts
 * @var $el_class
 * @var $css
 * @var $el_id
 * @var $equal_height
 * @var $content_placement
 * @var $content - shortcode content
 * Shortcode class
 * @var $this    WPBakeryShortCode_VC_Row_Inner
 */
$el_class        = $equal_height = $content_placement = $css = $el_id = '';
$disable_element = '';
$output          = $after_output = '';
$effect          = $firefly_color = $firefly_min_size = $firefly_max_size = $firefly_total = '';
$atts            = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class    = $this->getExtraClass( $el_class );
$css_classes = array(
	'vc_row',
	'vc_inner',
	'vc_row-fluid',
	$el_class,
	vc_shortcode_custom_css_class( $css ),
);

if ( $overlay_background !== '' ) {
	$css_classes[] = 'vc_container-has-overlay';
}

if ( 'yes' === $disable_element ) {
	if ( vc_is_page_editable() ) {
		$css_classes[] = 'vc_hidden-lg vc_hidden-xs vc_hidden-sm vc_hidden-md';
	} else {
		return '';
	}
}

if ( vc_shortcode_custom_css_has_property( $css, array( 'border', 'background' ) ) ) {
	$css_classes[] = 'vc_row-has-fill';
}

if ( ! empty( $atts['gap'] ) ) {
	$css_classes[] = 'vc_column-gap-' . $atts['gap'];
}

if ( ! empty( $equal_height ) ) {
	$flex_row      = true;
	$css_classes[] = 'vc_row-o-equal-height';
}

if ( ! empty( $content_placement ) ) {
	$flex_row      = true;
	$css_classes[] = 'vc_row-o-content-' . $content_placement;
}

if ( ! empty( $flex_row ) ) {
	$css_classes[] = 'vc_row-flex';
}

$wrapper_attributes = array();
// build attributes for wrapper.

if ( $background_attachment === 'marque' ) {
	$css_classes[] = 'background-marque';
	$css_classes[] = $marque_direction;

	if ( $marque_pause_on_hover === '1' ) {
		$wrapper_attributes[] = 'data-marque-pause-on-hover="true"';
	}
}

if ( $effect === 'firefly' ) {
	wp_enqueue_script( 'firefly' );

	$css_classes[] = 'tm-effect-firefly';

	if ( $firefly_color !== '' ) {
		$wrapper_attributes[] = 'data-firefly-color="' . $firefly_color . '"';
	}

	if ( $firefly_total !== '' ) {
		$wrapper_attributes[] = 'data-firefly-total="' . $firefly_total . '"';
	}

	if ( $firefly_min_size !== '' ) {
		$wrapper_attributes[] = 'data-firefly-min="' . $firefly_min_size . '"';
	}

	if ( $firefly_max_size !== '' ) {
		$wrapper_attributes[] = 'data-firefly-max="' . $firefly_max_size . '"';
	}
}

$css_id = uniqid( 'tm-row-inner-' );
Brook_VC::get_vc_row_inner_css( '#' . $css_id, $atts );
$wrapper_attributes[] = 'id="' . esc_attr( $css_id ) . '"';

$css_class            = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( array_unique( $css_classes ) ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';

$output .= '<div ' . implode( ' ', $wrapper_attributes ) . '>';

if ( $overlay_background !== '' ) {
	$output .= '<div class="vc_container-overlay"></div>';
}

if ( $effect === 'firefly' ) {
	$output .= '<div class="firefly-wrapper"></div>';
}

$output .= wpb_js_remove_wpautop( $content );
$output .= '</div>';
$output .= $after_output;

echo '' . $output;
