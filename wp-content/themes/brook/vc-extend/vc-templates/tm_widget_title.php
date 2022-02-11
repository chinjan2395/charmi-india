<?php
defined( 'ABSPATH' ) || exit;

$widget_title = $el_class = '';

$atts   = vc_map_get_attributes( $this->getShortcode(), $atts );
$css_id = uniqid( 'tm-widget-title-' );
$this->get_inline_css( "#$css_id widgettitle", $atts );
extract( $atts );

$el_class  = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-widget-title widget ' . $el_class, $this->settings['base'], $atts );

if ( $widget_title === '' ) {
	return;
}

$css_class .= Brook_Helper::get_animation_classes();
?>
<div id="<?php echo esc_attr( $css_id ); ?>" class="<?php echo esc_attr( trim( $css_class ) ); ?>">
	<h2 class="widgettitle"><?php echo esc_html( $widget_title ); ?></h2>
</div>
