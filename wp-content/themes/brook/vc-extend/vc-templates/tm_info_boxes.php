<?php
defined( 'ABSPATH' ) || exit;

$style  = $el_class = $items = $columns = $metro_layout = $animation = '';
$gutter = 0;

$atts   = vc_map_get_attributes( $this->getShortcode(), $atts );
$css_id = uniqid( 'tm-info-boxes-' );
$this->get_inline_css( "#$css_id", $atts );
extract( $atts );

$items = (array) vc_param_group_parse_atts( $items );
$count = count( $items );
if ( $count <= 0 ) {
	return;
}

$el_class  = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-info-boxes ' . $el_class, $this->settings['base'], $atts );
$css_class .= " style-$style";

$grid_classes = 'tm-grid modern-grid';
$grid_classes .= Brook_Helper::get_grid_animation_classes( $animation );

?>
<div class="tm-grid-wrapper <?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>">
	<div class="<?php echo esc_attr( $grid_classes ); ?>">
		<?php if ( $style === 'metro' ) { ?>
			<?php
			if ( $metro_layout ) {
				$metro_layout = (array) vc_param_group_parse_atts( $metro_layout );
				$_sizes       = array();
				foreach ( $metro_layout as $key => $value ) {
					$_sizes[] = $value['size'];
				}
				$metro_layout = $_sizes;
			} else {
				$metro_layout = array(
					'2:1',
					'1:1',
					'1:1',
					'2:2',
					'1:1',
					'2:1',
				);
			}

			if ( count( $metro_layout ) < 1 ) {
				return;
			}

			$metro_layout_count = count( $metro_layout );
			$metro_item_count   = 0;

			foreach ( $items as $item ) {
				$classes = array( 'grid-item' );

				if ( in_array( $metro_layout[ $metro_item_count ], array(
					'2:1',
					'2:2',
				), true ) ) {
					$classes[] = 'grid-width-2';
				}

				if ( in_array( $metro_layout[ $metro_item_count ], array(
					'1:2',
					'2:2',
				), true ) ) {
					$classes[] = 'grid-height-2';
				}

				$background = isset( $item['background_color'] ) ? $item['background_color'] : '';
				$gradient   = isset( $item['background_gradient'] ) ? $item['background_gradient'] : '';
				$custom_bg  = isset( $item['custom_background_color'] ) ? $item['custom_background_color'] : '';

				$_item_style = Brook_Helper::get_shortcode_css_color_inherit( 'background-color', $background, $custom_bg, $gradient );

				if ( isset( $item['image'] ) ) :
					$_image_width  = 480;
					$_image_height = 480;
					if ( $metro_layout[ $metro_item_count ] === '2:1' ) {
						$_image_width  = 960;
						$_image_height = 480;
					} elseif ( $metro_layout[ $metro_item_count ] === '1:2' ) {
						$_image_width  = 480;
						$_image_height = 960;
					} elseif ( $metro_layout[ $metro_item_count ] === '2:2' ) {
						$_image_width  = 960;
						$_image_height = 960;
					}

					$image_url = Brook_Image::get_attachment_url_by_id( array(
						'id'     => $item['image'],
						'size'   => 'custom',
						'width'  => $_image_width,
						'height' => $_image_height,
					) );

					$_item_style .= 'background-image: url( ' . esc_url( $image_url ) . ' )';
					$classes[]   = 'has-image';
				endif;
				?>
				<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>"
					<?php if ( $_item_style !== '' ): ?>
						style="<?php echo esc_attr( $_item_style ); ?>"
					<?php endif; ?>
				>
					<div class="grid-item-wrap">
						<div class="box-content">
							<div class="box-content-inner">
								<div class="box-info">
									<?php
									$icon_type = isset( $item['icon_type'] ) ? $item['icon_type'] : '';
									if ( $icon_type !== '' && isset( $item["icon_$icon_type"] ) && $item["icon_$icon_type"] !== '' ) { ?>
										<?php
										$icon_style = '';
										if ( isset( $item['icon_color'] ) && $item['icon_color'] !== '' ) {
											$icon_style = "color: {$item['icon_color']}";
										}
										?>
										<div class="box-icon"
											<?php if ( $icon_style !== '' ) {
												echo 'style="' . $icon_style . '"';
											} ?>>
											<?php
											$_args = array(
												'type' => $icon_type,
												'icon' => $item["icon_$icon_type"],
											);

											Brook_Helper::get_vc_icon_template( $_args );
											?>
										</div>
									<?php } ?>

									<?php if ( isset( $item['title'] ) ) : ?>
										<?php
										$title_style = '';
										if ( isset( $item['heading_color'] ) && $item['heading_color'] !== '' ) {
											$title_style = "color: {$item['heading_color']}";
										}
										?>
										<h6 class="box-title"
											<?php if ( $title_style !== '' ) {
												echo 'style="' . $title_style . '"';
											} ?>>
											<?php echo esc_html( $item['title'] ); ?>
										</h6>
									<?php endif; ?>

									<?php if ( isset( $item['text'] ) ) : ?>
										<?php
										$text_style = '';
										if ( isset( $item['text_color'] ) && $item['text_color'] !== '' ) {
											$text_style = "color: {$item['text_color']}";
										}
										?>
										<div class="box-text"
											<?php if ( $text_style !== '' ) {
												echo 'style="' . $text_style . '"';
											} ?>>
											<?php echo esc_html( $item['text'] ); ?>
										</div>
									<?php endif; ?>

									<?php
									if ( isset( $item['button'] ) && $item['button'] !== '' ) {
										$button = vc_build_link( $item['button'] );
										if ( $button['url'] !== '' ) {
											$button_classes = 'tm-button style-flat tm-button-primary tm-info-boxes-btn';

											$button_style = '';
											if ( isset( $item['button_text_color'] ) && $item['button_text_color'] !== '' ) {
												$button_style = "color: {$item['button_text_color']};";
											}

											if ( isset( $item['button_background_color'] ) && $item['button_background_color'] !== '' ) {
												$button_style .= "background: {$item['button_background_color']};";
											}
											?>
											<a class="<?php echo esc_attr( $button_classes ); ?>"
											   href="<?php echo esc_url( $button['url'] ) ?>"
												<?php if ( $button['target'] !== '' ) { ?>
													target="<?php echo esc_attr( $button['target'] ); ?>"
												<?php } ?>

												<?php if ( $button_style !== '' ) {
													echo 'style="' . $button_style . '"';
												} ?>
											>
												<span class="button-text">
													<?php echo esc_html( $button['title'] ); ?>
												</span>
											</a>
										<?php }
									} ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php
				$metro_item_count++;
				if ( $metro_item_count == $count || $metro_layout_count == $metro_item_count ) {
					$metro_item_count = 0;
				}
				?>
				<?php
			}
		}
		?>
	</div>
</div>
