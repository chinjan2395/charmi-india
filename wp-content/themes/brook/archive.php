<?php
/**
 * The template for displaying archive pages.
 *
 * @link     https://codex.wordpress.org/Template_Hierarchy
 *
 * @package  Brook
 * @since    1.0
 */
get_header();
?>
<?php Brook_Templates::title_bar(); ?>
	<div id="page-content" class="page-content">
		<div class="container">
			<div class="row">

				<?php Brook_Templates::render_sidebar( 'left' ); ?>

				<div class="page-main-content">
					<?php get_template_part( 'components/content', 'blog' ); ?>
				</div>

				<?php Brook_Templates::render_sidebar( 'right' ); ?>

			</div>
		</div>
	</div>
<?php get_footer();
