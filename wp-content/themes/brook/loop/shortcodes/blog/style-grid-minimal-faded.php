<?php
while ( $brook_query->have_posts() ) :
	$brook_query->the_post();
	$classes = array( 'post-item grid-item' );
	?>
	<div <?php post_class( implode( ' ', $classes ) ); ?>>
		<a href="<?php the_permalink(); ?>" class="post-permalink link-secret">
			<div class="post-wrapper">

				<div class="post-info">

					<div class="post-meta">

						<?php get_template_part( 'loop/blog/date' ); ?>

						<?php get_template_part( 'loop/blog/category', 'no-link' ); ?>

					</div>

					<h3 class="post-title">
						<?php the_title(); ?>
					</h3>

					<div class="post-author">
						<h6><?php echo get_the_author(); ?></h6>
					</div>

				</div>

			</div>
		</a>
	</div>
<?php endwhile;
