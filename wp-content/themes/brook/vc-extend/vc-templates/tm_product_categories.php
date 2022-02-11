<?php
defined( 'ABSPATH' ) || exit;

$style                  = $el_class = '';
$carousel_items_display = $carousel_gutter = $carousel_nav = $carousel_pagination = $carousel_auto_play = '';

$atts   = vc_map_get_attributes( $this->getShortcode(), $atts );
$css_id = uniqid( 'tm-product-categories-' );
$this->get_inline_css( "#$css_id", $atts );
extract( $atts );

$items = (array) vc_param_group_parse_atts( $items );
$count = count( $items );
if ( $count < 1 ) {
	return;
}

$el_class  = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-product-categories ' . $el_class, $this->settings['base'], $atts );
$css_class .= " style-$style";

$is_swiper = false;
if ( in_array( $style, array( 'carousel' ), true ) ) {
	$is_swiper = true;
}

$grid_classes = 'tm-grid';

if ( $is_swiper ) {
	$grid_classes   .= ' swiper-wrapper';
	$slider_classes = 'tm-swiper';
	if ( $carousel_nav !== '' ) {
		$slider_classes .= " nav-style-$carousel_nav";
	}
	if ( $carousel_pagination !== '' ) {
		$slider_classes .= " pagination-style-$carousel_pagination";
	}
}

if ( ! $is_swiper ) {
	$grid_classes .= Brook_Helper::get_grid_animation_classes( $animation );
}
?>
<div class="tm-grid-wrapper <?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>"
	<?php if ( $is_swiper ) { ?>
		data-type="swiper"
	<?php } ?>
>

	<?php if ( $is_swiper ) { ?>
	<div class="<?php echo esc_attr( $slider_classes ); ?>"
		<?php
		if ( $carousel_items_display !== '' ) {
			$arr = explode( ';', $carousel_items_display );
			foreach ( $arr as $value ) {
				$tmp = explode( ':', $value );
				echo ' data-' . $tmp[0] . '-items="' . $tmp[1] . '"';
			}
		}
		?>

		<?php if ( $carousel_gutter > 1 ) : ?>
			data-lg-gutter="<?php echo esc_attr( $carousel_gutter ); ?>"
		<?php endif; ?>

		<?php if ( $carousel_nav !== '' ) : ?>
			data-nav="1"
		<?php endif; ?>

		<?php if ( $carousel_nav === 'custom' ) : ?>
			data-custom-nav="<?php echo esc_attr( $slider_button_id ); ?>"
		<?php endif; ?>

		<?php if ( $carousel_pagination !== '' ) : ?>
			data-pagination="1"
		<?php endif; ?>

		<?php if ( $carousel_auto_play !== '' ) : ?>
			data-autoplay="<?php echo esc_attr( $carousel_auto_play ); ?>"
		<?php endif; ?>
		 data-loop="1"
	>
		<div class="swiper-container">
			<?php } ?>

			<div class="<?php echo esc_attr( $grid_classes ); ?>">

				<?php if ( $style === 'carousel' ) { ?>

					<?php
					foreach ( $items as $item ) {
						$classes = array( 'category-item grid-item swiper-slide' );

						$term = get_term_by( 'slug', $item['category'], 'product_cat' );

						if ( $term === false ) {
							continue;
						}

						$term_link = get_term_link( $term );

						$cat_thumb_id = get_woocommerce_term_meta( $term->term_id, 'thumbnail_id', true );
						$image_url    = Brook_Image::get_attachment_url_by_id( array(
							'id'   => $cat_thumb_id,
							'size' => '480x330',
						) );
						?>
						<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
							<div class="cat-wrapper">
								<a href="<?php echo esc_url( $term_link ); ?>">
									<div class="cat-thumbnail">
										<img src="<?php echo esc_url( $image_url ); ?>"
										     alt="<?php esc_attr_e( 'Category Image', 'brook' ); ?>">
									</div>
									<div class="cat-content">
										<div class="inner">
											<h6 class="cat-title">
												<?php echo esc_html( $term->name ); ?>
											</h6>
											<div class="cat-count">
												<?php if ( $term->count > 1 ) { ?>
													<?php echo "$term->count items"; ?>
												<?php } else { ?>
													<?php echo "$term->count item"; ?>
												<?php } ?>
											</div>
										</div>
									</div>
								</a>
							</div>
						</div>
					<?php } ?>
				<?php } ?>
			</div>

			<?php if ( $is_swiper ) { ?>
		</div>
	</div>
<?php } ?>
</div>
