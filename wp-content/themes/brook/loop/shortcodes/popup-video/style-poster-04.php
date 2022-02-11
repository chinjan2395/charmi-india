<?php
$poster = $image_size = $image_size_width = $image_size_height = $video_text = '';
extract( $brook_shortcode_atts );
?>

<a href="<?php echo esc_url( $video ); ?>" class="video-link">
	<div class="video-poster">
		<?php
		Brook_Image::the_attachment_by_id( array(
			'id'     => $poster,
			'size'   => $image_size,
			'width'  => $image_size_width,
			'height' => $image_size_height,
		) );
		?>
		<div class="video-overlay">
			<div class="video-button">
				<div class="video-play">
					<span class="video-play-icon"></span>
				</div>

				<?php if ( $video_text !== '' ) : ?>
					<div class="video-text">
						<?php echo esc_html( $video_text ); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</a>
