<?php
defined( 'ABSPATH' ) || exit;

$style = $skin = $attributes = '';
$atts  = vc_map_get_attributes( $this->getShortcode(), $atts );

extract( $atts );
$css_id = uniqid( 'tm-attribute-list-' );
$this->get_inline_css( "#$css_id", $atts );
Brook_VC::get_shortcode_custom_css( "#$css_id", $atts );
$attributes = (array) vc_param_group_parse_atts( $attributes );

if ( count( $attributes ) < 1 ) {
	return;
}

$el_class  = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-attribute-list ' . $el_class, $this->settings['base'], $atts );
$css_class .= " style-$style";
$css_class .= " skin-$skin";

$css_class .= Brook_Helper::get_animation_classes();
?>
<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>">
	<div class="content-wrap">
		<ul class="list">
			<?php
			foreach ( $attributes as $attribute ) { ?>
				<?php if ( isset( $attribute['name'] ) && isset( $attribute['value'] ) ) : ?>
					<li class="item">
						<div class="name"><?php echo esc_html( $attribute['name'] ); ?></div>
						<div class="value"><?php echo wp_kses( $attribute['value'], 'brook-default' ); ?></div>
					</li>
				<?php endif; ?>
			<?php } ?>
		</ul>
	</div>
</div>
