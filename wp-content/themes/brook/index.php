<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
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
					<?php
					if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
						<h1 class="page-title"><?php the_title(); ?></h1>
						<?php
					endwhile;

						the_posts_navigation();

					else :

						get_template_part( 'components/content', 'none' );

					endif; ?>
				</div>

				<?php Brook_Templates::render_sidebar( 'right' ); ?>

			</div>
		</div>
	</div>
<?php get_footer();

