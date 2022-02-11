<?php
if ( $metro_layout ) {
	$metro_layout = (array) vc_param_group_parse_atts( $metro_layout );
	$_sizes       = array();
	foreach ( $metro_layout as $key => $value ) {
		$_sizes[] = $value['size'];
	}
	$metro_layout = $_sizes;
} else {
	$metro_layout = array(
		'1:1',
		'2:2',
		'1:2',
		'1:1',
		'1:1',
		'2:1',
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

	$classes = array( 'portfolio-item grid-item' );

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

	$_image_width  = 255;
	$_image_height = 370;
	if ( $metro_layout[ $metro_item_count ] === '2:1' ) {
		$_image_width  = 560;
		$_image_height = 370;
	} elseif ( $metro_layout[ $metro_item_count ] === '1:2' ) {
		$_image_width  = 255;
		$_image_height = 740;
	} elseif ( $metro_layout[ $metro_item_count ] === '2:2' ) {
		$_image_width  = 560;
		$_image_height = 740;
	}

	$_url = Brook_Image::get_the_post_thumbnail_url( array(
		'size'   => 'custom',
		'width'  => $_image_width,
		'height' => $_image_height,
	) );
	?>
	<div <?php post_class( implode( ' ', $classes ) ); ?>>
		<a href="<?php Brook_Portfolio::the_permalink(); ?>" class="post-permalink link-secret">
			<div class="post-wrapper">

				<div class="post-thumbnail">
					<div class="thumbnail" style="background-image: url( <?php echo esc_url( $_url ); ?> );"></div>
					<div class="post-view-detail"></div>
				</div>

				<div class="post-info">
					<h3 class="post-title"><?php the_title(); ?></h3>

					<?php
					$terms = get_the_terms( $post->ID, 'portfolio_category' );
					if ( is_array( $terms ) ) { ?>
						<div class="post-categories">
							<?php
							$separator = ', ';
							$_c        = 0;
							$tem       = '';
							foreach ( $terms as $term ) {
								if ( $_c > 0 ) {
									$tem .= $separator;
								}

								$tem .= $term->name;

								$_c++;
							}

							echo esc_html( $tem );
							?>
						</div>
					<?php } ?>

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
<?php endwhile; ?>
