<?php
while ( $brook_query->have_posts() ) :
	$brook_query->the_post();
	$classes = array( 'portfolio-item grid-item swiper-slide' );

	$url = false;

	if ( has_post_thumbnail() ) {
		$url = Brook_Image::get_the_post_thumbnail_url( array(
			'size'   => 'custom',
			'width'  => 1920,
			'height' => 1280,
		) );
	}
	?>
	<div <?php post_class( implode( ' ', $classes ) ); ?>>
		<div class="post-wrapper">

			<?php if ( $url ) : ?>
				<div class="post-overlay" style="background-image: url(<?php echo esc_url( $url ); ?>)"></div>
			<?php endif; ?>

			<div class="post-content">

				<div class="inner">

					<div class="post-info">
						<?php Brook_Portfolio::the_categories(); ?>

						<h3 class="post-title">
							<a href="<?php Brook_Portfolio::the_permalink(); ?>"
							   class="post-permalink link-secret"><?php the_title(); ?></a>
						</h3>

						<a href="<?php Brook_Portfolio::the_permalink(); ?>"
						   class="tm-button style-solid tm-button-white post-read-more">
							<?php esc_html_e( 'View project', 'brook' ); ?>
						</a>
					</div>

				</div>

			</div>

		</div>
	</div>
<?php endwhile; ?>
