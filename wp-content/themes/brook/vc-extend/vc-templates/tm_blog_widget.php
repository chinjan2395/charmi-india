<?php
defined( 'ABSPATH' ) || exit;

$post_type  = 'post';
$style      = $el_class = '';
$categories = $meta_key = $pagination = '';

$atts   = vc_map_get_attributes( $this->getShortcode(), $atts );
$css_id = uniqid( 'tm-blog-widget-' );
$this->get_inline_css( "#$css_id", $atts );
extract( $atts );

$brook_post_args = array(
	'post_type'      => $post_type,
	'posts_per_page' => $number,
	'orderby'        => $orderby,
	'order'          => $order,
	'paged'          => 1,
	'post_status'    => 'publish',
	'no_found_rows'  => true,
	'post__not_in'   => get_option( 'sticky_posts' ),
);

if ( in_array( $orderby, array( 'meta_value', 'meta_value_num' ) ) ) {
	$brook_post_args['meta_key'] = $meta_key;
}

$brook_post_args = Brook_VC::get_tax_query_of_taxonomies( $brook_post_args, $taxonomies );
$brook_query     = new WP_Query( $brook_post_args );

$el_class  = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-blog-widget ' . $el_class, $this->settings['base'], $atts );
$css_class .= " style-$style";

$css_class .= Brook_Helper::get_animation_classes();
?>

<?php if ( $brook_query->have_posts() ) : ?>
	<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>">
		<div class="tm-grid">
			<?php
			while ( $brook_query->have_posts() ) :
				$brook_query->the_post();
				$classes = array( 'post-item' );
				?>
				<div <?php post_class( implode( ' ', $classes ) ); ?>>

					<div class="post-wrapper">

						<div class="post-thumbnail">
							<?php Brook_Image::the_post_thumbnail( array(
								'size' => '80x54',
							) ); ?>
						</div>

						<div class="post-info">
							<h3 class="post-title">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h3>
						</div>

					</div>

				</div>
			<?php endwhile; ?>

		</div>
	</div>
<?php endif; ?>
<?php wp_reset_postdata();
