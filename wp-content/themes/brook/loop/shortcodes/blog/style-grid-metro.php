<?php
if ( isset( $metro_layout ) ) {
	$metro_layout = (array) vc_param_group_parse_atts( $metro_layout );
	$_sizes       = array();
	foreach ( $metro_layout as $key => $value ) {
		$_sizes[] = $value['size'];
	}
	$metro_layout = $_sizes;
} else {
	$metro_layout = array(
		'2:2',
		'1:1',
		'1:1',
		'2:2',
		'1:1',
		'1:1',
	);
}

if ( count( $metro_layout ) < 1 ) {
	return;
}

$metro_layout_count = count( $metro_layout );
$metro_item_count   = 0;

while ( $brook_query->have_posts() ) :
	$brook_query->the_post();

	$classes = array( 'post-item grid-item' );

	if ( in_array( $metro_layout[ $metro_item_count ], array(
		'2:1',
		'2:2',
	), true ) ) {
		$classes[] = 'grid-width-2';
	}

	if ( in_array( $metro_layout[ $metro_item_count ], array(
		'1:2',
		'2:2',
	), true ) ) {
		$classes[] = 'grid-height-2';
	}

	$_image_width  = 480;
	$_image_height = 480;
	if ( $metro_layout[ $metro_item_count ] === '2:1' ) {
		$_image_width  = 960;
		$_image_height = 480;
	} elseif ( $metro_layout[ $metro_item_count ] === '1:2' ) {
		$_image_width  = 480;
		$_image_height = 960;
	} elseif ( $metro_layout[ $metro_item_count ] === '2:2' ) {
		$_image_width  = 960;
		$_image_height = 960;
	}

	$url = false;

	if ( has_post_thumbnail() ) {
		$url = Brook_Image::get_the_post_thumbnail_url( array(
			'size'   => 'custom',
			'width'  => $_image_width,
			'height' => $_image_height,
		) );
	}

	if ( $url !== false ) {
		$classes[] = 'post-valid-thumbnail';
	} else {
		$classes[] = 'post-invalid-thumbnail';
	}
	?>
	<div <?php post_class( implode( ' ', $classes ) ); ?>>

		<a href="<?php the_permalink(); ?>" class="post-permalink link-secret">
			<div class="post-wrapper">

				<?php if ( $url ) : ?>
					<div class="post-overlay" style="background-image: url(<?php echo esc_url( $url ); ?>)"></div>
				<?php endif; ?>

				<div class="post-content">
					<div class="post-info">

						<?php if ( $url ) { ?>
							<div class="post-meta">

								<?php get_template_part( 'loop/blog/date' ); ?>

								<?php get_template_part( 'loop/blog/category', 'no-link' ); ?>

							</div>

							<h3 class="post-title"><?php the_title(); ?></h3>

						<?php } else { ?>

							<h3 class="post-title"><?php the_title(); ?></h3>

							<div class="post-meta">

								<?php get_template_part( 'loop/blog/date' ); ?>

								<?php get_template_part( 'loop/blog/category', 'no-link' ); ?>

							</div>

							<div class="post-excerpt">
								<?php Brook_Templates::excerpt( array(
									'limit' => 48,
									'type'  => 'word',
								) ); ?>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</a>

	</div>
	<?php
	$metro_item_count++;
	if ( $metro_item_count == $count || $metro_layout_count == $metro_item_count ) {
		$metro_item_count = 0;
	}
	?>
<?php endwhile;
