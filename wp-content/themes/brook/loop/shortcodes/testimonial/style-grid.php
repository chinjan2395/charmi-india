<?php
extract( $brook_shortcode_atts );

wp_enqueue_script( 'isotope-packery' );

$inner_class = 'tm-grid-wrapper';
?>

<div class="<?php echo esc_attr( trim( $inner_class ) ); ?>"
     data-type="masonry"

	<?php if ( $columns !== '' ): ?>
		<?php
		$arr = explode( ';', $columns );
		foreach ( $arr as $value ) {
			$tmp = explode( ':', $value );
			echo ' data-' . $tmp[0] . '-columns="' . esc_attr( $tmp[1] ) . '"';
		}
		?>

		<?php if ( $gutter !== '' && $gutter !== 0 ) : ?>
			data-gutter="<?php echo esc_attr( $gutter ); ?>"
		<?php endif; ?>
	<?php endif; ?>
>
	<div class="tm-grid">

		<div class="grid-sizer"></div>

		<?php while ( $brook_query->have_posts() ) :
			$brook_query->the_post();

			$_meta = unserialize( get_post_meta( get_the_ID(), 'insight_testimonial_options', true ) );
			?>
			<div class="grid-item">
				<div class="testimonial-item">

					<div class="testimonial-content">
						<?php if ( isset( $_meta['rating'] ) && $_meta['rating'] !== '' ): ?>
							<div class="testimonial-rating">
								<?php Brook_Templates::get_rating_template( $_meta['rating'] ); ?>
							</div>
						<?php endif; ?>

						<div class="testimonial-desc"><?php the_content(); ?></div>
					</div>

					<div class="testimonial-info">
						<?php if ( has_post_thumbnail() ): ?>
							<div class="post-thumbnail">
								<?php Brook_Image::the_post_thumbnail( array( 'size' => '60x60' ) ); ?>
							</div>
						<?php endif; ?>

						<div class="testimonial-main-info">
							<h6 class="testimonial-name"><?php the_title(); ?></h6>

							<?php if ( isset( $_meta['by_line'] ) ) : ?>
								<div class="testimonial-by-line"><?php echo esc_html( $_meta['by_line'] ); ?></div>
							<?php endif; ?>
						</div>
					</div>

					<div class="testimonial-quote-icon">
						<span class="fa fa-quote-right"></span>
					</div>
				</div>
			</div>

		<?php endwhile; ?>
	</div>
</div>
