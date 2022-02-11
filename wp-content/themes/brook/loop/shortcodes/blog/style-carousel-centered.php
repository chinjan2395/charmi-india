<?php
while ( $brook_query->have_posts() ) :
	$brook_query->the_post();
	$classes = array( 'grid-item post-item swiper-slide' );
	$format  = Brook_Post::get_the_post_format();
	?>
	<div <?php post_class( implode( ' ', $classes ) ); ?>>
		<div class="post-wrapper">

			<div class="post-thumbnail">
				<?php if ( has_post_thumbnail() ) { ?>
					<?php
					Brook_Image::the_post_thumbnail( array(
						'size' => '1170x600',
					) );
					?>
				<?php } ?>
			</div>

			<div class="post-info">
				<div class="post-info-line"><?php get_template_part( 'loop/blog/title' ); ?></div>

				<div class="post-info-line">
					<div class="post-meta">

						<?php get_template_part( 'loop/blog/date' ); ?>

						<?php get_template_part( 'loop/blog/category' ); ?>

					</div>
				</div>
			</div>

		</div>
	</div>
<?php endwhile;
