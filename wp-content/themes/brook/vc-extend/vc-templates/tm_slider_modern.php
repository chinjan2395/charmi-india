<?php
defined( 'ABSPATH' ) || exit;

$style  = $el_class = $items = $nav = $pagination = '';
$atts   = vc_map_get_attributes( $this->getShortcode(), $atts );
$css_id = uniqid( 'tm-slider-modern-' );
$this->get_inline_css( "#$css_id", $atts );
extract( $atts );

$items = (array) vc_param_group_parse_atts( $items );
if ( count( $items ) <= 0 ) {
	return;
}

$el_class  = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-slider-modern ' . $el_class, $this->settings['base'], $atts );

$css_class .= " style-$style";

$slider_class = 'tm-swiper c-bottom equal-height';

if ( $nav !== '' ) {
	$slider_class .= " nav-style-$nav";
}

if ( $pagination !== '' ) {
	$slider_class .= " pagination-style-$pagination";
}

$css_class .= Brook_Helper::get_animation_classes();
?>

<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>">
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

		<?php if ( $nav !== '' ) : ?>
			data-nav="1"
		<?php endif; ?>

		<?php if ( $nav === 'custom' ) : ?>
			data-custom-nav="<?php echo esc_attr( $slider_button_id ); ?>"
		<?php endif; ?>

		<?php if ( $pagination !== '' ) : ?>
			data-pagination="1"
		<?php endif; ?>
	>


		<?php $slider_modern_bg = ''; ?>
		<?php $slider_modern_content = ''; ?>

		<?php foreach ( $items as $item ) {
			$slide_class = 'swiper-slide';

			if ( isset( $item['background_image'] ) ) {
				$bg_url = Brook_Image::get_attachment_url_by_id( array(
					'id' => $item['background_image'],
				) );
			}
			?>

			<?php ob_start(); ?>
			<div class="slide-bg">
				<?php
				$slide_bg_url = Brook_Image::get_attachment_url_by_id( array(
					'id'   => $item['background_image'],
					'size' => '1920x650',
				) );
				?>
				<div class="slide-bg-inner"
				     style="<?php echo 'background-image: url( ' . $slide_bg_url . ' );'; ?>"></div>
			</div>
			<?php $slider_modern_bg .= ob_get_clean(); ?>

			<?php ob_start(); ?>

			<div class="<?php echo esc_attr( $slide_class ); ?>"
				<?php if ( isset( $bg_url ) ) : ?>
					data-bg-url="<?php echo esc_attr( $bg_url ); ?>"
				<?php endif; ?>
			>
				<div class="swiper-slide-inner">
					<?php if ( isset( $item['image'] ) ) : ?>
						<div class="image-wrap">
							<div class="image">
								<?php Brook_Image::the_attachment_by_id( array(
									'id'   => $item['image'],
									'size' => 'full',
								) ); ?>
							</div>
						</div>
					<?php endif; ?>

					<div class="slider-content">
						<?php if ( isset( $item['title'] ) ) : ?>
							<h5 class="heading"><?php echo esc_html( $item['title'] ); ?></h5>
						<?php endif; ?>

						<?php if ( isset( $item['text'] ) ) : ?>
							<div class="text"><?php echo esc_html( $item['text'] ); ?></div>
						<?php endif; ?>
					</div>
					<?php
					if ( isset( $item['button'] ) ) {
						$link = vc_build_link( $item['button'] );
						if ( $link['url'] !== '' ) {
							$_title = $link['title'] !== '' ? ' title="' . esc_attr( $link['title'] ) . '"' : '';
							?>
							<a href="<?php echo esc_url( $link['url'] ); ?>"
							   class="tm-button style-text-long-arrow tm-button-primary"
								<?php
								if ( $link['target'] !== '' ) :?>
									target="<?php echo esc_attr( $link['target'] ); ?>"
								<?php endif; ?>
							>
										<span class="button-text">
											<?php echo esc_html( $link['title'] ); ?>
										</span>

								<span class="button-arrow"></span>
							</a>
							<?php
						}
					}
					?>
				</div>
			</div>

			<?php $slider_modern_content .= ob_get_clean(); ?>

		<?php } ?>

		<div class="slider-bg-list">
			<?php Brook_Helper::e( $slider_modern_bg ); ?>
		</div>

		<div class="swiper-container">
			<div class="swiper-wrapper">

				<?php Brook_Helper::e( $slider_modern_content ); ?>

			</div>
		</div>

	</div>
</div>
