<?php
defined( 'ABSPATH' ) || exit;

$style = $el_class = $items = '';

$atts   = vc_map_get_attributes( $this->getShortcode(), $atts );
$css_id = uniqid( 'tm-gradation-' );
$this->get_inline_css( "#$css_id", $atts );
extract( $atts );

$items = (array) vc_param_group_parse_atts( $items );
if ( count( $items ) < 1 ) {
	return;
}

$el_class  = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-gradation ' . $el_class, $this->settings['base'], $atts );
$css_class .= " tm-gradation--$style";
$css_class .= ' tm-animation-queue';
?>
<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>"
     data-animation-delay="400"
>
	<?php
	$count = 0;
	foreach ( $items as $item ) {
		$count++;

		$_item_classes = 'item';
		$_item_classes .= " item-$count";

		?>
		<div class="<?php echo esc_attr( $_item_classes ); ?>">
			<div class="line"></div>

			<div class="dot-wrap">
				<div class="dot">
					<div class="count"><?php echo esc_html( $count ); ?></div>
				</div>
			</div>

			<div class="content-wrap">
				<?php if ( isset( $item['title'] ) ) : ?>
					<h5 class="title"><?php echo esc_html( $item['title'] ); ?></h5>
				<?php endif; ?>

				<?php if ( isset( $item['text'] ) ) : ?>
					<div class="text"><?php echo $item['text']; ?></div>
				<?php endif; ?>
			</div>
		</div>
	<?php } ?>
</div>
