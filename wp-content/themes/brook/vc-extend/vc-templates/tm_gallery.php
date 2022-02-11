<?php
defined( 'ABSPATH' ) || exit;

$style              = $el_class = $columns = $animation = '';
$gutter             = 0;
$justify_row_height = $justify_max_row_height = $justify_last_row_alignment = '';

$atts   = vc_map_get_attributes( $this->getShortcode(), $atts );
$css_id = uniqid( 'tm-gallery-' );
$this->get_inline_css( "#$css_id", $atts );
Brook_VC::get_shortcode_custom_css( "#$css_id", $atts );
extract( $atts );

if ( $images === '' ) {
	return;
}

$el_class  = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-gallery tm-grid-wrapper ' . $el_class, $this->settings['base'], $atts );
$css_class .= " style-$style";

$grid_classes = 'tm-grid';

if ( in_array( $style, array( 'grid', 'metro', 'metro-02' ) ) ) {
	$grid_classes .= ' modern-grid';
}

$grid_classes .= Brook_Helper::get_grid_animation_classes( $animation );

if ( $style === 'justified' ) {
	wp_enqueue_style( 'justifiedGallery' );
	wp_enqueue_script( 'justifiedGallery' );
} elseif ( $style === 'masonry' ) {
	wp_enqueue_script( 'isotope-packery' );
}

$grid_classes .= ' tm-light-gallery';

wp_enqueue_style( 'lightgallery' );
wp_enqueue_script( 'lightgallery' );
?>
<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>"

	<?php if ( in_array( $style, array( 'masonry' ), true ) ) { ?>
		data-type="masonry"
	<?php } elseif ( in_array( $style, array( 'justified' ), true ) ) { ?>
		data-type="justified"

		<?php if ( $justify_row_height !== '' && $justify_row_height > 0 ) { ?>
			data-justified-height="<?php echo esc_attr( $justify_row_height ); ?>"
		<?php } ?>

		<?php if ( $justify_max_row_height !== '' && $justify_max_row_height > 0 ) { ?>
			data-justified-max-height="<?php echo esc_attr( $justify_max_row_height ); ?>"
		<?php } ?>

		<?php if ( $justify_last_row_alignment !== '' ) { ?>
			data-justified-last-row="<?php echo esc_attr( $justify_last_row_alignment ); ?>"
		<?php } ?>

	<?php } ?>

	<?php if ( in_array( $style, array( 'masonry' ), true ) && $columns !== '' ): ?>
		<?php
		$arr = explode( ';', $columns );
		foreach ( $arr as $value ) {
			$tmp = explode( ':', $value );
			echo ' data-' . $tmp[0] . '-columns="' . esc_attr( $tmp[1] ) . '"';
		}
		?>
	<?php endif; ?>

	<?php if ( $gutter !== '' && $gutter !== 0 ) : ?>
		data-gutter="<?php echo esc_attr( $gutter ); ?>"
	<?php endif; ?>
>
	<div class="<?php echo esc_attr( $grid_classes ); ?>">

		<?php if ( in_array( $style, array( 'masonry' ), true ) ) : ?>
			<div class="grid-sizer"></div>
		<?php endif; ?>

		<?php
		set_query_var( 'brook_shortcode_atts', $atts );

		get_template_part( 'loop/shortcodes/gallery/style', $style );
		?>

	</div>
</div>
