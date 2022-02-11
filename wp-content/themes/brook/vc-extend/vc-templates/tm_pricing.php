<?php
defined( 'ABSPATH' ) || exit;

$style = $el_class = $items = $featured = $animation = '';
$price = $currency = $period = $title = $desc = $icon_type = $icon_classes = '';
$atts  = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass( $el_class );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-pricing ' . $el_class, $this->settings['base'], $atts );
$css_class .= " style-$style";

$css_class .= Brook_Helper::get_animation_classes( $animation );

if ( isset( ${"icon_" . $icon_type} ) ) {
	$icon_classes = esc_attr( ${"icon_" . $icon_type} );

	vc_icon_element_fonts_enqueue( $icon_type );
}

$_button_classes = 'tm-button style-flat smooth-scroll-link tm-pricing-button';

if ( $featured === '1' ) {
	$css_class .= ' tm-pricing-featured';
}

$css_id = uniqid( 'tm-pricing-' );
$this->get_inline_css( '#' . $css_id, $atts );

$items = (array) vc_param_group_parse_atts( $items );
?>

<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>">
	<div class="inner">

		<div class="tm-pricing-header">

			<?php if ( $featured === '1' ) : ?>
				<?php if ( $style === '02' ): ?>
					<div class="tm-pricing-feature-mark">
						<?php esc_html_e( 'Popular', 'brook' ); ?>
					</div>
				<?php else: ?>
					<div class="tm-pricing-feature-mark">
						<?php esc_html_e( 'Popular Choice', 'brook' ); ?>
					</div>
				<?php endif; ?>

			<?php endif; ?>

			<?php if ( $image !== '' ) {
				$image_template = wp_get_attachment_image( $image, 'full' );
				if ( ! $image_template ) :
					echo '<div class="image">' . $image_template . '</div>';
				endif;
			}
			?>

			<?php if ( $style === '02' ): ?>
				<h5 class="title"><?php echo esc_html( $title ); ?></h5>

				<?php if ( $desc !== '' ) : ?>
					<div class="description"><?php echo esc_html( $desc ); ?></div>
				<?php endif; ?>
			<?php endif; ?>

			<?php if ( $icon_classes !== '' ) : ?>
				<div class="icon">
					<span class="<?php echo esc_attr( $icon_classes ); ?>"></span>
				</div>
			<?php endif; ?>

			<?php if ( $currency && $price !== '' ) : ?>

				<div class="price-wrap">
					<div class="price-wrap-inner">
						<h6 class="currency"><?php echo esc_html( $currency ); ?></h6>
						<h6 class="price"><?php echo esc_html( $price ); ?></h6>

						<?php if ( $period !== '' ) : ?>
							<h6 class="period"><?php echo esc_html( $period ); ?></h6>
						<?php endif; ?>
					</div>
				</div>

			<?php endif; ?>
		</div>
		<div class="tm-pricing-content">

			<?php if ( $style === '01' ): ?>
				<h5 class="title"><?php echo esc_html( $title ); ?></h5>

				<?php if ( $desc !== '' ) : ?>
					<div class="description"><?php echo esc_html( $desc ); ?></div>
				<?php endif; ?>
			<?php endif; ?>

			<?php if ( count( $items ) > 0 ) { ?>
				<ul class="tm-pricing-list">
					<?php
					foreach ( $items as $data ) { ?>
						<?php
						$item_class = 'pricing-item';

						if ( isset( $data['available'] ) && $data['available'] === '1' ) {
							$item_class .= ' item-available';
						}
						?>

						<li class="<?php echo esc_attr( $item_class ); ?>">
							<?php if ( isset( $data['icon'] ) ) : ?>
								<i class="feature-icon <?php echo esc_attr( $data['icon'] ); ?>"></i>
							<?php endif; ?>
							<?php if ( isset( $data['text'] ) ) : ?>
								<?php echo '<span class="feature-text">' . esc_html( $data['text'] ) . '</span>'; ?>
							<?php endif; ?>
						</li>
						<?php
					}
					?>
				</ul>
			<?php } ?>
		</div>

		<?php if ( $button_type === 'product' ): ?>
			<div class="tm-pricing-footer">
				<?php
				$_brook_args = array(
					'post_type'      => 'product',
					'post__in'       => array( $product ),
					'posts_per_page' => 1,
					'post_status'    => 'publish',
					'no_found_rows'  => true,
				);

				$_brook_query = new WP_Query( $_brook_args );
				add_filter( 'woocommerce_add_to_cart_tooltip_position', '__return_none_string' );
				if ( $_brook_query->have_posts() ) {
					while ( $_brook_query->have_posts() ) : $_brook_query->the_post();
						woocommerce_template_loop_add_to_cart();
					endwhile;
					wp_reset_postdata();
				}
				?>
			</div>
		<?php else: ?>
			<?php $button = vc_build_link( $button ); ?>
			<?php if ( $button['url'] !== '' ) { ?>
				<div class="tm-pricing-footer">
					<?php
					$_button_title = $button['title'] != '' ? $button['title'] : esc_html__( 'Sign Up', 'brook' );
					printf( '<a href="%s" %s %s class="%s">%s</a>', $button['url'], $button['target'] != '' ? 'target="' . esc_attr( $button['target'] ) . '"' : '', $button['rel'] != '' ? 'rel="' . esc_attr( $button['rel'] ) . '"' : '', $_button_classes, $_button_title );
					?>
				</div>
			<?php } ?>
		<?php endif; ?>


	</div>
</div>
