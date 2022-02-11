<?php
defined( 'ABSPATH' ) || exit;

$style = $show_user_name = $el_class = $username = $overlay = $link_target = '';

$atts   = vc_map_get_attributes( $this->getShortcode(), $atts );
$css_id = uniqid( 'tm-instagram-' );
$this->get_inline_css( "#$css_id", $atts );
extract( $atts );

$el_class  = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-grid-wrapper tm-instagram ' . $el_class, $this->settings['base'], $atts );
$css_class .= " style-$style";
$classes   = array( 'tm-grid modern-grid' );

if ( $widget_title !== '' ) {
	$css_class .= ' widget';
}

$css_class .= Brook_Helper::get_animation_classes();
if ( $username !== '' ) {
	$media_array = Brook_Instagram::scrape_instagram( $username, $number_items );
	if ( is_wp_error( $media_array ) ) {
		?>
		<div class="tm-instagram--error">
			<?php echo '<p>' . $media_array->get_error_message() . '</p>'; ?>
		</div>
		<?php
	} else {
		?>
		<div id="<?php echo esc_attr( $css_id ); ?>" class="<?php echo esc_attr( trim( $css_class ) ); ?>">

			<?php if ( $widget_title !== '' ) : ?>
				<h2 class="widgettitle"><?php echo esc_html( $widget_title ); ?></h2>
			<?php endif; ?>

			<?php
			?>
			<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
				<?php foreach ( $media_array as $item ) { ?>
					<div class="grid-item">
						<div class="inner">
							<img src="<?php echo esc_url( $item[ $size ] ); ?>" class="item-image"
							     alt="<?php esc_attr_e( 'Instagram Image', 'brook' ); ?>"/>
							<?php if ( 'video' === $item['type'] ) : ?>
								<span class="play-button"></span>
							<?php endif; ?>
							<div class="overlay">
								<a href="<?php echo esc_url( $item['link'] ); ?>"
									<?php if ( '1' === $link_target ) : ?>
										target="_blank"
									<?php endif; ?>
								>
									<?php if ( '1' === $overlay ) : ?>
										<div class="item-info">
											<span class="likes"><?php echo esc_html( $item['likes'] ); ?></span>
											<span class="comments"><?php echo esc_html( $item['comments'] ); ?></span>
										</div>
									<?php endif; ?>
								</a>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>

			<?php if ( $show_user_name === '1' ) : ?>
				<div class="instagram-user-name">
					<?php echo '@' . esc_html( $username ); ?>
				</div>
			<?php endif; ?>

		</div>
	<?php }
} ?>
