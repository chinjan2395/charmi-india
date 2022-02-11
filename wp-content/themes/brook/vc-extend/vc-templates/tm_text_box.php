<?php
defined( 'ABSPATH' ) || exit;

$style = $heading = $text = '';

$atts   = vc_map_get_attributes( $this->getShortcode(), $atts );
$css_id = uniqid( 'tm-text-box-' );
$this->get_inline_css( "#$css_id", $atts );
extract( $atts );

$el_class  = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-text-box ' . $el_class, $this->settings['base'], $atts );
$css_class .= " style-$style";

$css_class .= Brook_Helper::get_animation_classes();
?>
<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>">
	<?php if ( $heading !== '' ): ?>
		<h5 class="heading"><?php echo wp_kses( $heading, 'brook-default' ); ?></h5>
	<?php endif; ?>

	<?php if ( $text !== '' ): ?>
		<div class="text">
			<?php echo wp_kses( $text, 'brook-default' ); ?>
		</div>
	<?php endif; ?>
</div>
