<?php
defined( 'ABSPATH' ) || exit;

$el_class = $style = $skin = $datetime = $number_color = $text_color = '';

$atts   = vc_map_get_attributes( $this->getShortcode(), $atts );
$css_id = uniqid( 'tm-countdown-' );
$this->get_inline_css( '#' . $css_id, $atts );
extract( $atts );

$el_class  = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-countdown ' . $el_class, $this->settings['base'], $atts );

$css_class .= " style-$style";

if ( $skin !== '' ) {
	$css_class .= " skin-$skin";
}

$css_class .= Brook_Helper::get_animation_classes();

// Use demo countdown date.
if ( $datetime === '' ) {
	$atts['datetime'] = Brook_Helper::get_sample_countdown_date();
}
?>
<div id="<?php echo esc_attr( $css_id ); ?>" class="<?php echo esc_attr( $css_class ); ?>">
	<?php
	set_query_var( 'brook_shortcode_atts', $atts );

	get_template_part( 'loop/shortcodes/countdown/style', $style );
	?>
</div>
