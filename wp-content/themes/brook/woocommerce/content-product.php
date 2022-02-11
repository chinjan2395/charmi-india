<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
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

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

$product_id = $product->get_id();
?>
<div <?php wc_product_class( 'grid-item', $product ); ?>>
	<div class="product-wrapper">
		<?php
		if ( function_exists( 'woocommerce_show_product_loop_sale_flash' ) ) {
			woocommerce_show_product_loop_sale_flash();
		}
		?>
		<div class="product-thumbnail">
			<div class="thumbnail">
				<?php woocommerce_template_loop_product_link_open(); ?>

				<div class="product-main-image">
					<?php
					$thumbnail_id = get_post_thumbnail_id();
					Brook_Woo::instance()->get_product_image( $thumbnail_id, 'wp-post-image' );
					?>
				</div>

				<?php
				$image_hover_enable = Brook::setting( 'shop_archive_hover_image' );
				if ( $image_hover_enable === '1' ) {
					$attachment_ids = $product->get_gallery_image_ids();
					if ( $attachment_ids && ! empty( $attachment_ids ) ) {
						?>
						<div class="product-hover-image">
							<?php Brook_Woo::instance()->get_product_image( $attachment_ids[0] ); ?>
						</div>
						<?php

					}
				}
				?>

				<?php woocommerce_template_loop_product_link_close(); ?>
			</div>

			<div class="product-actions">
				<?php woocommerce_template_loop_add_to_cart(); ?>

				<?php Brook_Woo::get_wishlist_button_template(); ?>

				<?php Brook_Woo::get_compare_button_template(); ?>

			</div>
		</div>

		<div class="product-info">
			<?php
			/**
			 * woocommerce_shop_loop_item_title hook.
			 *
			 * @hooked woocommerce_template_loop_product_title - 10
			 */
			do_action( 'woocommerce_shop_loop_item_title' );

			/**
			 * woocommerce_after_shop_loop_item_title hook.
			 *
			 * @hooked woocommerce_template_loop_rating - 5
			 * @hooked woocommerce_template_loop_price - 10
			 */
			do_action( 'woocommerce_after_shop_loop_item_title' );
			?>
		</div>
	</div>
</div>
