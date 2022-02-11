<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

$page_sidebar1 = Brook_Global::instance()->get_sidebar_1();
$page_sidebar2 = Brook_Global::instance()->get_sidebar_2();

$category_per_page = 4;

$lg_columns = Brook::setting( 'shop_archive_lg_columns' );

$product_cols = "xs:1;sm:2;lg:{$lg_columns}";
$col_gutter   = 'xs:30;lg:50';
$row_gutter   = 'xs:30;lg:50';

if ( $page_sidebar1 !== 'none' || $page_sidebar2 !== 'none' ) {
	$category_per_page = 3;

	//$product_cols = 'xs:1;sm:2;lg:2';
}

if ( Brook::setting( 'shop_archive_layout' ) === 'wide' ) {
	//$product_cols = 'xs:1;md:2;lg:3';

	$col_gutter = 'lg:30';
	$row_gutter = 'lg:30';
}
?>

<?php Brook_Templates::title_bar(); ?>
	<div id="page-content" class="page-content">
		<div class="container">
			<div class="row">

				<?php Brook_Templates::render_sidebar( 'left' ); ?>

				<div class="page-main-content">

					<?php
					/**
					 * woocommerce_archive_description hook.
					 *
					 * @hooked woocommerce_taxonomy_archive_description - 10
					 * @hooked woocommerce_product_archive_description - 10
					 */
					do_action( 'woocommerce_archive_description' );
					?>

					<?php
					$shop_page_display = get_option( 'woocommerce_shop_page_display', '' );

					if ( function_exists( 'is_shop' ) && is_shop() && $shop_page_display !== '' ) {
						woocommerce_output_product_categories( array(
							'before' => '<div class="cats tm-swiper" data-lg-items="' . $category_per_page . '" data-sm-items="2" data-xs-items="1" data-lg-gutter="30" data-nav="1" data-loop="1"><div class="swiper-container"><div class="swiper-wrapper">',
							'after'  => '</div></div></div>',
						) );
					}
					?>

					<?php if ( have_posts() ) : ?>

						<?php if ( ! is_shop() || $shop_page_display !== 'subcategories' ) : ?>
							<?php if ( Brook::setting( 'shop_archive_sorting' ) === '1' ) : ?>
								<div class="archive-shop-actions row row-xs-center">
									<?php
									/**
									 * Hook: woocommerce_before_shop_loop.
									 *
									 * @hooked wc_print_notices - 10
									 * @hooked woocommerce_result_count - 20
									 * @hooked woocommerce_catalog_ordering - 30
									 */
									do_action( 'woocommerce_before_shop_loop' );
									?>
								</div>
							<?php endif; ?>

							<?php if ( wc_get_loop_prop( 'total' ) ) { ?>

								<?php if ( class_exists( 'Vc_Manager' ) ) { ?>
									<?php echo do_shortcode( '[tm_product main_query="1" style="grid" column_gutter="' . $col_gutter . '" row_gutter="' . $row_gutter . '" columns="' . $product_cols . '" ]' ); ?>
								<?php } else { ?>
									<div class="tm-grid-wrapper tm-product style-grid">
										<div class="tm-grid modern-grid has-animation move-up">
											<?php
											while ( have_posts() ) {
												the_post();

												/**
												 * Hook: woocommerce_shop_loop.
												 *
												 * @hooked WC_Structured_Data::generate_product_data() - 10
												 */
												do_action( 'woocommerce_shop_loop' );

												wc_get_template_part( 'content', 'product' );
											}
											?>
										</div>
									</div>
								<?php } ?>

							<?php } ?>

							<?php
							/**
							 * woocommerce_after_shop_loop hook.
							 *
							 * @hooked woocommerce_pagination - 10
							 */
							do_action( 'woocommerce_after_shop_loop' );
							?>
						<?php endif; ?>

					<?php else : ?>

						<?php
						/**
						 * Hook: woocommerce_no_products_found.
						 *
						 * @hooked wc_no_products_found - 10
						 */
						do_action( 'woocommerce_no_products_found' );
						?>

					<?php endif; ?>
				</div>

				<?php Brook_Templates::render_sidebar( 'right' ); ?>

			</div>
		</div>
	</div>
<?php
get_footer( 'shop' );

