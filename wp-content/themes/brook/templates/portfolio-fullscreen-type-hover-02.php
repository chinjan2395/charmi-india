<?php
/**
 * Template Name: Portfolio Fullscreen Type Hover 02
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Brook
 * @since   1.0
 */
get_header();

$cats   = Brook::setting( 'portfolio_fullscreen_type_hover_02_categories' );
$tags   = Brook::setting( 'portfolio_fullscreen_type_hover_02_tags' );
$number = Brook::setting( 'portfolio_fullscreen_type_hover_02_number' );

$insight_post_args = array(
	'post_type'      => 'portfolio',
	'orderby'        => 'date',
	'order'          => 'DESC',
	'post_status'    => 'publish',
	'posts_per_page' => $number,
	'no_found_rows'  => true,
);

if ( ! empty( $cats ) || ! empty( $tags ) ) {
	$insight_post_args['tax_query'] = array();
	$tax_queries                    = array();
	if ( ! empty( $cats ) ) {
		$tax_queries[] = array(
			'taxonomy' => 'portfolio_category',
			'field'    => 'slug',
			'terms'    => $cats,
		);
	}
	if ( ! empty( $tags ) ) {
		$tax_queries[] = array(
			'taxonomy' => 'portfolio_tags',
			'field'    => 'slug',
			'terms'    => $tags,
		);
	}
	$insight_post_args['tax_query']             = $tax_queries;
	$insight_post_args['tax_query']['relation'] = 'OR';
}

$insight_query = new WP_Query( $insight_post_args );
$c             = 1;
?>
<?php if ( $insight_query->have_posts() ) : ?>
	<div id="page-content" class="page-content">

		<?php
		$left_col_template  = '';
		$right_col_template = '';
		?>

		<?php while ( $insight_query->have_posts() ) : $insight_query->the_post(); ?>

			<?php ob_start(); ?>

			<div class="portfolio" data-id="<?php echo esc_attr( get_the_ID() ); ?>">
				<a href="<?php the_permalink(); ?>" class="post-permalink">
					<h3 class="post-title">
					<span class="post-order">
						<?php $number = str_pad( $c, 2, '0', STR_PAD_LEFT ); ?>
						<?php echo esc_html( $number ); ?>
					</span>
						<?php the_title(); ?>
					</h3>
				</a>
			</div>

			<?php $left_col_template .= ob_get_clean(); ?>

			<?php ob_start(); ?>

			<div class="post-thumbnail-bg <?php echo esc_attr( 'post-' . get_the_ID() ); ?>">
				<?php
				Brook_Image::the_post_thumbnail( array(
					'size' => '1030x670',
				) );
				?>
			</div>

			<?php $right_col_template .= ob_get_clean(); ?>

			<?php $c++; ?>

		<?php endwhile; ?>

		<div class="portfolio-hover-type-wrap">
			<div id="portfolio-feature-bg">
				<?php Brook_Helper::e( $right_col_template ); ?>
			</div>

			<div id="portfolio-list" class="portfolio-list">
				<?php Brook_Helper::e( $left_col_template ); ?>
			</div>
		</div>

	</div>

<?php endif; ?>
<?php wp_reset_postdata(); ?>

<?php get_footer();
