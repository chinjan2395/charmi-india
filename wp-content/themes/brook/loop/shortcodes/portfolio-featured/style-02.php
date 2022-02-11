<?php
extract( $brook_shortcode_atts );
?>
<div class="post-wrapper">
	<div class="post-info">
		<div class="inner">
			<div class="main-info">
				<div class="main-info-inner">
					<h6 class="post-number">
						<?php echo esc_html( $number ); ?>
					</h6>

					<h2 class="post-title">
						<a href="<?php Brook_Portfolio::the_permalink() ?>"><?php the_title(); ?></a>
					</h2>

					<a href="<?php Brook_Portfolio::the_permalink(); ?>" class="post-read-more">
						<span class="btn-text"><?php esc_html_e( 'View project', 'brook' ); ?></span>
						<span class="btn-icon"></span>
					</a>
				</div>
			</div>

			<?php
			if ( $image !== '' ) {
				$_feature_image = Brook_Image::get_attachment_by_id( array(
					'id'   => $image,
					'size' => '490x490',
				) );
			} else {
				$_feature_image = Brook_Image::get_the_post_thumbnail( array(
					'size' => '490x490',
				) );
			}
			?>

			<div class="post-feature">
				<div class="post-gradient">
					<div class="post-thumbnail">
						<?php Brook_Helper::e( $_feature_image ); ?>
					</div>
				</div>
			</div>

			<div class="post-categories">
				<?php echo get_the_term_list( get_the_ID(), 'portfolio_category', '', ', ', '' ); ?>
			</div>
		</div>
	</div>
</div>
