<?php
while ( $brook_query->have_posts() ) :
	$brook_query->the_post();
	$classes = array( 'grid-item', 'post-item' );
	$format  = Brook_Post::get_the_post_format();
	?>
	<div <?php post_class( implode( ' ', $classes ) ); ?>>
		<a href="<?php the_permalink(); ?>" class="post-permalink link-secret">
			<div class="post-wrapper">
				<?php if ( has_post_thumbnail() ) { ?>
					<div class="post-feature post-thumbnail">
						<?php
						Brook_Image::the_post_thumbnail( array(
							'size'   => 'custom',
							'width'  => 370,
							'height' => 244,
						) );
						?>
					</div>
				<?php } ?>

				<div class="post-info">
					<div class="post-meta">

						<?php get_template_part( 'loop/blog/date' ); ?>

						<?php get_template_part( 'loop/blog/category', 'no-link' ); ?>

					</div>

					<h3 class="post-title"><?php the_title(); ?></h3>

					<?php if ( ! has_post_thumbnail() ) : ?>
						<div class="post-excerpt">
							<?php Brook_Templates::excerpt( array(
								'limit' => 40,
								'type'  => 'word',
							) ); ?>
						</div>
					<?php endif; ?>

					<div class="post-read-more"></div>

				</div>
			</div>
		</a>
	</div>
<?php endwhile;
