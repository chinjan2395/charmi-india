<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked wc_print_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.

	return;
}
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>

	<?php $nav_links_enable = Brook::setting( 'single_product_nav_links' ); ?>

	<?php if ( $nav_links_enable === '1' ): ?>
		<div class="woo-nav-links">
			<div class="nav-list">
				<div class="nav-item prev">
					<?php previous_post_link( '%link', '<div>' . esc_html__( 'Prev', 'brook' ) . '</div>' ); ?>
				</div>

				<div class="nav-item next">
					<?php next_post_link( '%link', '<div>' . esc_html__( 'Next', 'brook' ) . '</div>' ); ?>
				</div>
			</div>
		</div>
	<?php endif; ?>

	<div class="row tm-sticky-parent woo-single-info">
		<div class="col-md-6">
			<div class="tm-sticky-column">

				<div class="woo-single-images product-feature tm-light-gallery">
					<?php
					/**
					 * woocommerce_before_single_product_summary hook.
					 *
					 * @hooked woocommerce_show_product_sale_flash - 10
					 * @hooked woocommerce_show_product_images - 20
					 */
					do_action( 'woocommerce_before_single_product_summary' );
					?>
				</div>

			</div>
		</div>

		<div class="col-md-6">
			<div class="tm-sticky-column">
				<div class="woo-single-summary summary entry-summary">
					<?php
					/**
					 * woocommerce_single_product_summary hook.
					 *
					 * @hooked woocommerce_template_single_title - 5
					 * @hooked woocommerce_template_single_rating - 10
					 * @hooked woocommerce_template_single_price - 10
					 * @hooked woocommerce_template_single_excerpt - 20
					 * @hooked woocommerce_template_single_add_to_cart - 30
					 * @hooked woocommerce_template_single_meta - 40
					 * @hooked woocommerce_template_single_sharing - 50
					 */
					do_action( 'woocommerce_single_product_summary' );
					?>
				</div>
			</div>
		</div>
	</div>

	<div class="container no-padding">
		<div class="row">
			<div class="col-md-12">

				<?php
				/**
				 * woocommerce_after_single_product_summary hook.
				 *
				 * @hooked woocommerce_output_product_data_tabs - 10
				 * @hooked woocommerce_upsell_display - 15
				 * @hooked woocommerce_output_related_products - 20
				 */
				do_action( 'woocommerce_after_single_product_summary' );
				?>

			</div>
		</div>
	</div>

</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
