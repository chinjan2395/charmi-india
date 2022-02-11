<?php
while ( $brook_query->have_posts() ) :
	$brook_query->the_post();
	$classes = array( 'post-item grid-item' );
	$format  = Brook_Post::get_the_post_format();
	?>
	<div <?php post_class( implode( ' ', $classes ) ); ?>>
		<a href="<?php the_permalink(); ?>" class="post-permalink link-secret">
			<div class="post-wrapper">

				<div class="post-overlay"
					<?php if ( has_post_thumbnail() ) { ?>
						<?php
						$url = Brook_Image::get_the_post_thumbnail_url( array(
							'size'   => 'custom',
							'width'  => 350,
							'height' => 252,
						) );
						?>
						style="background-image: url(<?php echo esc_url( $url ); ?>)"
					<?php } ?>
				>
				</div>

				<div class="post-info">

					<?php if ( $format === 'quote' ) { ?>

						<?php get_template_part( 'loop/blog/format-quote-no-link' ); ?>

					<?php } else { ?>
						<h3 class="post-title">
							<?php the_title(); ?>
						</h3>
					<?php } ?>

					<div class="post-meta">

						<?php get_template_part( 'loop/blog/date' ); ?>

						<?php get_template_part( 'loop/blog/category', 'no-link' ); ?>

					</div>

				</div>

			</div>
		</a>
	</div>
<?php endwhile;
