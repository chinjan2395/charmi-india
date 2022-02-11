<?php
/**
 * Template Name: One Page Scroll
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Brook
 * @since   1.0
 */

get_header();

$nav_enable = Brook_Helper::get_post_meta( 'one_page_scroll_nav_enable', '1' );
$nav_enable = $nav_enable && $nav_enable === '1' ? true : false;

$effect = Brook_Helper::get_post_meta( 'one_page_scroll_effect', '1' );

$classes = 'one-page-scroll tm-enable-onepage-animation';
$classes .= " tm-3d-style-{$effect}";
?>
	<div id="page-content" class="page-content">
		<div id="one-page-scroll" class="<?php echo esc_attr( $classes ); ?>"
			<?php if ( $nav_enable ) : ?>
				data-enable-dots="1"
			<?php endif; ?>
		>
			<?php
			if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<?php the_content(); ?>
			<?php
			endwhile;
				the_posts_navigation();
			else :
				get_template_part( 'components/content', 'none' );
			endif; ?>
		</div>
	</div>

<?php get_footer();
