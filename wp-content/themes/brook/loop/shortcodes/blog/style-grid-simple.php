<?php
while ( $brook_query->have_posts() ) :
	$brook_query->the_post();
	$classes = array( 'grid-item', 'post-item' );
	$format  = Brook_Post::get_the_post_format();
	?>
	<div <?php post_class( implode( ' ', $classes ) ); ?>>
		<div class="post-wrapper">

			<?php if ( has_post_thumbnail() ) { ?>
				<div class="post-feature post-thumbnail">
					<a href="<?php the_permalink(); ?>">
						<?php
						Brook_Image::the_post_thumbnail( array(
							'size'   => 'custom',
							'width'  => 370,
							'height' => 250,
						) );
						?>
					</a>
				</div>
			<?php } ?>

			<div class="post-info">
				<div class="post-meta">

					<?php get_template_part( 'loop/blog/date' ); ?>

					<?php get_template_part( 'loop/blog/category' ); ?>

				</div>

				<?php get_template_part( 'loop/blog/title' ); ?>

				<?php if ( ! has_post_thumbnail() ) : ?>
					<div class="post-excerpt">
						<?php Brook_Templates::excerpt( array(
							'limit' => 40,
							'type'  => 'word',
						) ); ?>
					</div>
				<?php endif; ?>

			</div>

		</div>
	</div>
<?php endwhile;
