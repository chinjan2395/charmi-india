<?php
/**
 * Template used to display post content.
 *
 * @package wpcmedical
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
	/**
	 * Functions hooked in to wpcmedical_loop_post action.
	 *
	 * @see wpcmedical_post_header          - 10
	 * @see wpcmedical_post_content         - 30
	 * @see wpcmedical_post_taxonomy        - 40
	 */
	do_action( 'wpcmedical_loop_post' );
	?>

</article><!-- #post-## -->
