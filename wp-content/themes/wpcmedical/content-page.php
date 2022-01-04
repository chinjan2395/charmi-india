<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package wpcmedical
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	/**
	 * Functions hooked in to wpcmedical_page add_action
	 *
	 * @see wpcmedical_page_header          - 10
	 * @see wpcmedical_page_content         - 20
	 */
	do_action( 'wpcmedical_page' );
	?>
</article><!-- #post-## -->
