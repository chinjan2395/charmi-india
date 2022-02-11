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
							'width'  => 480,
							'height' => 320,
						) );
						?>
					</a>
				</div>
			<?php } ?>

			<div class="post-info">
				<div class="post-meta">
					<?php get_template_part( 'loop/blog/date' ); ?>
				</div>

				<?php get_template_part( 'loop/blog/title' ); ?>

				<div class="post-excerpt">
					<?php Brook_Templates::excerpt( array(
						'limit' => 10,
						'type'  => 'word',
					) ); ?>
				</div>

			</div>

		</div>
	</div>
<?php endwhile;
