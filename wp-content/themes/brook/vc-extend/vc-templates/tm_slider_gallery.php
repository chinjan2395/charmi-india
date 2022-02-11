<?php
defined( 'ABSPATH' ) || exit;

$style           = $el_class = $shadow = $image_size = $image_size_width = $image_size_height = '';
$lightbox_enable = '';
$loop            = $equal_height = $auto_play = $v_center = $h_center = $fw_image = $nav = $pagination = '';

$atts   = vc_map_get_attributes( $this->getShortcode(), $atts );
$css_id = uniqid( 'tm-slider-gallery-' );
$this->get_inline_css( "#$css_id", $atts );
extract( $atts );

$el_class  = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-slider-gallery ' . $el_class, $this->settings['base'], $atts );

$css_class .= " style-$style";

if ( $shadow !== '' ) {
	$css_class .= " $shadow";
}

$css_class .= Brook_Helper::get_animation_classes();

if ( $images === '' ) {
	return;
}

if ( $lightbox_enable === '1' ) {
	$css_class .= ' tm-light-gallery';

	wp_enqueue_style( 'lightgallery' );
	wp_enqueue_script( 'lightgallery' );
}
?>
<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>">
	<div class="sc-outer">
		<div class="sc-inner">
			<?php
			set_query_var( 'brook_shortcode_atts', $atts );
			get_template_part( 'loop/shortcodes/slider-gallery/style', $style );
			?>
		</div>
	</div>
</div>
