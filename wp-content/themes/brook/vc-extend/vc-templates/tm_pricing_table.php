<?php
defined( 'ABSPATH' ) || exit;

$style    = '01';
$el_class = $items = $animation = '';
$currency = $period = $heading = $feature_labels = '';
$atts     = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass( $el_class );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-pricing-table ' . $el_class, $this->settings['base'], $atts );
$css_class .= " style-$style";

$css_class .= Brook_Helper::get_animation_classes( $animation );

if ( isset( ${"icon_" . $icon_type} ) ) {
	$icon_classes = esc_attr( ${"icon_" . $icon_type} );

	vc_icon_element_fonts_enqueue( $icon_type );
}

$css_id = uniqid( 'tm-pricing-table-' );
$this->get_inline_css( '#' . $css_id, $atts );

$items = (array) vc_param_group_parse_atts( $items );
?>

<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>">
	<div class="inner">
		<?php
		$table_head_template   = '';
		$table_body_template   = '';
		$table_footer_template = '';

		foreach ( $items as $item ) {
			ob_start();
			?>
			<th>
				<div class="pricing-header">
					<?php if ( isset( $item['featured'] ) && $item['featured'] === '1' ) : ?>
						<div class="tm-pricing-feature-mark">
							<?php esc_html_e( 'Popular Choice', 'brook' ); ?>
						</div>
					<?php endif; ?>

					<h5 class="title">
						<?php echo esc_html( $item['title'] ); ?>
					</h5>

					<?php if ( $item['price'] !== '' ) : ?>

						<div class="price-wrap">
							<div class="price-wrap-inner">
								<h6 class="currency"><?php echo esc_html( $currency ); ?></h6>
								<h6 class="price"><?php echo esc_html( $item['price'] ); ?></h6>

								<?php if ( $period !== '' ) : ?>
									<h6 class="period"><?php echo esc_html( $period ); ?></h6>
								<?php endif; ?>
							</div>
						</div>

					<?php endif; ?>
				</div>
			</th>
			<?php
			$table_head_template .= ob_get_clean();

			ob_start();
			?>
			<td>
				<?php
				if ( $item['features'] !== '' ) {
					$_features = explode( "\n", $item['features'] );
					?>
					<ul>
						<?php
						foreach ( $_features as $_feature ) {
							?>
							<li>
								<?php if ( $_feature === '[check]' ) { ?>
									<?php echo '<span class="item-checked fa fa-check"></span>'; ?>
								<?php } elseif ( $_feature === '' ) { ?>
									<?php echo '&nbsp;'; ?>
								<?php } else { ?>
									<?php echo esc_html( $_feature ); ?>
								<?php } ?>
							</li>
							<?php
						}
						?>
					</ul>
				<?php } ?>
			</td>
			<?php
			$table_body_template .= ob_get_clean();

			ob_start();
			?>
			<td>
				<?php if ( isset( $item['button'] ) ): ?>
					<div class="pricing-footer">
						<?php
						$_button_classes = 'tm-button style-flat tm-button-primary smooth-scroll-link tm-pricing-button';

						$button = vc_build_link( $item['button'] );
						?>
						<?php if ( $button['url'] !== '' ) { ?>
							<div class="tm-pricing-footer">
								<?php
								$_button_title = $button['title'] != '' ? $button['title'] : esc_html__( 'Sign Up', 'brook' );
								printf( '<a href="%s" %s %s class="%s">%s</a>', $button['url'], $button['target'] != '' ? 'target="' . esc_attr( $button['target'] ) . '"' : '', $button['rel'] != '' ? 'rel="' . esc_attr( $button['rel'] ) . '"' : '', $_button_classes, $_button_title );
								?>
							</div>
						<?php } ?>
					</div>
				<?php endif; ?>
			</td>
			<?php
			$table_footer_template .= ob_get_clean();
		}
		?>

		<table>
			<tr>
				<th>
					<div class="pricing-header">
						<h3 class="heading"><?php echo wp_kses( $heading, 'brook-default' ); ?></h3>
					</div>
				</th>

				<?php Brook_Helper::e( $table_head_template ); ?>
			</tr>
			<tbody>
			<tr>
				<td>
					<ul class="pricing-feature-labels">
						<?php
						$features_labels = str_replace( '<br />', '', $features_labels );
						$_lables         = explode( "\n", $features_labels );

						foreach ( $_lables as $_label ):
							?>
							<li><?php echo esc_html( $_label ); ?></li>
						<?php endforeach; ?>
					</ul>
				</td>
				<?php Brook_Helper::e( $table_body_template ); ?>
			</tr>
			</tbody>
			<tfoot>
			<tr>
				<td></td>
				<?php Brook_Helper::e( $table_footer_template ); ?>
			</tr>
			</tfoot>
		</table>

	</div>
</div>
