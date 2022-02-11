<?php
defined( 'ABSPATH' ) || exit;

$style      = $el_class = $items = $loop = $equal_height = $auto_play = $v_center = $h_center = $fw_image = $nav = $pagination = '';
$image_size = $image_size_width = $image_size_height = '';
$atts       = vc_map_get_attributes( $this->getShortcode(), $atts );
$css_id     = uniqid( 'tm-slider-' );
$this->get_inline_css( "#$css_id", $atts );
extract( $atts );

$el_class  = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-slider tm-swiper ' . $el_class, $this->settings['base'], $atts );

$css_class .= " style-$style";

if ( $text_align !== '' ) {
	$css_class .= " align-$text_align";
}

if ( $nav !== '' ) {
	$css_class .= " nav-style-$nav";
}

if ( $pagination !== '' ) {
	$css_class .= " pagination-style-$pagination";
}

if ( $equal_height === '1' ) {
	$css_class .= ' equal-height';
}

if ( $fw_image === '1' ) {
	$css_class .= ' fw-image';
}

if ( $v_center === '1' ) {
	$css_class .= ' v-center';
}

if ( $h_center === '1' ) {
	$css_class .= ' h-center';
}

$css_class .= Brook_Helper::get_animation_classes();

$items = (array) vc_param_group_parse_atts( $items );

if ( count( $items ) <= 0 ) {
	return;
}
?>

<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>"
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
			<?php foreach ( $items as $item ) {
				$slide_class = 'swiper-slide';
				?>
				<div class="<?php echo esc_attr( $slide_class ); ?>">
					<div class="swiper-slide-inner">
						<?php
						$_flag = false;
						if ( isset( $item['link'] ) ) {
							$link = vc_build_link( $item['link'] );
							if ( $link['url'] !== '' ) {
								$_target = $link['target'] !== '' ? ' target="_blank"' : '';
								$_title  = $link['title'] !== '' ? ' title="' . esc_attr( $link['title'] ) . '"' : '';
								echo '<a href="' . esc_url( $link['url'] ) . '"' . $_target . $_title . ' class="link-secret">';
								$_flag = true;
							}
						}
						?>
						<?php if ( isset( $item['image'] ) ) : ?>
							<div class="image-wrap">
								<div class="image">
									<?php Brook_Image::the_attachment_by_id( array(
										'id'     => $item['image'],
										'size'   => $image_size,
										'width'  => $image_size_width,
										'height' => $image_size_height,
									) ); ?>
								</div>
							</div>
						<?php endif; ?>

						<div class="slider-content">
							<?php if ( isset( $item['image'] ) && ( isset( $item['title'] ) || isset( $item['sub_title'] ) || isset( $item['text'] ) ) ) : ?>
								<div class="spacing"></div>
							<?php endif; ?>

							<?php if ( isset( $item['sub_title'] ) ) : ?>
								<h6 class="sub-title"><?php echo esc_html( $item['sub_title'] ); ?></h6>
							<?php endif; ?>

							<?php if ( isset( $item['title'] ) ) : ?>
								<h5 class="heading"><?php echo esc_html( $item['title'] ); ?></h5>
							<?php endif; ?>

							<?php if ( isset( $item['text'] ) ) : ?>
								<div class="text"><?php echo esc_html( $item['text'] ); ?></div>
							<?php endif; ?>
						</div>

						<?php
						if ( $_flag === true ) {
							echo '</a>';
						}
						?>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</div>
