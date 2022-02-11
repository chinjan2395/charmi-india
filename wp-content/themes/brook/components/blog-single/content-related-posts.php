<?php
$number_post = Brook::setting( 'single_post_related_number' );
$results     = Brook_Post::get_related_posts( array(
	'post_id'      => get_the_ID(),
	'number_posts' => $number_post,
) );

if ( $results !== false && $results->have_posts() ) : ?>
	<div class="related-posts">
		<h3 class="related-title">
			<?php esc_html_e( 'Related Posts', 'brook' ); ?>
		</h3>
		<div class="tm-swiper equal-height"
		     data-lg-items="2"
		     data-md-items="2"
		     data-sm-items="1"
		     data-pagination="1"
		     data-slides-per-group="inherit"
		>
			<div class="swiper-container">
				<div class="swiper-wrapper">
					<?php while ( $results->have_posts() ) : $results->the_post(); ?>
						<?php
						$format = Brook_Post::get_the_post_format();
						?>
						<div class="swiper-slide">
							<div class="related-post-item">

								<div class="post-wrapper"
								>

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

									<a href="<?php the_permalink(); ?>" class="post-permalink">
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
									</a>

								</div>

							</div>
						</div>
					<?php endwhile; ?>
				</div>
			</div>
		</div>
	</div>
<?php endif;
wp_reset_postdata();
