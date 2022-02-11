<?php
/**
 * The template for displaying the footer.
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Brook
 * @since   1.0
 */

?>
</div><!-- /.content-wrapper -->

<?php Brook_THA::instance()->footer_before(); ?>
<?php get_template_part( 'components/footer' ); ?>
<?php Brook_THA::instance()->footer_after(); ?>

</div><!-- /.site -->

<?php Brook_THA::instance()->body_bottom(); ?>

<?php wp_footer(); ?>
</body>
</html>
