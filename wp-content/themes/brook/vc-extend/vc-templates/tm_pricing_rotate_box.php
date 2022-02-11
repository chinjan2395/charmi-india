<?php
defined( 'ABSPATH' ) || exit;

$style = $el_class = $items = $featured = $animation = '';
$price = $currency = $period = $title = $desc = '';
$atts  = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass( $el_class );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-pricing-rotate-box ' . $el_class, $this->settings['base'], $atts );
$css_class .= " style-$style";

$css_class .= Brook_Helper::get_animation_classes( $animation );

$_button_classes = 'tm-button smooth-scroll-link tm-pricing-button style-flat';

$css_id = uniqid( 'tm-pricing-rotate-box-' );
$this->get_inline_css( "#$css_id", $atts );

$button = vc_build_link( $button );

$items = (array) vc_param_group_parse_atts( $items );
?>

<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>">
	<div class="inner">
		<div class="tm-rotate-box">
			<div class="flipper to-left">
				<div class="thumb-wrap">
					<div class="box front">
						<?php if ( $title !== '' ) : ?>
							<h5 class="title"><?php echo esc_html( $title ); ?></h5>
						<?php endif; ?>

						<?php if ( $currency && $price !== '' ) : ?>

							<div class="price-wrap">
								<h6 class="price-wrap-inner">
									<span class="currency"><?php echo esc_html( $currency ); ?></span>
									<span class="price"><?php echo esc_html( $price ); ?></span>
								</h6>
								<?php if ( $period !== '' ) : ?>
									<h6 class="period"><?php echo esc_html( $period ); ?></h6>
								<?php endif; ?>
							</div>

						<?php endif; ?>
					</div>
					<div class="box back">
						<div class="content-wrap">
							<div class="content-inner">
								<div class="tm-pricing-content">
									<?php if ( count( $items ) > 0 ) { ?>
										<ul class="tm-pricing-list">
											<?php
											foreach ( $items as $data ) { ?>
												<li>
													<?php if ( isset( $data['text'] ) ) : ?>
														<?php echo '<span class="feature-text">' . esc_html( $data['text'] ) . '</span>'; ?>
													<?php endif; ?>
												</li>
												<?php
											}
											?>
										</ul>
									<?php } ?>
								</div>
								<?php if ( $button['url'] !== '' ) { ?>
									<div class="tm-pricing-footer">
										<?php
										$_button_title = $button['title'] != '' ? $button['title'] : esc_html__( 'Sign Up', 'brook' );
										printf( '<a href="%s" %s %s class="%s">%s</a>', $button['url'], $button['target'] != '' ? 'target="' . esc_attr( $button['target'] ) . '"' : '', $button['rel'] != '' ? 'rel="' . esc_attr( $button['rel'] ) . '"' : '', $_button_classes, $_button_title );
										?>
									</div>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
