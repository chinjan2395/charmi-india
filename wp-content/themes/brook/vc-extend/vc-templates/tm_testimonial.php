<?php
defined( 'ABSPATH' ) || exit;

$pagination = $nav = $auto_play = $loop = $text_color = $name_color = $by_line_color = $style = $el_class = '';

$atts   = vc_map_get_attributes( $this->getShortcode(), $atts );
$css_id = uniqid( 'tm-testimonial-' );
$this->get_inline_css( '#' . $css_id, $atts );
extract( $atts );

$el_class  = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-testimonial ' . $el_class, $this->settings['base'], $atts );
$css_class .= " style-$style";

$css_class .= Brook_Helper::get_animation_classes();

$brook_post_args = array(
	'post_type'      => 'testimonial',
	'posts_per_page' => $number,
	'orderby'        => $orderby,
	'order'          => $order,
	'no_found_rows'  => true,
);

if ( in_array( $orderby, array( 'meta_value', 'meta_value_num' ), true ) ) {
	$brook_post_args['meta_key'] = $meta_key;
}

$brook_post_args = Brook_VC::get_tax_query_of_taxonomies( $brook_post_args, $taxonomies );

$brook_query = new WP_Query( $brook_post_args );
?>
<?php if ( $brook_query->have_posts() ) : ?>
	<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>">
		<?php
		set_query_var( 'brook_query', $brook_query );
		set_query_var( 'brook_shortcode_atts', $atts );

		get_template_part( 'loop/shortcodes/testimonial/style', $style );
		?>
	</div>
<?php endif; ?>
<?php wp_reset_postdata(); ?>
