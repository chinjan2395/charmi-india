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

					<div class="testimonial-content">
						<div class="testimonial-quote-icon">
							<svg width="51px" height="39px" viewBox="0 0 51 39" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
								<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" opacity="0.0797061012">
									<g transform="translate(-1207.000000, -3044.000000)" fill="#000000" fill-rule="nonzero">
										<path d="M1230,3083 L1230,3064.56592 L1220.9011,3064.56592 L1220.9011,3063.1865 C1220.9011,3056.9164 1223.21795,3053.78135 1227.85165,3053.78135 L1227.85165,3053.78135 L1227.85165,3044 C1221.02747,3044 1215.84615,3046.06913 1212.30769,3050.2074 C1208.76923,3054.34566 1207,3059.63344 1207,3066.07074 C1207,3071.67203 1208.09524,3077.31511 1210.28571,3083 L1210.28571,3083 L1230,3083 Z M1258,3083 L1258,3064.56592 L1248.85083,3064.56592 L1248.85083,3063.1865 C1248.85083,3056.9164 1251.18048,3053.78135 1255.83978,3053.78135 L1255.83978,3053.78135 L1255.83978,3044 C1248.9779,3044 1243.78913,3046.06913 1240.27348,3050.2074 C1236.75783,3054.34566 1235,3059.63344 1235,3066.07074 C1235,3071.92283 1236.05893,3077.56592 1238.1768,3083 L1238.1768,3083 L1258,3083 Z"></path>
									</g>
								</g>
							</svg>
						</div>

						<div class="testimonial-desc"><?php the_content(); ?></div>
					</div>

				</div>
			</div>

		<?php endwhile; ?>
	</div>
</div>
