<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package wpcmedical
 */

?>

</div><!-- .col-full -->
</div><!-- #content -->

<?php do_action( 'wpcmedical_before_footer' ); ?>

<footer id="colophon" class="site-footer" role="contentinfo">
    <div class="col-full">

		<?php
		/**
		 * Functions hooked in to wpcmedical_footer action
		 *
		 * @see wpcmedical_footer_widgets - 10
		 * @see wpcmedical_credit         - 20
		 */
		do_action( 'wpcmedical_footer' );
		?>

    </div><!-- .col-full -->
</footer><!-- #colophon -->

<?php do_action( 'wpcmedical_after_footer' ); ?>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
