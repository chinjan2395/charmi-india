<?php
defined( 'ABSPATH' ) || exit;

$style = $skin = $el_class = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

if ( $el_id === '' ) {
	$el_id = uniqid( 'tm-slider-button-' );
}

$this->get_inline_css( "#$el_id", $atts );

$el_class  = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-slider-button ' . $el_class, $this->settings['base'], $atts );

$css_class .= " style-$style";
$css_class .= " skin-$skin";

$css_class .= Brook_Helper::get_animation_classes();
?>
<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $el_id ); ?>">
	<div class="button-wrap">
		<div class="slider-btn slider-prev-btn">
			<span class="fa fa-angle-left"></span>
		</div>
		<div class="slider-btn slider-next-btn">
			<span class="fa fa-angle-right"></span>
		</div>
	</div>
</div>
