<?php
while ( $brook_query->have_posts() ) :
	$brook_query->the_post();
	$classes = array( 'portfolio-item grid-item swiper-slide' );
	?>
	<div <?php post_class( implode( ' ', $classes ) ); ?>>
		<div class="post-wrapper">
			<a href="<?php Brook_Portfolio::the_permalink(); ?>">
				<div class="post-thumbnail">

					<?php
					if ( has_post_thumbnail() ) { ?>
						<?php
						Brook_Image::the_post_thumbnail( array(
							'size'   => 'custom',
							'width'  => 9999,
							'height' => 550,
							'crop'   => false,
						) );
						?>
					<?php } else {
						Brook_Templates::image_placeholder( 600, 550 );
					}
					?>

				</div>

				<?php if ( $overlay_style !== '' ) : ?>
					<?php get_template_part( 'loop/portfolio/overlay', $overlay_style ); ?>
				<?php endif; ?>
			</a>
		</div>
	</div>
<?php endwhile; ?>
