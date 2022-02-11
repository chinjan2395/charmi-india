<?php
while ( $brook_query->have_posts() ) :
	$brook_query->the_post();
	$classes = array( 'portfolio-item grid-item swiper-slide' );
	?>
	<div <?php post_class( implode( ' ', $classes ) ); ?>>
		<div class="post-wrapper">
			<div class="post-thumbnail">
				<a href="<?php Brook_Portfolio::the_permalink(); ?>">
					<?php
					if ( has_post_thumbnail() ) { ?>
						<?php
						Brook_Image::the_post_thumbnail( array(
							'size'   => 'custom',
							'width'  => 9999,
							'height' => 600,
							'crop'   => false,
						) );
						?>
					<?php } else {
						Brook_Templates::image_placeholder( 600, 600 );
					}
					?>
				</a>
			</div>

			<div class="post-info">
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

				<h3 class="post-title secondary-font"><a
						href="<?php Brook_Portfolio::the_permalink(); ?>"><?php the_title(); ?></a></h3>

				<div class="post-read-more">
					<a href="<?php Brook_Portfolio::the_permalink(); ?>">
						<span class="button-text"><?php esc_html_e( 'Project details', 'brook' ); ?></span>
						<span class="button-icon fa fa-arrow-right"></span>
					</a>
				</div>

			</div>
		</div>
	</div>
<?php endwhile; ?>
