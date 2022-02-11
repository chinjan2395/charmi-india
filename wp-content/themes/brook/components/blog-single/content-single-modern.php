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
<div class="blog-modern-header">
	<div class="container">
		<div class="row">
			<div class="col-md-12">

				<?php if ( Brook::setting( 'single_post_feature_position' ) === 'below' ) : ?>
					<div class="entry-header">
						<?php if ( Brook::setting( 'single_post_title_enable' ) === '1' ) : ?>
							<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
						<?php endif; ?>

						<?php get_template_part( 'components/blog-single/modern/meta' ); ?>
					</div>
				<?php endif; ?>

			</div>
		</div>
	</div>
</div>

<div id="page-content" class="page-content">
	<div class="container">
		<div class="row">

			<?php Brook_Templates::render_sidebar( 'left' ); ?>

			<div class="page-main-content">
				<?php
				while ( have_posts() ) : the_post();

					get_template_part( 'components/blog-single/style', 'modern' );

				endwhile;
				?>
			</div>

			<?php Brook_Templates::render_sidebar( 'right' ); ?>

		</div>
	</div>

	<?php
	$next_post = get_next_post();
	?>
	<?php if ( Brook::setting( 'single_post_pagination_enable' ) === '1' && ! empty( $next_post ) ) { ?>
		<div class="post-pagination-next">
			<div class="row">
				<div class="col-md-push-2 col-md-8">
					<?php Brook_Templates::post_nav_next_link(); ?>
				</div>
			</div>
		</div>
	<?php } ?>

	<div class="single-post-extra-info">
		<div class="container">
			<div class="row">
				<div class="col-md-push-2 col-md-8">
					<?php
					$author_desc = get_the_author_meta( 'description' );
					if ( Brook::setting( 'single_post_author_box_enable' ) === '1' && ! empty( $author_desc ) ) {
						Brook_Templates::post_author();
					}

					if ( Brook::setting( 'single_post_related_enable' ) ) {
						get_template_part( 'components/blog-single/content-related-posts' );
					}

					// If comments are open or we have at least one comment, load up the comment template.
					if ( Brook::setting( 'single_post_comment_enable' ) === '1' && ( comments_open() || get_comments_number() ) ) :
						comments_template();
					endif;
					?>
				</div>
			</div>
		</div>
	</div>
</div>
