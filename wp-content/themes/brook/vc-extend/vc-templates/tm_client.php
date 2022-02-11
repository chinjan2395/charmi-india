<?php
defined( 'ABSPATH' ) || exit;

$style = $effect = $el_class = $items = '';

$atts   = vc_map_get_attributes( $this->getShortcode(), $atts );
$css_id = uniqid( 'tm-client-' );
$this->get_inline_css( '#' . $css_id, $atts );
extract( $atts );

$el_class  = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-client ' . $el_class, $this->settings['base'], $atts );
$css_class .= " style-$style";
$css_class .= " effect-$effect";

$items = (array) vc_param_group_parse_atts( $items );

if ( count( $items ) <= 0 ) {
	return;
}
?>
<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>">
	<?php
	set_query_var( 'brook_shortcode_atts', $atts );

	get_template_part( 'loop/shortcodes/client/style', $style );
	?>
</div>
