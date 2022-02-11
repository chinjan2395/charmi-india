<?php
/**
 * The template for displaying archive portfolio pages.
 *
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Brook
 * @since   1.0
 */
get_header();

$style         = Brook::setting( 'archive_portfolio_style' );
$columns       = Brook::setting( 'archive_portfolio_columns' );
$gutter        = Brook::setting( 'archive_portfolio_gutter' );
$image_size    = Brook::setting( 'archive_portfolio_thumbnail_size' );
$overlay_style = Brook::setting( 'archive_portfolio_overlay_style' );
$animation     = Brook::setting( 'archive_portfolio_animation' );
?>
<?php Brook_Templates::title_bar(); ?>
	<div id="page-content" class="page-content">
		<div class="container">
			<div class="row">

				<?php Brook_Templates::render_sidebar( 'left' ); ?>

				<div class="page-main-content">
					<?php if ( have_posts() ) : ?>
						<?php
						$args = array();

						$args[] = 'style="' . $style . '"';
						$args[] = 'columns="' . $columns . '"';
						$args[] = 'gutter="' . $gutter . '"';
						$args[] = 'image_size="' . $image_size . '"';
						$args[] = 'overlay_style="' . $overlay_style . '"';
						$args[] = 'animation="' . $animation . '"';
						$args[] = 'pagination="pagination"';
						$args[] = 'pagination_align="center"';
						$args[] = 'filter_enable=""';
						$args[] = 'main_query="1"';

						$shortcode_string = '[tm_portfolio ' . implode( ' ', $args ) . ']';

						echo do_shortcode( $shortcode_string );
						?>
					<?php else :
						get_template_part( 'components/content', 'none' );
					endif; ?>
				</div>

				<?php Brook_Templates::render_sidebar( 'right' ); ?>

			</div>
		</div>
	</div>
<?php get_footer();
