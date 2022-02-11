<?php
$post_options = unserialize( get_post_meta( get_the_ID(), 'insight_post_options', true ) );
if ( $post_options !== false && isset( $post_options['post_video'] ) ) {
	$video = $post_options['post_video'];
	?>
	<div class="post-feature post-video tm-popup-video style-poster-01 poster-full-wide">

		<a href="<?php echo esc_url( $video ); ?>" class="video-link">
			<div class="video-poster">
				<?php if ( has_post_thumbnail() ) { ?>
					<?php
					Brook_Image::the_post_thumbnail( array(
						'size' => '450x340',
					) );
					?>
				<?php } ?>
			</div>
			<div class="video-overlay">
				<div class="video-button">
					<div class="video-play">
						<span class="video-play-icon"></span>
					</div>
				</div>
			</div>
		</a>
	</div>
<?php } ?>
