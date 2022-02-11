<?php
while ( $brook_query->have_posts() ) :
	$brook_query->the_post();
	$classes = array( 'grid-item', 'post-item' );
	$format  = Brook_Post::get_the_post_format();
	?>
	<div <?php post_class( implode( ' ', $classes ) ); ?>>
		<div class="post-wrapper"
		>

			<div class="post-overlay"
				<?php if ( has_post_thumbnail() ) { ?>
					<?php
					$url = Brook_Image::get_the_post_thumbnail_url( array(
						'size'   => 'custom',
						'width'  => 770,
						'height' => 220,
					) );
					?>
					style="background-image: url(<?php echo esc_url( $url ); ?>)"
				<?php } ?>
			>
			</div>


			<a href="<?php the_permalink(); ?>" class="post-permalink">
				<div class="post-info">

					<div class="post-video">

					</div>

					<h3 class="post-title">
						<?php the_title(); ?>
					</h3>

					<div class="post-meta">

						<?php get_template_part( 'loop/blog/date' ); ?>

						<?php get_template_part( 'loop/blog/category', 'no-link' ); ?>

					</div>

					<div class="post-read-more heading-color">
						<span class="fa fa-arrow-right post-read-more-icon"></span>
					</div>

				</div>
			</a>
		</div>
	</div>
<?php endwhile;
