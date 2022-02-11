<?php
defined( 'ABSPATH' ) || exit;

$style  = $el_class = $animation = '';
$gutter = 0;

$atts   = vc_map_get_attributes( $this->getShortcode(), $atts );
$css_id = uniqid( 'tm-grid-' );
$this->get_inline_css( "#$css_id", $atts );
Brook_VC::get_shortcode_custom_css( "#$css_id", $atts );
extract( $atts );

$el_class = $this->getExtraClass( $el_class );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-grid-group ' . $el_class, $this->settings['base'], $atts );

if ( $style !== '' ) {
	$css_class .= " style-$style";
}

$grid_classes = 'tm-grid modern-grid';

$grid_classes .= Brook_Helper::get_grid_animation_classes( $animation );
?>
<div class="tm-grid-wrapper <?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>"
     data-item-wrap="1"
>

	<div class="<?php echo esc_attr( $grid_classes ); ?>">
		<?php echo wpb_js_remove_wpautop( $content ); ?>
	</div>

</div>

<?php if ( $equal_height_elements !== '' ) : ?>
	<?php wp_enqueue_script( 'matchheight' ); ?>
	<script>
        jQuery( document ).ready( function ( $ ) {
            $( document ).on( 'insightGridBeforeInit', function ( e, $el, $grid ) {

                var _equal_elems = "<?php echo esc_attr( $equal_height_elements ); ?>";
                if ( _equal_elems != '' ) {
                    $grid.find( _equal_elems ).matchHeight();
                }
            } );
        } );
	</script>
<?php endif; ?>

