<?php
/**
 * Template part for displaying blog content in single.php.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Brook
 * @since   1.0
 */

?>
<div id="page-content" class="page-content">
	<div class="container">
		<div class="row">

			<?php Brook_Templates::render_sidebar( 'left' ); ?>

			<div class="page-main-content">
				<?php
				while ( have_posts() ) : the_post();

					get_template_part( 'components/blog-single/style', 'standard' );

				endwhile;
				?>
			</div>

			<?php Brook_Templates::render_sidebar( 'right' ); ?>

		</div>
	</div>
</div>
