<?php
while ( $brook_query->have_posts() ) :
	$brook_query->the_post();
	$classes = array( 'portfolio-item grid-item' );

	$video = Brook_Portfolio::get_the_post_meta( 'portfolio_video_url' );

	$thumbnail_wrapper_class = 'post-thumbnail-wrapper';

	$feature_permalink = get_the_permalink();
	if ( $video !== '' ) {
		$feature_permalink = $video;

		$thumbnail_wrapper_class .= ' tm-popup-video style-poster-01 poster-full-wide';
	}
	?>
	<div <?php post_class( implode( ' ', $classes ) ); ?>>
		<div class="post-wrapper">
			<div class="<?php echo esc_attr( $thumbnail_wrapper_class ); ?>">
				<a href="<?php echo esc_url( $feature_permalink ); ?>" class="video-link">

					<div class="post-thumbnail">

						<?php if ( $video !== '' ) { ?>
							<div class="video-poster">

								<?php if ( has_post_thumbnail() ) { ?>
									<?php Brook_Image::the_post_thumbnail( array(
										'size' => $image_size,
									) ); ?>
								<?php } else { ?>
									<?php Brook_Templates::image_placeholder( 480, 480 ); ?>
								<?php } ?>

							</div>
							<div class="video-overlay">
								<div class="video-button">
									<div class="video-play">
										<span class="video-play-icon"></span>
									</div>
								</div>
							</div>
						<?php } else { ?>
							<?php if ( has_post_thumbnail() ) { ?>
								<?php Brook_Image::the_post_thumbnail( array(
									'size' => $image_size,
								) ); ?>
							<?php } else { ?>
								<?php Brook_Templates::image_placeholder( 480, 480 ); ?>
							<?php } ?>
						<?php } ?>
					</div>
				</a>
			</div>

			<a href="<?php Brook_Portfolio::the_permalink(); ?>" class="post-permalink link-secret">
				<div class="post-info">
					<h3 class="post-title"><?php the_title(); ?></h3>

					<?php
					$terms = get_the_terms( $post->ID, 'portfolio_category' );
					if ( is_array( $terms ) ) { ?>
						<div class="post-categories">
							<?php
							$separator = ', ';
							$_c        = 0;
							$tem       = '';
							foreach ( $terms as $term ) {
								if ( $_c > 0 ) {
									$tem .= $separator;
								}

								$tem .= $term->name;

								$_c++;
							}

							echo esc_html( $tem );
							?>
						</div>
					<?php } ?>

				</div>
			</a>

		</div>
	</div>
<?php endwhile; ?>
