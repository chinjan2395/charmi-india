<?php
defined( 'ABSPATH' ) || exit;

/**
 * Shortcode attributes
 *
 * @var $atts
 * @var $el_class
 * @var $el_id
 * @var $content - shortcode content
 * Shortcode class
 * @var $this    WPBakeryShortCode_VC_Wp_Custom_HTML
 */
$el_class = $el_id = '';
$output   = '';
$atts     = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class           = $this->getExtraClass( $el_class );
$wrapper_attributes = array();
if ( ! empty( $el_id ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}
$output = '<div ' . implode( ' ', $wrapper_attributes ) . ' class="vc_wp_custom_html wpb_content_element' . esc_attr( $el_class ) . '">';
$type   = 'WP_Widget_Custom_HTML';
$args   = array();
if ( strlen( $content ) > 0 ) {
	$content = strip_tags( $content );

	if ( function_exists( 'insight_core_base_decode' ) ) {
		$content = insight_core_base_decode( $content );
	}

	$content         = rawurldecode( $content );
	$content         = wpb_js_remove_wpautop( apply_filters( 'vc_raw_html_module_content', $content ) );
	$atts['content'] = $content;
}

global $wp_widget_factory;
// to avoid unwanted warnings let's check before using widget.
if ( is_object( $wp_widget_factory ) && isset( $wp_widget_factory->widgets, $wp_widget_factory->widgets[ $type ] ) ) {
	ob_start();
	the_widget( $type, $atts, $args );
	$output .= ob_get_clean();

	$output .= '</div>';

	echo '' . $output;
} else {
	echo '' . $this->debugComment( 'Widget ' . esc_attr( $type ) . 'Not found in : vc_wp_custom_html' );
}
