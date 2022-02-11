<?php
defined( 'ABSPATH' ) || exit;

$style = '';

$atts   = vc_map_get_attributes( $this->getShortcode(), $atts );
$css_id = uniqid( 'tm-message-box-' );
$this->get_inline_css( "#$css_id", $atts );
extract( $atts );

$el_class  = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-message-box ' . $el_class, $this->settings['base'], $atts );
$css_class .= " style-$style";

$css_class .= Brook_Helper::get_animation_classes();
?>
<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>">
	<?php if ( isset( ${"icon_$icon_type"} ) && ${"icon_$icon_type"} !== '' ) { ?>
		<?php
		$_args = array(
			'type' => $icon_type,
			'icon' => ${"icon_$icon_type"},
		);

		Brook_Helper::get_vc_icon_template( $_args );
		?>
	<?php } ?>
	<?php echo wpb_js_remove_wpautop( $content ); ?>
</div>
