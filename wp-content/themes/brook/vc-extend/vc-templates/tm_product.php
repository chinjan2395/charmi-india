<?php
defined( 'ABSPATH' ) || exit;

$post_type   = 'product';
$style       = $el_class = $columns = $animation = '';
$pagination  = $pagination_align = $pagination_button_text = $pagination_custom_button_id = '';
$gutter      = 0;
$filter_wrap = $filter_enable = $filter_align = $filter_counter = '';

$atts   = vc_map_get_attributes( $this->getShortcode(), $atts );
$css_id = uniqid( 'tm-product-' );
$this->get_inline_css( "#$css_id", $atts );
extract( $atts );

$brook_post_args = array(
	'post_type'      => $post_type,
	'posts_per_page' => $number,
	'orderby'        => $orderby,
	'order'          => $order,
	'paged'          => 1,
	'post_status'    => 'publish',
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
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-grid-wrapper tm-product ' . $el_class, $this->settings['base'], $atts );
$css_class .= " style-$style";

if ( $filter_wrap === '1' ) {
	$css_class .= ' filter-wrap';
}

if ( $filter_counter_style !== '' ) {
	$css_class .= " filter-counter-style-$filter_counter_style";
}

$grid_classes = 'tm-grid modern-grid';
$grid_classes .= Brook_Helper::get_grid_animation_classes( $animation );

Brook_Enqueue::instance()->enqueue_woocommerce_styles_scripts();
?>
<?php if ( $brook_query->have_posts() ) : ?>
	<div class="woocommerce">
		<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>"
			<?php if ( $pagination !== '' && $brook_query->found_posts > $number ) : ?>
				data-pagination="<?php echo esc_attr( $pagination ); ?>"
			<?php endif; ?>

			<?php if ( $pagination_custom_button_id !== '' ): ?>
				data-pagination-custom-button-id="<?php echo esc_attr( $pagination_custom_button_id ); ?>"
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
			$tm_grid_query                  = htmlspecialchars( wp_json_encode( $tm_grid_query ) );
			?>

			<?php Brook_Templates::grid_filters( $post_type, $filter_enable, $filter_align, $filter_counter, $filter_wrap, $brook_query->found_posts, $filter_by ); ?>

			<input type="hidden" class="tm-grid-query" <?php echo 'value="' . $tm_grid_query . '"'; ?>/>

			<div class="<?php echo esc_attr( $grid_classes ); ?>">
				<?php while ( $brook_query->have_posts() ) : $brook_query->the_post(); ?>
					<?php wc_get_template_part( 'content', 'product' ); ?>
				<?php endwhile; ?>
			</div>

			<?php Brook_Templates::grid_pagination( $brook_query, $number, $pagination, $pagination_align, $pagination_button_text ); ?>

		</div>
	</div>
<?php endif;
wp_reset_postdata();
