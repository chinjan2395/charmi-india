<?php
defined( 'ABSPATH' ) || exit;

$post_type  = 'post';
$style      = $el_class = '';
$categories = $meta_key = $main_query = $pagination = $animation = '';

$atts   = vc_map_get_attributes( $this->getShortcode(), $atts );
$css_id = uniqid( 'tm-blog-' );
$this->get_inline_css( "#$css_id", $atts );
Brook_VC::get_shortcode_custom_css( "#$css_id", $atts );
extract( $atts );

$brook_post_args = array(
	'post_type'      => $post_type,
	'posts_per_page' => $number,
	'orderby'        => $orderby,
	'order'          => $order,
	'paged'          => 1,
	'post_status'    => 'publish',
	'post__not_in'   => get_option( 'sticky_posts' ),
);

if ( in_array( $orderby, array( 'meta_value', 'meta_value_num' ) ) ) {
	$brook_post_args['meta_key'] = $meta_key;
}

if ( get_query_var( 'paged' ) ) {
	$brook_post_args['paged'] = get_query_var( 'paged' );
} elseif ( get_query_var( 'page' ) ) {
	$brook_post_args['paged'] = get_query_var( 'page' );
}

$brook_post_args = Brook_VC::get_tax_query_of_taxonomies( $brook_post_args, $taxonomies );

if ( $main_query === '1' ) {
	global $wp_query;
	$brook_query = $wp_query;
} else {
	$brook_query = new WP_Query( $brook_post_args );
}

$el_class  = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-blog ' . $el_class, $this->settings['base'], $atts );
$css_class .= " style-$style";

if ( $filter_wrap === '1' ) {
	$css_class .= ' filter-wrap';
}

if ( $filter_counter_style !== '' ) {
	$css_class .= " filter-counter-style-$filter_counter_style";
}

$grid_classes = 'tm-grid';
$is_swiper    = false;

if ( in_array( $style, array(
	'grid-classic',
	'grid-classic-02',
	'grid-classic-03',
	'grid-minimal',
	'grid-minimal-faded',
	'grid-minimal-outline',
	'grid-sticky',
	'grid-metro',
	'grid-simple',
	'grid-simple-02',
	'grid-standard',
	'grid-modern',
) ) ) {
	$grid_classes .= ' modern-grid';
} elseif ( $style === 'carousel-centered' ) {
	$is_swiper = true;
} elseif ( $style === 'grid-masonry' ) {
	wp_enqueue_script( 'isotope-packery' );
}

if ( $is_swiper ) {
	$grid_classes   .= ' swiper-wrapper';
	$slider_classes = 'tm-swiper';
	if ( $carousel_nav !== '' ) {
		$slider_classes .= " nav-style-$carousel_nav";
	}
	if ( $carousel_pagination !== '' ) {
		$slider_classes .= " pagination-style-$carousel_pagination";
	}

	if ( $style === 'carousel-centered' ) {
		$slider_classes .= ' auto-slide-wide';
	}
} else {
	$grid_classes .= Brook_Helper::get_grid_animation_classes( $animation );
}
?>

