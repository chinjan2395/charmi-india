<?php
defined( 'ABSPATH' ) || exit;

$style = $skin = $el_id = $el_class = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$items = (array) vc_param_group_parse_atts( $items );
if ( count( $items ) < 1 ) {
	return;
}

if ( $el_id === '' ) {
	$el_id = uniqid( 'tm-timeline-' );
}

$this->get_inline_css( "#$el_id", $atts );
Brook_VC::get_shortcode_custom_css( "#$el_id", $atts );

$el_class  = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-timeline ' . $el_class, $this->settings['base'], $atts );
if ( $style !== '' ) {
	$css_class .= " style-$style";
}

if ( $skin !== '' ) {
	$css_class .= " skin-$skin";
}
?>
<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $el_id ); ?>">
	<?php
	set_query_var( 'items', $items );

	get_template_part( 'loop/shortcodes/timeline/style', $style );
	?>
</div>
