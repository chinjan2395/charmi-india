<?php
defined( 'ABSPATH' ) || exit;

$el_class = $style = $heading = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class  = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-mailchimp-form-popup ' . $el_class, $this->settings['base'], $atts );

if ( $style !== '' ) {
	$css_class .= " style-$style";
}

if ( $heading === '' ) {
	return;
}

$css_class .= Brook_Helper::get_animation_classes();
?>
<?php if ( function_exists( 'mc4wp_show_form' ) ) : ?>
	<div class="<?php echo esc_attr( trim( $css_class ) ); ?>">
		<a href="javascript:void(0);" id="subscribe-open-popup-link" class="subscribe-open-popup-link">
			<?php echo esc_html( $heading ); ?>
		</a>
	</div>

	<script>
        jQuery( document ).ready( function ( $ ) {
            $( '#subscribe-open-popup-link' ).on( 'click', function () {
                $( 'html' ).addClass( 'mailchimp-form-popup-opened' );
            } );

            $( '#mailchimp-form-popup-close' ).on( 'click', function () {
                $( 'html' ).removeClass( 'mailchimp-form-popup-opened' );
            } );
        } );
	</script>
<?php endif; ?>
