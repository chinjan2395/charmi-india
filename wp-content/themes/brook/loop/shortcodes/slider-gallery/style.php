<?php
$gutter          = $nav = $slider_button_id = $pagination = $auto_play = $loop = '';
$lightbox_enable = '';
$image_size      = $image_size_width = $image_size_height = '';
extract( $brook_shortcode_atts );
$images = explode( ',', $images );

if ( $image_size === '' ) {
	$image_size = '500x338';
}

$slider_class = 'tm-swiper';

if ( $nav !== '' ) {
	$slider_class .= " nav-style-$nav";
}

if ( $pagination !== '' ) {
	$slider_class .= " pagination-style-$pagination";
}

if ( $equal_height === '1' ) {
	$slider_class .= ' equal-height';
}

if ( $fw_image === '1' ) {
	$slider_class .= ' fw-image';
}

if ( $v_center === '1' ) {
	$slider_class .= ' v-center';
}

if ( $h_center === '1' ) {
	$slider_class .= ' h-center';
}
?>


<div class="<?php echo esc_attr( trim( $slider_class ) ); ?>"
	<?php
	if ( $items_display !== '' ) {
		$arr = explode( ';', $items_display );
		foreach ( $arr as $value ) {
			$tmp = explode( ':', $value );
			echo ' data-' . $tmp[0] . '-items="' . $tmp[1] . '"';
		}
	}
	?>

	<?php if ( $gutter > 1 ) : ?>
		data-lg-gutter="<?php echo esc_attr( $gutter ); ?>"
	<?php endif; ?>

	<?php if ( $nav !== '' ) : ?>
		data-nav="1"
	<?php endif; ?>

	<?php if ( $nav === 'custom' ) : ?>
		data-custom-nav="<?php echo esc_attr( $slider_button_id ); ?>"
	<?php endif; ?>

	<?php if ( $pagination !== '' ) : ?>
		data-pagination="1"
	<?php endif; ?>

	<?php if ( $auto_play !== '' ) : ?>
		data-autoplay="<?php echo esc_attr( $auto_play ); ?>"
	<?php endif; ?>

	<?php if ( $loop === '1' ) : ?>
		data-loop="1"
	<?php endif; ?>
>
	<div class="swiper-container">
		<div class="swiper-wrapper">
			<?php foreach ( $images as $image ) {
				$slide_class = 'swiper-slide';
				?>
				<div class="<?php echo esc_attr( $slide_class ); ?>">
					<div class="swiper-slide-inner">

						<div class="image-wrap">
							<?php if ( $lightbox_enable === '1' ): ?>
						<?php
						$attachment = Brook_Image::get_attachment_info( $image );
						?>
							<a href="<?php echo esc_url( $attachment['src'] ); ?>" class="zoom">
								<?php endif; ?>

								<div class="image">
									<?php Brook_Image::the_attachment_by_id(
										array(
											'id'     => $image,
											'size'   => $image_size,
											'width'  => $image_size_width,
											'height' => $image_size_height,
										) );
									?>

									<span class="zoom-icon"></span>
								</div>

								<?php if ( $lightbox_enable === '1' ): ?>
							</a>
						<?php endif; ?>
						</div>

					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</div>
