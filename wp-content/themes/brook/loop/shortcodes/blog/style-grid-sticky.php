<?php
while ( $brook_query->have_posts() ) :
	$brook_query->the_post();
	$classes = array( 'post-item grid-item' );
	$format  = Brook_Post::get_the_post_format();
	?>
	<div <?php post_class( implode( ' ', $classes ) ); ?>>
		<a href="<?php the_permalink(); ?>" class="post-permalink link-secret">
			<div class="post-wrapper">

				<?php if ( has_post_thumbnail() ) { ?>
					<div class="post-overlay"
						<?php
						$url = Brook_Image::get_the_post_thumbnail_url( array(
							'size'   => 'custom',
							'width'  => 480,
							'height' => 480,
						) );
						?>
						 style="background-image: url(<?php echo esc_url( $url ); ?>)">
					</div>
				<?php } ?>

				<div class="post-content">
					<div class="post-info">

						<?php if ( $format === 'video' ) : ?>
							<div class="post-video">
								<span class="icon"></span>
							</div>
						<?php endif; ?>

						<div class="content-inner">
							<?php if ( $format === 'quote' ) : ?>
								<?php get_template_part( 'loop/blog/format-quote', 'no-link' ); ?>
							<?php else: ?>

								<div class="post-meta">

									<?php get_template_part( 'loop/blog/date' ); ?>

									<?php get_template_part( 'loop/blog/category', 'no-link' ); ?>

								</div>

								<h3 class="post-title"><?php the_title(); ?></h3>

							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</a>
	</div>
<?php endwhile;
