<?php
extract( $brook_shortcode_atts );

$slider_class = 'tm-swiper equal-height';

if ( $nav !== '' ) {
	$slider_class .= " nav-style-$nav";
}

if ( $pagination !== '' ) {
	$slider_class .= " pagination-style-$pagination";
}

$testimonial_slides_template = '';
$testimonial_thumbs_template = '';
?>

<div class="<?php echo esc_attr( trim( $slider_class ) ); ?>"
     data-lg-items="1"

	<?php if ( $carousel_gutter !== '' ) {
		$arr = explode( ';', $carousel_gutter );
		foreach ( $arr as $value ) {
			$tmp = explode( ':', $value );
			echo ' data-' . $tmp[0] . '-gutter="' . $tmp[1] . '"';
		}
	}
	?>

	<?php if ( $nav !== '' ) : ?>
		data-nav="1"
	<?php endif; ?>

	<?php if ( $nav === 'custom' ) : ?>
		data-custom-nav="<?php echo esc_attr( $slider_button_id ); ?>"
	<?php endif; ?>

	<?php if ( $pagination !== '' ) : ?>
		data-pagination="1"
	<?php endif; ?>

	<?php if ( $auto_play !== '' ) : ?>
		data-autoplay="<?php echo esc_attr( $auto_play ); ?>"
	<?php endif; ?>

	<?php if ( $loop === '1' ) : ?>
		data-loop="1"
	<?php endif; ?>

	 data-equal-height="1"
	 data-queue-init="0"
>
	<?php while ( $brook_query->have_posts() ) :
		$brook_query->the_post();

		$_meta = unserialize( get_post_meta( get_the_ID(), 'insight_testimonial_options', true ) );
		?>

		<?php

		$image_url = BROOK_THEME_IMAGE_URI . '/avatar-placeholder.jpg';

		if ( has_post_thumbnail() ) {
			$image_url = Brook_Image::get_the_post_thumbnail_url( array(
				'size' => '120x120',
			) );
		}

		$testimonial_thumbs_template .= '<div class="swiper-slide"><div class="post-thumbnail"><div class="thumb-wrap"><img src="' . esc_url( $image_url ) . '" alt="' . esc_attr__( 'Slide Image', 'brook' ) . '"/></div></div></div>';

		?>

		<?php ob_start(); ?>

		<div class="swiper-slide">
			<div class="testimonial-item">

				<div class="testimonial-content">
					<div class="testimonial-desc secondary-font"><?php the_content(); ?></div>
				</div>

				<?php if ( isset( $_meta['rating'] ) && $_meta['rating'] !== '' ): ?>
					<div class="testimonial-rating">
						<?php Brook_Templates::get_rating_template( $_meta['rating'] ); ?>
					</div>
				<?php endif; ?>

				<div class="testimonial-info">
					<div class="testimonial-main-info">
						<h6 class="testimonial-name"><?php the_title(); ?></h6>

						<?php if ( isset( $_meta['by_line'] ) ) : ?>
							<div class="testimonial-by-line"><?php echo ' - ' . esc_html( $_meta['by_line'] ); ?></div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
		<?php
		$testimonial_slides_template .= ob_get_contents();
		ob_end_clean();
		?>
	<?php endwhile; ?>

	<div class="tm-swiper tm-testimonial-pagination style-01 equal-height v-center h-center"
	     data-lg-items="3"
	     data-lg-gutter="30"
	     data-centered="1"
	     data-queue-init="0"
	>
		<div class="swiper-container">
			<div class="swiper-wrapper">
				<?php echo "{$testimonial_thumbs_template}"; ?>
			</div>
		</div>
	</div>


	<div class="swiper-container">
		<div class="swiper-wrapper">
			<?php echo "{$testimonial_slides_template}"; ?>
		</div>
	</div>
</div>
