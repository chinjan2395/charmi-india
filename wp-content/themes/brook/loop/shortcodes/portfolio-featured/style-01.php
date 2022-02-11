<?php
extract( $brook_shortcode_atts );
?>
<div class="post-wrapper">
	<div class="post-info">
		<div class="inner">
			<div class="post-categories">
				<?php echo get_the_term_list( get_the_ID(), 'portfolio_category', '', ', ', '' ); ?>
			</div>

			<h2 class="post-title">
						<span class="post-number">
							<?php echo esc_html( $number ); ?>
						</span>

				<a href="<?php Brook_Portfolio::the_permalink() ?>"><?php the_title(); ?></a>
			</h2>

			<a href="<?php Brook_Portfolio::the_permalink(); ?>" class="post-read-more">
				<span class="btn-text"><?php esc_html_e( 'View project', 'brook' ); ?></span>
				<span class="btn-icon"></span>
			</a>
		</div>

		<div class="post-character"><?php echo esc_html( $character ); ?></div>
	</div>

	<?php
	if ( $image !== '' ) {
		$_feature_image = Brook_Image::get_attachment_url_by_id( array(
			'id'   => $image,
			'size' => '960x1080',
		) );
	} else {
		$_feature_image = Brook_Image::get_the_post_thumbnail_url( array(
			'size' => '960x1080',
		) );
	}

	?>

	<div class="post-feature" style="background-image: url(<?php echo esc_url( $_feature_image ); ?>);"></div>
</div>
