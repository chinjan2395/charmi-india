<?php
defined( 'ABSPATH' ) || exit;

$list_style = $_global_icon = $_global_icon_class = $marker_color = $custom_marker_color = $title_color = $custom_title_color = $desc_color = $custom_desc_color = $animation = '';
$atts       = vc_map_get_attributes( $this->getShortcode(), $atts );

extract( $atts );
$css_id = uniqid( 'tm-list-' );
$this->get_inline_css( '#' . $css_id, $atts );
$items = (array) vc_param_group_parse_atts( $items );

if ( count( $items ) < 1 ) {
	return;
}
$el_class  = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-list ' . $el_class, $this->settings['base'], $atts );
$css_class .= " style-$list_style";

// Global icon class.
if ( isset( $icon_type ) && isset( ${"icon_" . $icon_type} ) ) {
	$_global_icon_class .= esc_attr( ${"icon_" . $icon_type} );
}

$css_class .= Brook_Helper::get_animation_classes( $animation );
?>

<?php if ( $widget_title !== '' ) : ?>
<div class="widget">
	<h2 class="widgettitle"><?php echo esc_html( $widget_title ); ?></h2>
	<?php endif; ?>

	<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>">
		<?php
		$auto_number = 0;
		foreach ( $items as $item ) {
			$output = '';

			$_icon      = '';
			$icon_class = '';

			if ( isset( $item['icon'] ) && $item['icon'] !== '' ) {
				$icon_class .= $item['icon'];
			}

			?>
			<div class="list-item">

				<div class="list-header">
					<div class="marker">

						<?php
						if ( in_array( $list_style, array(
							'icon',
							'icon-02',
							'modern-icon',
						) ) ) {
							$list_icon_class = 'tm-list__icon';
							if ( $icon_class && $icon_class !== '' ) {
								$list_icon_class .= " $icon_class";
							} else {
								$list_icon_class .= " $_global_icon_class";
							}
							?>
							<i class="<?php echo esc_attr( $list_icon_class ); ?>"></i>
						<?php } elseif ( $list_style === 'auto-numbered-01' ) { // Numbered 01
							$auto_number++;
							echo esc_html( "{$auto_number}" );
						} elseif ( $list_style === 'auto-numbered-02' ) { // Numbered 02
							$auto_number++;
							$_number = str_pad( $auto_number, 2, '0', STR_PAD_LEFT );
							echo esc_html( "{$_number}." );
						} elseif ( $list_style === 'manual-numbered-01' && isset( $item['item_number'] ) ) { // Manual Number.
							echo esc_html( "{$item['item_number']}" );
						} elseif ( $list_style === 'manual-numbered-02' && isset( $item['item_number'] ) ) { // Manual Number.
							echo esc_html( "{$item['item_number']}." );
						}
						?>

					</div>

					<div class="title-wrap">
						<?php if ( isset( $item['item_title'] ) ) { ?>
							<h6 class="title">
								<?php
								if ( isset( $item['link'] ) && $item['link'] !== '' ) {
								$link = vc_build_link( $item['link'] );
								if ( isset( $link['url'] ) && $link['url'] !== '' ) { ?>
								<a class="link" href="<?php echo esc_url( $link['url'] ) ?>"
									<?php if ( $link['target'] !== '' ) { ?>
										target="<?php echo esc_attr( $link['target'] ); ?>"
									<?php } ?>
								>
									<?php } ?>
									<?php } ?>
									<?php echo esc_html( $item['item_title'] ); ?>

									<?php if ( isset( $item['item_sub_title'] ) && $item['item_sub_title'] !== '' ) : ?>
										<span
											class="sub-title"><?php echo esc_html( $item['item_sub_title'] ); ?></span>
									<?php endif; ?>

									<?php if ( isset( $item['link'] ) ) {
									if ( isset( $link['url'] ) && $link['url'] !== '' ) { ?>
								</a>
							<?php } ?>
							<?php } ?>
							</h6>
						<?php } ?>

						<?php
						if ( ! in_array( $list_style, array(
							'auto-numbered',
							'manual-numbered',
						) ) ) { ?>
							<?php if ( isset( $item['item_desc'] ) ) { ?>
								<div class="desc">
									<?php echo esc_html( $item['item_desc'] ); ?>
								</div>
							<?php } ?>
						<?php } ?>
					</div>
				</div>

				<?php
				if ( in_array( $list_style, array(
					'auto-numbered',
					'manual-numbered',
				) ) ) { ?>
					<?php if ( isset( $item['item_desc'] ) ) { ?>
						<div class="desc">
							<?php echo esc_html( $item['item_desc'] ); ?>
						</div>
					<?php } ?>
				<?php } ?>

			</div>
		<?php } ?>
	</div>

	<?php if ( $widget_title !== '' ) : ?>
</div>
<?php endif; ?>
