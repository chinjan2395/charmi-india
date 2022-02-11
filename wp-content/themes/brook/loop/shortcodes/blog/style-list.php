<?php
while ( $brook_query->have_posts() ) :
	$brook_query->the_post();
	$classes = array( 'grid-item', 'post-item' );
	$format  = Brook_Post::get_the_post_format();

	$post_info = true;

	if ( $format === 'quote' ) {
		$post_options = unserialize( get_post_meta( get_the_ID(), 'insight_post_options', true ) );
		$quote_text   = Brook_Helper::get_the_post_meta( $post_options, 'post_quote_text', '' );

		if ( $post_options !== false && $quote_text !== '' ) {
			$post_info = false;
		}
	}
	?>
	<div <?php post_class( implode( ' ', $classes ) ); ?>>
		<div class="post-wrapper">

			<?php get_template_part( 'loop/blog/format', $format ); ?>

			<?php if ( $post_info === true ) : ?>

				<div class="post-info">

					<?php get_template_part( 'loop/blog/title' ); ?>

					<div class="post-meta">

						<?php get_template_part( 'loop/blog/date' ); ?>

						<?php get_template_part( 'loop/blog/category' ); ?>

						<?php get_template_part( 'loop/blog/sticky' ); ?>

					</div>

					<div class="post-excerpt">
						<?php Brook_Templates::excerpt( array(
							'limit' => 45,
							'type'  => 'word',
						) ); ?>
					</div>
				</div>

			<?php endif; ?>

		</div>
	</div>
<?php endwhile;
