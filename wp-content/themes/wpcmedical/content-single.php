<?php
/**
 * Template used to display post content on single pages.
 *
 * @package wpcmedical
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
	do_action( 'wpcmedical_single_post_top' );

	/**
	 * Functions hooked into wpcmedical_single_post add_action
	 *
	 * @see wpcmedical_post_header          - 10
	 * @see wpcmedical_post_content         - 30
	 */
	do_action( 'wpcmedical_single_post' );

	/**
	 * Functions hooked in to wpcmedical_single_post_bottom action
	 *
	 * @see wpcmedical_post_nav         - 10
	 * @see wpcmedical_display_comments - 20
	 */
	do_action( 'wpcmedical_single_post_bottom' );
	?>

</article><!-- #post-## -->
