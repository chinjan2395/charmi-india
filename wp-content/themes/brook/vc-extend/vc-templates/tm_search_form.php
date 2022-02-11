<?php
defined( 'ABSPATH' ) || exit;

$el_class = $style = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class  = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-search-form ' . $el_class, $this->settings['base'], $atts );

if ( $style !== '' ) {
	$css_class .= " style-$style";
}

$css_class .= Brook_Helper::get_animation_classes();
?>
<div class="<?php echo esc_attr( trim( $css_class ) ); ?>">
	<?php get_search_form(); ?>

	<?php
	$_categories = get_categories();
	if ( ! empty( $_categories ) ) : ?>
		<div class="category-wrap">
			<div class="inner">
				<div class="category-label">
					<?php esc_html_e( 'Or browse by category', 'brook' ); ?>
				</div>
				<div class="category-list">
					<?php
					foreach ( $_categories as $cat ) {
						$cat_link = get_category_link( $cat->term_id );
						?>
						<a href="<?php echo esc_url( $cat_link ); ?>">
							<?php echo esc_html( $cat->name ); ?>
						</a>
					<?php } ?>
				</div>
			</div>
		</div>
	<?php endif; ?>
</div>
