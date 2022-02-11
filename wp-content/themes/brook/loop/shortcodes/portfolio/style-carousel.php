<?php
while ( $brook_query->have_posts() ) :
	$brook_query->the_post();
	$classes = array( 'portfolio-item grid-item swiper-slide' );
	?>
	<div <?php post_class( implode( ' ', $classes ) ); ?>>
		<div class="post-wrapper">
			<a href="<?php Brook_Portfolio::the_permalink(); ?>" class="post-permalink link-secret">

				<div class="post-thumbnail-wrapper">
					<div class="post-thumbnail">
						<?php
						if ( has_post_thumbnail() ) { ?>
							<?php
							Brook_Image::the_post_thumbnail( array(
								'size'   => 'custom',
								'width'  => 370,
								'height' => 560,
							) );
							?>
						<?php } else {
							Brook_Templates::image_placeholder( 370, 560 );
						}
						?>

					</div>
					<?php if ( $overlay_style !== '' ) : ?>
						<?php get_template_part( 'loop/portfolio/overlay', $overlay_style ); ?>
					<?php endif; ?>
				</div>

			</a>
		</div>
	</div>
<?php endwhile; ?>
