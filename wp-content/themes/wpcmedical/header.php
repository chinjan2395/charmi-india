<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package wpcmedical
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="//gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<?php do_action( 'wpcmedical_before_site' ); ?>

<div id="page" class="hfeed site">
	<?php do_action( 'wpcmedical_before_header' ); ?>

    <header id="masthead" class="site-header" role="banner" style="<?php wpcmedical_header_styles(); ?>">

		<?php
		do_action( 'wpcmedical_header' );
		/**
		 * Functions hooked into wpcmedical_header action
		 *
		 * @see wpcmedical_header_container                 - 0
		 * @see wpcmedical_header_row                       - 1
		 * @see wpcmedical_skip_links                       - 5
		 * @see wpcmedical_handheld_navigation_button       - 10
		 * @see wpcmedical_product_search                   - 15
		 * @see wpcmedical_site_branding                    - 20
		 * @see wpcmedical_header_account                   - 25
		 * @see wpcmedical_header_wishlist                  - 27
		 * @see wpcmedical_header_cart                      - 30
		 * @see wpcmedical_header_row_close                 - 41
		 * @see wpcmedical_header_row                       - 42
		 * @see wpcmedical_primary_navigation               - 50
		 * @see wpcmedical_header_row_close                 - 69
		 * @see wpcmedical_header_row                       - 70
		 * @see wpcmedical_handheld_navigation              - 75
		 * @see wpcmedical_header_row_close                 - 79
		 * @see wpcmedical_header_container_close           - 99
		 *
		 */
		?>

    </header><!-- #masthead -->

	<?php
	/**
	 * Functions hooked in to wpcmedical_before_content
	 *
	 * @see woocommerce_breadcrumb - 10
	 */
	do_action( 'wpcmedical_before_content' );
	?>

    <div id="content" class="site-content" tabindex="-1">
        <div class="col-full">

<?php
do_action( 'wpcmedical_content_top' );

