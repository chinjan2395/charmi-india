<?php
extract( $brook_shortcode_atts );
$images = explode( ',', $images );

foreach ( $images as $image ) {
	$classes = array( 'gallery-item grid-item' );

	$image_full = Brook_Image::get_attachment_info( $image );

	if ( $image_full === false ) {
		continue;
	}

	$image_url = Brook_Image::aq_resize( array(
		'url'    => $image_full['src'],
		'width'  => 480,
		'height' => 9999,
		'crop'   => false,
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
			<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php esc_attr_e( 'Gallery Image', 'brook' ); ?>">
			<div class="overlay">
				<div><span class="fal fa-plus"></span></div>
			</div>
		</a>
	</div>
	<?php
}
