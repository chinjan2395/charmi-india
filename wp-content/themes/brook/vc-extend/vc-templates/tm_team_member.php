<?php
defined( 'ABSPATH' ) || exit;

$style = $el_class = $animation = $photo = $name = $profile = $social_networks = '';

$atts   = vc_map_get_attributes( $this->getShortcode(), $atts );
$css_id = uniqid( 'tm-team-member-' );
$this->get_inline_css( "#$css_id", $atts );
extract( $atts );

$el_class = $this->getExtraClass( $el_class );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-team-member ' . $el_class, $this->settings['base'], $atts );
$css_class .= " style-$style";

$css_class .= Brook_Helper::get_animation_classes( $animation );
?>

<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>">
	<?php
	set_query_var( 'brook_shortcode_atts', $atts );

	get_template_part( 'loop/shortcodes/team-member/style', $style );
	?>
</div>
