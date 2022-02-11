<?php
/**
 * The template for displaying all single posts.
 *
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Brook
 * @since   1.0
 */
get_header();

$blog_style = Brook_Helper::get_post_meta( 'single_post_style', '' );

if ( $blog_style === '' ) {
	$blog_style = Brook::setting( 'single_post_style' );
}
?>
<?php Brook_Templates::title_bar(); ?>

<?php get_template_part( 'components/blog-single/content-single', $blog_style ); ?>

<?php
get_footer();
