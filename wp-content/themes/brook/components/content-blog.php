<?php
/**
 * Template part for displaying blog content in home.php, archive.php.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Brook
 * @since   1.0
 */
$style = 'list';

if ( have_posts() ) : ?>

	<?php if ( class_exists( 'Vc_Manager' ) ) { ?>
		<?php echo do_shortcode( '[tm_blog main_query="1" gutter="30" number="9" pagination="pagination"]' ); ?>
	<?php } else { ?>
		<div class="tm-grid-wrapper tm-blog style-list">
			<div class="tm-grid has-animation move-up"
			     data-grid-has-gallery="true"
			>
				<?php
				global $wp_query;
				$brook_query = $wp_query;
				set_query_var( 'brook_query', $brook_query );

				get_template_part( 'loop/shortcodes/blog/style', 'list' );
				?>
			</div>
		</div>
		<div class="tm-grid-pagination">
			<?php Brook_Templates::paging_nav(); ?>
		</div>
	<?php } ?>
<?php else : get_template_part( 'components/content', 'none' ); ?>
<?php endif; ?>
