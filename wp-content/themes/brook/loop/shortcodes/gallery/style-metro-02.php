<?php
extract( $brook_shortcode_atts );
$images = explode( ',', $images );
$count  = count( $images );

if ( $metro_layout ) {
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

foreach ( $images as $image ) {
	$classes = array( 'gallery-item grid-item' );

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

	$image_full = Brook_Image::get_attachment_info( $image );

	if ( $image_full === false ) {
		continue;
	}

	$image_url = Brook_Image::aq_resize( array(
		'url'    => $image_full['src'],
		'width'  => $_image_width,
		'height' => $_image_height,
		'crop'   => true,
	) );
	$_sub_html = '';
	if ( $image_full['title'] !== '' ) {
		$_sub_html .= "<h4>{$image_full['title']}</h4>";
	}

	if ( $image_full['caption'] !== '' ) {
		$_sub_html .= "<p>{$image_full['caption']}</p>";
	}
	?>
	<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
		<a href="<?php echo esc_url( $image_full['src'] ); ?>" class="zoom"
		   data-sub-html="<?php echo esc_attr( $_sub_html ); ?>">

			<div class="item-wrapper" style="background-image: url( <?php echo esc_url( $image_url ); ?> );"></div>

			<div class="overlay">
				<div><span class="fal fa-plus"></span></div>
			</div>

		</a>
	</div>
	<?php
	$metro_item_count++;
	if ( $metro_item_count == $count || $metro_layout_count == $metro_item_count ) {
		$metro_item_count = 0;
	}
	?>
<?php }