<?php if ( $brook_query->have_posts() ) : ?>
	<div class="tm-grid-wrapper <?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>"
		<?php if ( $pagination !== '' && $brook_query->found_posts > $number ) : ?>
			data-pagination="<?php echo esc_attr( $pagination ); ?>"
		<?php endif; ?>

		<?php if ( $pagination_custom_button_id !== '' ): ?>
			data-pagination-custom-button-id="<?php echo esc_attr( $pagination_custom_button_id ); ?>"
		<?php endif; ?>

		 data-filter-type="<?php echo esc_attr( $filter_type ); ?>"

		<?php if ( in_array( $style, array( 'grid-masonry' ), true ) ) { ?>
			data-type="masonry"
		<?php } elseif ( $is_swiper ) { ?>
			data-type="swiper"
		<?php } ?>

		<?php if ( in_array( $style, array( 'grid-masonry' ), true ) && $columns !== '' ): ?>
			<?php
			$arr = explode( ';', $columns );
			foreach ( $arr as $value ) {
				$tmp = explode( ':', $value );
				echo ' data-' . $tmp[0] . '-columns="' . esc_attr( $tmp[1] ) . '"';
			}
			?>

			<?php if ( $gutter !== '' && $gutter !== 0 ) : ?>
				data-gutter="<?php echo esc_attr( $gutter ); ?>"
			<?php endif; ?>
		<?php endif; ?>
	>
		<?php
		$count = $brook_query->post_count;

		$tm_grid_query                  = $brook_post_args;
		$tm_grid_query['action']        = "{$post_type}_infinite_load";
		$tm_grid_query['max_num_pages'] = $brook_query->max_num_pages;
		$tm_grid_query['found_posts']   = $brook_query->found_posts;
		$tm_grid_query['taxonomies']    = $taxonomies;
		$tm_grid_query['style']         = $style;
		$tm_grid_query['pagination']    = $pagination;
		$tm_grid_query['count']         = $count;
		$tm_grid_query['metro_layout']  = $metro_layout;
		$tm_grid_query                  = htmlspecialchars( wp_json_encode( $tm_grid_query ) );
		?>

		<?php Brook_Templates::grid_filters( $post_type, $filter_enable, $filter_align, $filter_counter, $filter_wrap, $brook_query->found_posts, $filter_by ); ?>

		<input type="hidden" class="tm-grid-query" value="<?php echo '' . $tm_grid_query; ?>"/>

		<?php if ( $is_swiper ) { ?>
		<div class="<?php echo esc_attr( $slider_classes ); ?>"
			<?php if ( $style === 'carousel-centered' ) { ?>
				data-lg-items="auto"
				data-centered="1"
				data-initial-slide="1"
				data-loop="1"

				<?php if ( $carousel_gutter > 1 ) : ?>
					data-lg-gutter="<?php echo esc_attr( $carousel_gutter ); ?>"
				<?php endif; ?>
			<?php } else { ?>
				<?php
				if ( $carousel_items_display !== '' ) {
					$arr = explode( ';', $carousel_items_display );
					foreach ( $arr as $value ) {
						$tmp = explode( ':', $value );
						echo ' data-' . $tmp[0] . '-items="' . $tmp[1] . '"';
					}
				}
				?>

				<?php if ( $carousel_gutter > 1 ) : ?>
					data-lg-gutter="<?php echo esc_attr( $carousel_gutter ); ?>"
				<?php endif; ?>

			<?php } ?>

			<?php if ( $carousel_nav !== '' ) : ?>
				data-nav="1"
			<?php endif; ?>

			<?php if ( $carousel_nav === 'custom' ) : ?>
				data-custom-nav="<?php echo esc_attr( $slider_button_id ); ?>"
			<?php endif; ?>

			<?php if ( $carousel_pagination !== '' ) : ?>
				data-pagination="1"
			<?php endif; ?>

			<?php if ( $carousel_auto_play !== '' ) : ?>
				data-autoplay="<?php echo esc_attr( $carousel_auto_play ); ?>"
			<?php endif; ?>
		>
			<div class="swiper-container">
				<?php } ?>

				<div class="<?php echo esc_attr( $grid_classes ); ?>"
					<?php if ( in_array( $style, array( 'list' ), true ) ) : ?>
						data-grid-has-gallery="true"
					<?php endif; ?>
				>
					<?php
					set_query_var( 'brook_query', $brook_query );
					set_query_var( 'count', $count );
					set_query_var( 'metro_layout', $metro_layout );

					get_template_part( 'loop/shortcodes/blog/style', $style );
					?>
				</div>

				<?php if ( $is_swiper ) { ?>
			</div>
		</div>
	<?php } ?>

		<?php Brook_Templates::grid_pagination( $brook_query, $number, $pagination, $pagination_align, $pagination_button_text ); ?>

	</div>
<?php endif; ?>
<?php wp_reset_postdata();
