<?php
defined( 'ABSPATH' ) || exit;

$el_class = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class  = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-group ' . $el_class, $this->settings['base'], $atts );

if ( $style !== '' ) {
	$css_class .= " style-$style";
}
?>
<div class="<?php echo esc_attr( trim( $css_class ) ); ?>">
	<?php echo wpb_js_remove_wpautop( $content ); ?>
</div>
