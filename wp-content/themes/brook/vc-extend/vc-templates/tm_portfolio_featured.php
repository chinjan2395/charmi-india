<?php
defined( 'ABSPATH' ) || exit;

$post_type = 'portfolio';
$style     = $el_class = $portfolio = $character = $number = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass( $el_class );
$el_id    = Brook_VC::get_shortcode_el_id( $atts, 'tm-portfolio-featured-' );
$css_id   = "#{$el_id}";

$this->get_inline_css( $css_id, $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-portfolio-featured ' . $el_class, $this->settings['base'], $atts );
$css_class .= " style-$style";

if ( $portfolio === '' ) {
	return;
}

$brook_post_args = array(
	'post_type'      => 'portfolio',
	'name'           => $portfolio,
	'posts_per_page' => 1,
	'paged'          => 1,
	'post_status'    => 'publish',
	'no_found_rows'  => true,
);

$brook_query = new WP_Query( $brook_post_args );
?>
<?php if ( $brook_query->have_posts() ) : $brook_query->the_post(); ?>
	<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $el_id ); ?>">

		<?php
		set_query_var( 'brook_shortcode_atts', $atts );

		get_template_part( 'loop/shortcodes/portfolio-featured/style', $style );
		?>

	</div>
<?php endif; ?>
<?php wp_reset_postdata();
