<?php
$portfolio_url     = Brook_Helper::get_post_meta( 'portfolio_url', '' );
$portfolio_gallery = Brook_Helper::get_post_meta( 'portfolio_gallery', '' );

$class = 'portfolio-content-wrap';

if ( $portfolio_gallery !== '' || has_post_thumbnail() ) {
	$class .= ' col-md-4 col-lg-push-1 col-lg-4';
} else {
	$class .= ' col-md-12';
}
?>

<div class="row tm-sticky-parent">
	<?php if ( $portfolio_gallery !== '' || has_post_thumbnail() ) : ?>
		<div class="portfolio-feature-wrap col-lg-7 col-md-8">
			<div class="tm-sticky-column">

				<?php Brook_Portfolio::portfolio_video( array( 'position' => 'above' ) ); ?>

				<?php
				$caption_enable = Brook::setting( 'single_portfolio_feature_caption' );
				$caption_enable = $caption_enable === '1' ? true : false;

				$lightbox        = Brook::setting( 'single_portfolio_feature_lightbox' );
				$gallery_classes = 'portfolio-details-gallery';

				if ( $lightbox === '1' ) {
					$gallery_classes .= ' tm-light-gallery';
				}
				?>
				<div class="<?php echo esc_attr( $gallery_classes ); ?>">
					<?php if ( has_post_thumbnail() ) : ?>
						<div class="portfolio-image">

							<?php if ( $lightbox === '1' ): ?>
							<a href="<?php echo get_the_post_thumbnail_url( null, 'full' ); ?>" class="zoom">
								<?php endif; ?>

								<?php
								Brook_Image::the_post_thumbnail( array(
									'size'           => 'custom',
									'width'          => 670,
									'height'         => 9999,
									'crop'           => false,
									'caption_enable' => $caption_enable,
								) );
								?>

								<?php if ( $lightbox === '1' ): ?>
								<div class="portfolio-overlay"></div>
								<div class="portfolio-overlay-content">
									<span class="fal fa-search"></span>
								</div>
							</a>
						<?php endif; ?>

						</div>
					<?php endif; ?>

					<?php if ( $portfolio_gallery !== '' ) : ?>
						<?php foreach ( $portfolio_gallery as $key => $value ) { ?>
							<div class="portfolio-image">

								<?php if ( $lightbox === '1' ): ?>
								<a href="<?php echo wp_get_attachment_url( $value['id'] ); ?>" class="zoom">
									<?php endif; ?>

									<?php Brook_Image::the_attachment_by_id( array(
										'id'             => $value['id'],
										'size'           => 'custom',
										'width'          => 670,
										'height'         => 9999,
										'crop'           => false,
										'caption_enable' => $caption_enable,
									) );
									?>

									<?php if ( $lightbox === '1' ): ?>

									<div class="portfolio-overlay"></div>
									<div class="portfolio-overlay-content">
										<span class="fal fa-search"></span>
									</div>
								</a>
							<?php endif; ?>

							</div>
						<?php } ?>
					<?php endif; ?>

				</div>

				<?php Brook_Portfolio::portfolio_video( array( 'position' => 'below' ) ); ?>

			</div>
		</div>
	<?php endif; ?>

	<div class="<?php echo esc_attr( $class ); ?>">
		<div class="tm-sticky-column">
			<div class="portfolio-details-content">
				<div class="portfolio-main-info">
					<h3 class="portfolio-title"><?php the_title(); ?></h3>

					<div class="portfolio-content">
						<?php Brook_Portfolio::entry_about_project_label(); ?>

						<?php the_content(); ?>
					</div>

					<?php Brook_Templates::portfolio_view_project_button( $portfolio_url ); ?>
				</div>

				<?php Brook_Templates::portfolio_details(); ?>

				<?php Brook_Templates::portfolio_sharing(); ?>
			</div>
		</div>
	</div>
</div>
