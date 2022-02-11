<?php
$video = $video_text = '';
extract( $brook_shortcode_atts );
?>

<a href="<?php echo esc_url( $video ); ?>" class="video-link">
	<div class="video-content">
		<div class="video-play">
			<span class="video-play-icon"></span>
		</div>

		<?php if ( $video_text !== '' ) : ?>
			<div class="video-text">
				<?php echo esc_html( $video_text ); ?>
			</div>
		<?php endif; ?>
	</div>
</a>
