<?php
while ( $brook_query->have_posts() ) :
	$brook_query->the_post();
	$classes = array( 'grid-item', 'post-item' );
	?>
	<div <?php post_class( implode( ' ', $classes ) ); ?>>
		<div class="post-wrapper">

			<?php if ( has_post_thumbnail() ) { ?>
				<div class="post-feature post-thumbnail">
					<a href="<?php the_permalink(); ?>">
						<?php
						Brook_Image::the_post_thumbnail( array(
							'size'   => 'custom',
							'width'  => 670,
							'height' => 506,
						) );
						?>
					</a>
				</div>
			<?php } ?>

			<div class="post-info">

				<?php get_template_part( 'loop/blog/title' ); ?>

				<div class="post-meta">

					<?php get_template_part( 'loop/blog/date' ); ?>

					<?php get_template_part( 'loop/blog/category' ); ?>

				</div>

				<div class="post-excerpt">
					<?php Brook_Templates::excerpt( array(
						'limit' => 45,
						'type'  => 'word',
					) ); ?>
				</div>
			</div>

		</div>
	</div>
<?php endwhile;
