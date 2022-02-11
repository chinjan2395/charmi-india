<?php
defined( 'ABSPATH' ) || exit;

$post_type          = 'portfolio';
$style              = $el_class = $order = $overlay_style = $animation = '';
$image_size         = $masonry_image_size_width = '';
$filter_by          = $filter_wrap = $filter_enable = $filter_align = $filter_counter = $filter_type = $filter_counter_style = '';
$pagination_align   = $pagination_button_text = '';
$carousel_direction = $carousel_items_display = $carousel_gutter = $carousel_nav = $carousel_pagination = $carousel_auto_play = '';
$justify_row_height = $justify_max_row_height = $justify_last_row_alignment = '';
$gutter             = 0;
$main_query         = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass( $el_class );
$el_id    = Brook_VC::get_shortcode_el_id( $atts, 'tm-portfolio-' );
$css_id   = "#{$el_id}";

$this->get_inline_css( $css_id, $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-portfolio ' . $el_class, $this->settings['base'], $atts );
$css_class .= " style-$style";

if ( $overlay_style !== '' ) {
	$css_class .= " portfolio-overlay-$overlay_style";
}

$css_class .= Brook_Helper::get_animation_classes();

if ( $number === '' ) {
	$number = get_option( 'posts_per_page' );
}

if ( $image_size === '' ) {
	$image_size = '481x325';
}

$brook_post_args = array(
	'post_type'      => 'portfolio',
	'posts_per_page' => $number,
	'orderby'        => $orderby,
	'order'          => $order,
	'paged'          => 1,
	'post_status'    => 'publish',
);

if ( in_array( $orderby, array( 'meta_value', 'meta_value_num' ), true ) ) {
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

$is_swiper = false;
if ( in_array( $style, array(
	'carousel',
	'carousel-auto-wide',
	'carousel-auto-wide-02',
	'carousel-auto-wide-large',
	'fullscreen-slider',
	'fullscreen-slider-02',
), true ) ) {
	$is_swiper = true;
}

if ( $filter_wrap === '1' ) {
	$css_class .= ' filter-wrap';
}

if ( $filter_counter_style !== '' ) {
	$css_class .= " filter-counter-style-$filter_counter_style";
}

$grid_classes = 'tm-grid';

if ( $is_swiper ) {
	$grid_classes   .= ' swiper-wrapper';
	$slider_classes = 'tm-swiper';
	if ( $carousel_nav !== '' ) {
		$slider_classes .= " nav-style-$carousel_nav";
	}
	if ( $carousel_pagination !== '' ) {
		$slider_classes .= " pagination-style-$carousel_pagination";
	}
} else {
	$grid_classes .= Brook_Helper::get_grid_animation_classes( $animation );
}

if ( $style === 'justified' ) {
	wp_enqueue_style( 'justifiedGallery' );
	wp_enqueue_script( 'justifiedGallery' );
} elseif ( in_array( $style, array( 'masonry', 'masonry-with-caption' ), true ) ) {
	wp_enqueue_script( 'isotope-packery' );
} elseif ( in_array( $style, array(
	'grid',
	'grid-caption',
	'grid-caption-video-popup',
	'metro',
	'metro-02',
	'metro-with-caption',
), true ) ) {
	$grid_classes .= ' modern-grid';
}

if ( $overlay_style === 'parallax' ) {
	wp_enqueue_script( 'tilt' );
}
?>
<?php if ( $brook_query->have_posts() ) : ?>
	<div class="tm-grid-wrapper <?php echo esc_attr( trim( $css_class ) ); ?>"
	     id="<?php echo esc_attr( $el_id ); ?>"

		<?php if ( $pagination !== '' && $brook_query->found_posts > $number ) : ?>
			data-pagination="<?php echo esc_attr( $pagination ); ?>"
		<?php endif; ?>

		<?php if ( $pagination_custom_button_id !== '' ): ?>
			data-pagination-custom-button-id="<?php echo esc_attr( $pagination_custom_button_id ); ?>"
		<?php endif; ?>

		 data-filter-type="<?php echo esc_attr( $filter_type ); ?>"

		<?php if ( in_array( $style, array( 'masonry', 'masonry-with-caption' ), true ) ) { ?>
			data-type="masonry"
		<?php } elseif ( $is_swiper ) { ?>
			data-type="swiper"
		<?php } elseif ( $style === 'justified' ) { ?>
			data-type="justified"

			<?php if ( $justify_row_height !== '' && $justify_row_height > 0 ) { ?>
				data-justified-height="<?php echo esc_attr( $justify_row_height ); ?>"
			<?php } ?>

			<?php if ( $justify_max_row_height !== '' && $justify_max_row_height > 0 ) { ?>
				data-justified-max-height="<?php echo esc_attr( $justify_max_row_height ); ?>"
			<?php } ?>

			<?php if ( $justify_last_row_alignment !== '' ) { ?>
				data-justified-last-row="<?php echo esc_attr( $justify_last_row_alignment ); ?>"
			<?php } ?>
		<?php } ?>

		<?php if ( $style === 'metro' ) : ?>
			data-grid-ratio="1:1"
		<?php endif; ?>

		<?php if ( in_array( $style, array( 'masonry', 'masonry-with-caption' ), true ) ) { ?>
			<?php if ( $columns !== '' ): ?>
				<?php
				$arr = explode( ';', $columns );
				foreach ( $arr as $value ) {
					$tmp = explode( ':', $value );
					echo ' data-' . $tmp[0] . '-columns="' . esc_attr( $tmp[1] ) . '"';
				}
				?>
			<?php endif; ?>

			<?php if ( $gutter !== '' && $gutter !== 0 ) : ?>
				data-gutter="<?php echo esc_attr( $gutter ); ?>"
			<?php endif; ?>
		<?php } ?>

		<?php if ( $overlay_style === 'parallax' ): ?>
			data-hover="tilt"
		<?php endif; ?>
	>
		<?php
		$count = $brook_query->post_count;

		$tm_grid_query                             = $brook_post_args;
		$tm_grid_query['action']                   = "{$post_type}_infinite_load";
		$tm_grid_query['max_num_pages']            = $brook_query->max_num_pages;
		$tm_grid_query['found_posts']              = $brook_query->found_posts;
		$tm_grid_query['taxonomies']               = $taxonomies;
		$tm_grid_query['style']                    = $style;
		$tm_grid_query['image_size']               = $image_size;
		$tm_grid_query['masonry_image_size_width'] = $masonry_image_size_width;
		$tm_grid_query['overlay_style']            = $overlay_style;
		$tm_grid_query['metro_layout']             = $metro_layout;
		$tm_grid_query['pagination']               = $pagination;
		$tm_grid_query['count']                    = $count;
		$tm_grid_query                             = htmlspecialchars( wp_json_encode( $tm_grid_query ) );
		?>

		<?php Brook_Templates::grid_filters( $post_type, $filter_enable, $filter_align, $filter_counter, $filter_wrap, $brook_query->found_posts, $filter_by ); ?>

		<input type="hidden" class="tm-grid-query" <?php echo 'value="' . $tm_grid_query . '"'; ?>/>

		<?php if ( $is_swiper ) { ?>
		<div class="<?php echo esc_attr( $slider_classes ); ?>"
			<?php if ( $style === 'carousel-auto-wide' ) { ?>
				data-lg-items="auto"
				data-centered="1"
				data-initial-slide="1"
				data-loop="1"

				<?php if ( $carousel_gutter > 1 ) : ?>
					data-lg-gutter="<?php echo esc_attr( $carousel_gutter ); ?>"
				<?php endif; ?>

			<?php } elseif ( $style === 'carousel-auto-wide-02' ) { ?>
				data-lg-items="auto"
				data-loop="1"

				<?php if ( $carousel_gutter > 1 ) : ?>
					data-lg-gutter="<?php echo esc_attr( $carousel_gutter ); ?>"
				<?php endif; ?>

			<?php } elseif ( $style === 'carousel-auto-wide-large' ) { ?>
				data-lg-items="auto"
				data-loop="1"

				<?php if ( $carousel_gutter > 1 ) : ?>
					data-lg-gutter="<?php echo esc_attr( $carousel_gutter ); ?>"
				<?php endif; ?>

			<?php } elseif ( $style === 'fullscreen-slider' ) { ?>
				data-lg-items="1"
				data-loop="1"
			<?php } elseif ( $style === 'fullscreen-slider-02' ) { ?>
				data-lg-items="1"
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
				     data-overlay-animation="<?php echo esc_attr( $overlay_style ); ?>"
				>

					<?php
					set_query_var( 'brook_query', $brook_query );
					set_query_var( 'count', $count );
					set_query_var( 'image_size', $image_size );
					set_query_var( 'masonry_image_size_width', $masonry_image_size_width );
					set_query_var( 'overlay_style', $overlay_style );
					set_query_var( 'metro_layout', $metro_layout );

					get_template_part( 'loop/shortcodes/portfolio/style', $style );
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
