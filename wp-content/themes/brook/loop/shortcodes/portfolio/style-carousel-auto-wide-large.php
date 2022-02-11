<?php
while ( $brook_query->have_posts() ) :
	$brook_query->the_post();
	$classes = array( 'portfolio-item grid-item swiper-slide' );
	?>
	<div <?php post_class( implode( ' ', $classes ) ); ?>>
		<a href="<?php Brook_Portfolio::the_permalink(); ?>" class="post-permalink link-secret">
			<div class="post-wrapper">
				<div class="post-thumbnail">
					<?php
					if ( has_post_thumbnail() ) { ?>
						<?php
						Brook_Image::the_post_thumbnail( array(
							'size'   => 'custom',
							'width'  => 480,
							'height' => 1000,
							'crop'   => true,
						) );
						?>
					<?php } else {
						Brook_Templates::image_placeholder( 480, 1000 );
					}
					?>
				</div>

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
			</div>
		</a>
	</div>
<?php endwhile; ?>
