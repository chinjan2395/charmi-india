<?php
while ( $brook_query->have_posts() ) :
	$brook_query->the_post();
	$classes = array( 'grid-item', 'post-item' );
	$format  = Brook_Post::get_the_post_format();
	?>
	<div <?php post_class( implode( ' ', $classes ) ); ?>>
		<div class="post-wrapper">

			<?php get_template_part( 'loop/blog/classic/format', $format ); ?>

			<?php if ( $format !== 'quote' ) : ?>

				<div class="post-info">

					<?php get_template_part( 'loop/blog/title' ); ?>

					<div class="post-meta">

						<?php get_template_part( 'loop/blog/date' ); ?>

						<?php get_template_part( 'loop/blog/category' ); ?>

					</div>

					<?php if ( ! has_post_thumbnail() ) : ?>
						<div class="post-excerpt">
							<?php Brook_Templates::excerpt( array(
								'limit' => 40,
								'type'  => 'word',
							) ); ?>
						</div>
					<?php endif; ?>

				</div>

			<?php endif; ?>

		</div>
	</div>
<?php endwhile;
