<?php
/**
 * Template part for displaying single post pages.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Brook
 * @since   1.0
 */

$format = Brook_Post::get_the_post_format();
?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php if ( Brook::setting( 'single_post_feature_enable' ) === '1' && Brook::setting( 'single_post_feature_position' ) === 'above' ) : ?>
			<?php get_template_part( 'components/blog-single/standard/format', $format ); ?>
		<?php endif; ?>

		<div class="entry-header">
			<?php if ( Brook::setting( 'single_post_title_enable' ) === '1' ) : ?>
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			<?php endif; ?>

			<?php get_template_part( 'components/blog-single/standard/meta' ); ?>
		</div>

		<?php if ( Brook::setting( 'single_post_feature_enable' ) === '1' && Brook::setting( 'single_post_feature_position' ) === 'below' ) : ?>
			<?php get_template_part( 'components/blog-single/standard/format', $format ); ?>
		<?php endif; ?>

		<div class="entry-content">
			<?php
			the_content( sprintf( /* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'brook' ), array( 'span' => array( 'class' => array() ) ) ), the_title( '<span class="screen-reader-text">"', '"</span>', false ) ) );

			Brook_Templates::page_links();
			?>
		</div>

		<div class="entry-footer">
			<div class="row row-xs-center">
				<div class="col-md-6">
					<?php if ( Brook::setting( 'single_post_tags_enable' ) === '1' && has_tag() ) : ?>
						<div class="post-tags">
							<h6 class="tagcloud-heading">
								<?php esc_html_e( 'Tags: ', 'brook' ); ?>
							</h6>
							<div class="tagcloud">
								<?php the_tags( '', ', ', '' ); ?>
							</div>
						</div>
					<?php endif; ?>
				</div>
				<div class="col-md-6">
					<?php if ( Brook::setting( 'single_post_share_enable' ) === '1' ) : ?>
						<?php Brook_Templates::post_sharing(); ?>
					<?php endif; ?>
				</div>
			</div>
		</div>

	</article>
<?php
$author_desc = get_the_author_meta( 'description' );
if ( Brook::setting( 'single_post_author_box_enable' ) === '1' && ! empty( $author_desc ) ) {
	Brook_Templates::post_author();
}

if ( Brook::setting( 'single_post_pagination_enable' ) === '1' ) {
	Brook_Templates::post_nav_links();
}

if ( Brook::setting( 'single_post_related_enable' ) ) {
	get_template_part( 'components/blog-single/content-related-posts' );
}

// If comments are open or we have at least one comment, load up the comment template.
if ( Brook::setting( 'single_post_comment_enable' ) === '1' && ( comments_open() || get_comments_number() ) ) :
	comments_template();
endif;
