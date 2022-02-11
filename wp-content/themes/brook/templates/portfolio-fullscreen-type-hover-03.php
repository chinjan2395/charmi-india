<?php
/**
 * Template Name: Portfolio Fullscreen Type Hover 03
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Brook
 * @since   1.0
 */
get_header();

$cats            = Brook::setting( 'portfolio_fullscreen_type_hover_03_categories' );
$tags            = Brook::setting( 'portfolio_fullscreen_type_hover_03_tags' );
$number          = Brook::setting( 'portfolio_fullscreen_type_hover_03_number' );
$left_text       = Brook::setting( 'portfolio_fullscreen_type_hover_03_left_text' );
$social_networks = Brook::setting( 'portfolio_fullscreen_type_hover_03_social_networks_enable' );

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
		$image_template = '';
		$title_template = '';
		?>

		<?php while ( $insight_query->have_posts() ) : $insight_query->the_post(); ?>

			<?php ob_start(); ?>

			<div class="swiper-slide">
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
			</div>

			<?php $image_template .= ob_get_clean(); ?>

			<?php ob_start(); ?>

			<div class="post-thumbnail-bg <?php echo esc_attr( 'post-' . get_the_ID() ); ?>"
			     style="background-image: url( <?php Brook_Image::the_post_thumbnail_url( array( 'size' => '1720x720' ) ); ?> )">

			</div>

			<?php $title_template .= ob_get_clean(); ?>

			<?php $c++; ?>

		<?php endwhile; ?>

		<div class="portfolio-hover-type-wrap">
			<div id="portfolio-feature-bg">
				<?php Brook_Helper::e( $title_template ); ?>
			</div>

			<div id="portfolio-list" class="portfolio-list">

				<div class="tm-swiper equal-height"
				     data-lg-items="4"
				     data-md-items="3"
				     data-sm-items="2"
				     data-xs-items="1"
				     data-lg-gutter="120"
				     data-loop="1"
				     data-autoplay="3000"
				>
					<div class="swiper-container">
						<div class="swiper-wrapper">
							<?php Brook_Helper::e( $image_template ); ?>
						</div>
					</div>
				</div>

			</div>
		</div>

	</div>

	<div class="page-extra-info">
		<?php if ( $left_text !== '' ): ?>
			<div class="page-left-text">
				<?php echo $left_text; ?>
			</div>
		<?php endif; ?>

		<?php if ( $social_networks === '1' ): ?>
			<div class="page-social-networks">
				<?php Brook_Templates::social_icons( array(
					'tooltip_enable' => false,
				) ); ?>
			</div>
		<?php endif; ?>
	</div>

<?php endif; ?>
<?php wp_reset_postdata(); ?>

<?php get_footer();
