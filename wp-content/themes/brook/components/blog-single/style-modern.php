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

	<?php if ( Brook::setting( 'single_post_feature_enable' ) === '1' ) : ?>
		<?php get_template_part( 'components/blog-single/modern/format', $format ); ?>
	<?php endif; ?>

	<?php if ( Brook::setting( 'single_post_feature_position' ) === 'above' ) : ?>
		<div class="entry-header">
			<?php if ( Brook::setting( 'single_post_title_enable' ) === '1' ) : ?>
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			<?php endif; ?>

			<?php get_template_part( 'components/blog-single/modern/meta' ); ?>
		</div>
	<?php endif; ?>

	<div class="entry-content-wrap row">

		<div class="col-md-2">
			<?php
			$button_return_text = Brook::setting( 'single_post_button_return_text' );
			$button_return_link = Brook::setting( 'single_post_button_return_link' );
			?>
			<?php if ( $button_return_text !== '' && $button_return_link !== '' ): ?>
				<div class="post-return-archive">
					<a href="<?php echo esc_url( $button_return_link ); ?>">
						<span class="fa fa-arrow-left"></span>
						<?php echo esc_html( $button_return_text ); ?>
					</a>
				</div>
			<?php endif; ?>
		</div>

		<div class="col-md-8">
			<div class="entry-content">
				<?php
				the_content( sprintf( /* translators: %s: Name of current post. */
					wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'brook' ), array( 'span' => array( 'class' => array() ) ) ), the_title( '<span class="screen-reader-text">"', '"</span>', false ) ) );

				Brook_Templates::page_links();
				?>
			</div>

			<div class="entry-footer">
				<div class="row row-xs-center">
					<div class="col-md-12">
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
				</div>
			</div>
		</div>

		<div class="col-md-2">
			<?php if ( Brook::setting( 'single_post_share_enable' ) === '1' ) : ?>
				<?php Brook_Templates::post_sharing_modern(); ?>
			<?php endif; ?>
		</div>

	</div>

</article>
