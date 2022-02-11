<?php
$loop = $auto_play = $items_display = $gutter = $carousel_nav = $carousel_pagination = $slider_button_id = '';
extract( $brook_shortcode_atts );

$items = (array) vc_param_group_parse_atts( $items );

$slider_classes = 'tm-swiper equal-height h-center v-center';

if ( $carousel_nav !== '' ) {
	$slider_classes .= " nav-style-$carousel_nav";
}

if ( $carousel_pagination !== '' ) {
	$slider_classes .= " pagination-style-$carousel_pagination";
}
?>
<div class="<?php echo esc_attr( $slider_classes ); ?>"
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

	<?php if ( $auto_play !== '' ) : ?>
		data-autoplay="<?php echo esc_attr( $auto_play ); ?>"
	<?php endif; ?>

	<?php if ( $loop === '1' ) : ?>
		data-loop="1"
	<?php endif; ?>

	<?php if ( $carousel_nav !== '' ) : ?>
		data-nav="1"
	<?php endif; ?>

	<?php if ( $carousel_nav === 'custom' ) : ?>
		data-custom-nav="<?php echo esc_attr( $slider_button_id ); ?>"
	<?php endif; ?>

	<?php if ( $carousel_pagination !== '' ) : ?>
		data-pagination="1"
	<?php endif; ?>
>
	<div class="swiper-container">
		<div class="swiper-wrapper">
			<?php foreach ( $items as $item ) { ?>
				<div class="swiper-slide">
					<?php
					$inner_classes = 'inner';
					if ( isset( $item['image_hover'] ) ) {
						$inner_classes .= ' has-image-hover';
					}
					?>

					<div class="<?php echo esc_attr( $inner_classes ); ?>">
						<?php
						$_flag = false;
						if ( isset( $item['link'] ) ) {
							$link = vc_build_link( $item['link'] );
							if ( $link['url'] !== '' ) {
								$_target = $link['target'] !== '' ? ' target="_blank"' : '';
								$_title  = $link['title'] !== '' ? ' title="' . esc_attr( $link['title'] ) . '"' : '';
								echo '<a href="' . esc_url( $link['url'] ) . '"' . $_target . $_title . '>';
								$_flag = true;
							}
						}
						?>
						<?php if ( isset( $item['image'] ) ) : ?>
							<div class="image">
								<?php
								$image_url = wp_get_attachment_url( $item['image'] );
								?>
								<img src="<?php echo esc_url( $image_url ); ?>"
								     alt="<?php esc_attr_e( 'Client Logo', 'brook' ); ?>"/>
							</div>
						<?php endif; ?>
						<?php if ( isset( $item['image_hover'] ) ) : ?>
							<div class="image-hover">
								<?php
								$image_url = wp_get_attachment_url( $item['image_hover'] );
								?>
								<img src="<?php echo esc_url( $image_url ); ?>"
								     alt="<?php esc_attr_e( 'Client Logo', 'brook' ); ?>"/>
							</div>
						<?php endif; ?>
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
