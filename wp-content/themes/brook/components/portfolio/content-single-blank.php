<?php
/**
 * The template for displaying all single portfolio posts.
 *
 * @package Brook
 * @since   1.0
 */
get_header();
?>
<?php Brook_Templates::title_bar(); ?>
	<div id="page-content" class="page-content">
		<div class="container">
			<div class="row">

				<?php Brook_Templates::render_sidebar( 'left' ); ?>

				<div class="page-main-content">
					<?php while ( have_posts() ) : the_post(); ?>
						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<?php the_content(); ?>
						</article>

						<?php
						if ( Brook::setting( 'single_portfolio_pagination_enable' ) === '1' ) {
							Brook_Portfolio::nav_page_links();
						}
						?>

						<?php if ( Brook::setting( 'single_portfolio_related_enable' ) === '1' ) : ?>
							<?php get_template_part( 'components/portfolio/related' ); ?>
						<?php endif; ?>

						<?php
						// If comments are open or we have at least one comment, load up the comment template.
						if ( Brook::setting( 'single_portfolio_comment_enable' ) === '1' && ( comments_open() || get_comments_number() ) ) :
							comments_template();
						endif;
						?>
					<?php endwhile; ?>
				</div>

				<?php Brook_Templates::render_sidebar( 'right' ); ?>

			</div>
		</div>
	</div>
<?php
get_footer();
