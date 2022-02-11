<div class="grid-sizer"></div>
<?php
$_image_width = 480;
if ( $masonry_image_size_width && $masonry_image_size_width !== '' ) {
	$_image_width = intval( $masonry_image_size_width );
}
while ( $brook_query->have_posts() ) :
	$brook_query->the_post();

	$classes = array( 'portfolio-item grid-item' );
	?>
	<div <?php post_class( implode( ' ', $classes ) ); ?>>
		<div class="post-wrapper">
			<a href="<?php Brook_Portfolio::the_permalink(); ?>" class="post-permalink link-secret">

				<div class="post-thumbnail-wrapper">
					<div class="post-thumbnail">
						<?php if ( has_post_thumbnail() ) { ?>
							<?php Brook_Image::the_post_thumbnail( array(
								'size'   => 'custom',
								'width'  => $_image_width,
								'height' => 9999,
								'crop'   => false,
							) ); ?>
						<?php } else { ?>
							<?php Brook_Templates::image_placeholder( 480, 480 ); ?>
						<?php } ?>

					</div>

					<?php if ( $overlay_style !== '' ) : ?>
						<?php get_template_part( 'loop/portfolio/overlay', $overlay_style ); ?>
					<?php endif; ?>

				</div>
			</a>
		</div>
	</div>
<?php endwhile; ?>
