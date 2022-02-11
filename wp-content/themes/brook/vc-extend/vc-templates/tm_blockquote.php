<?php
defined( 'ABSPATH' ) || exit;

$style = $el_class = $text = '';

$atts   = vc_map_get_attributes( $this->getShortcode(), $atts );
$css_id = uniqid( 'tm-blockquote-' );
$this->get_inline_css( "#$css_id", $atts );
extract( $atts );

$el_class  = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-blockquote ' . $el_class, $this->settings['base'], $atts );
$css_class .= " style-$style";

$css_class .= Brook_Helper::get_animation_classes();

if ( $text === '' ) {
	return;
}
?>
<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>">
	<blockquote>
		<?php if ( $text !== '' ) : ?>
			<?php echo '<div class="quote-text">' . $text . '</div>'; ?>
		<?php endif; ?>
	</blockquote>
</div>
