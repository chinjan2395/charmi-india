<?php
$post_options = unserialize( get_post_meta( get_the_ID(), 'insight_post_options', true ) );
if ( $post_options !== false && isset( $post_options['post_gallery'] ) ) {
	$gallery = $post_options['post_gallery'];
	?>
	<div class="post-feature post-gallery">
		<div class="tm-swiper" data-nav="1" data-loop="1">
			<div class="swiper-container">
				<div class="swiper-wrapper">
					<?php foreach ( $gallery as $image ) { ?>
						<div class="swiper-slide">
							<?php
							Brook_Image::the_attachment_by_id( array(
								'id'     => $image['id'],
								'size'   => 'custom',
								'width'  => 770,
								'height' => 578,
							) );
							?>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
<?php } ?>
