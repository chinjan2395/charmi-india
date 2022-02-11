<?php
defined( 'ABSPATH' ) || exit;

$el_class           = $direction = $front_heading = $front_text = $front_button = $back_heading = $back_text = $back_button = $animation = '';
$front_button_color = $back_button_color = '';

$atts   = vc_map_get_attributes( $this->getShortcode(), $atts );
$css_id = uniqid( 'tm-rotate-box-' );
$this->get_inline_css( "#$css_id", $atts );
extract( $atts );

$el_class  = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-rotate-box ' . $el_class, $this->settings['base'], $atts );

$css_class .= Brook_Helper::get_animation_classes( $animation );

$flipper_classes = 'flipper';
$flipper_classes .= " to-$direction";
?>
<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>">
	<div class="<?php echo esc_attr( $flipper_classes ); ?>">
		<div class="thumb-wrap">
			<div class="box front">
				<div class="content-wrap">
					<?php if ( $front_heading !== '' ) : ?>
						<h4 class="heading">
							<?php echo esc_html( $front_heading ); ?>
						</h4>
					<?php endif; ?>

					<?php if ( $front_text !== '' ) : ?>
						<div class="text">
							<?php echo esc_html( $front_text ); ?>
						</div>
					<?php endif; ?>

					<?php
					if ( $front_button && $front_button !== '' ) {
						$button = vc_build_link( $front_button );
						if ( $button['url'] !== '' ) {
							$_button_classes = 'tm-button style-border-text tm-rotate-box-btn';
							if ( ! in_array( $front_button_color, array( '', 'custom' ) ) ) {
								$_button_classes .= " tm-button-$front_button_color";
							}
							?>
							<a class="<?php echo esc_attr( $_button_classes ); ?>"
							   href="<?php echo esc_url( $button['url'] ); ?>"
								<?php if ( $button['target'] !== '' ) { ?>
									target="<?php echo esc_attr( $button['target'] ); ?>"
								<?php } ?>
							>
								<span class="button-text"><?php echo esc_html( $button['title'] ); ?></span>
							</a>
						<?php }
					} ?>
				</div>
			</div>
			<div class="box back">
				<div class="content-wrap">
					<?php if ( $back_heading !== '' ) : ?>
						<h4 class="heading">
							<?php echo esc_html( $back_heading ); ?>
						</h4>
					<?php endif; ?>

					<?php if ( $back_text !== '' ) : ?>
						<div class="text">
							<?php echo esc_html( $back_text ); ?>
						</div>
					<?php endif; ?>

					<?php
					if ( $back_button && $back_button !== '' ) {
						$button = vc_build_link( $back_button );
						if ( $button['url'] !== '' ) {
							$_button_classes = 'tm-button style-border-text tm-rotate-box-btn';
							if ( ! in_array( $back_button_color, array( '', 'custom' ) ) ) {
								$_button_classes .= " tm-button-$back_button_color";
							}
							?>
							<a class="<?php echo esc_attr( $_button_classes ); ?>"
							   href="<?php echo esc_url( $button['url'] ); ?>"
								<?php if ( $button['target'] !== '' ) { ?>
									target="<?php echo esc_attr( $button['target'] ); ?>"
								<?php } ?>
							>
								<span class="button-text"><?php echo esc_html( $button['title'] ); ?></span>
							</a>
						<?php }
					} ?>
				</div>
			</div>
		</div>
	</div>
</div>
