<?php
/**
 * WPCmedical WooCommerce hooks
 *
 * @package wpcmedical
 */

/**
 * Homepage
 *
 * @see  wpcmedical_homepage_products()
 */
add_action( 'homepage', 'wpcmedical_homepage_products', 20 );

/**
 * Layout
 *
 * @see  wpcmedical_before_content()
 * @see  wpcmedical_after_content()
 * @see  woocommerce_breadcrumb()
 * @see  wpcmedical_shop_messages()
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

add_action( 'woocommerce_before_main_content', 'wpcmedical_before_content', 10 );
add_action( 'woocommerce_after_main_content', 'wpcmedical_after_content', 10 );
add_action( 'wpcmedical_content_top', 'wpcmedical_shop_messages', 15 );
add_action( 'woocommerce_before_shop_loop', 'wpcmedical_sorting_wrapper', 9 );
add_action( 'woocommerce_before_shop_loop', 'wpcmedical_button_grid_list_layout', 30 );
add_action( 'woocommerce_before_shop_loop', 'wpcmedical_sorting_wrapper_close', 31 );

/**
 * Products
 *
 * @see wpcmedical_edit_post_link()
 * @see wpcmedical_upsell_display()
 */
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );

add_action( 'woocommerce_single_product_summary', 'woocommerce_show_product_sale_flash', 4 );
add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', - 1 );
add_action( 'woocommerce_before_shop_loop_item_title', 'wpcmedical_product_label_stock', 9 );
add_action( 'woocommerce_after_shop_loop_item_title', 'wpcmedical_woocommerce_get_product_description', 15 );
add_action( 'woocommerce_single_product_summary', 'wpcmedical_edit_post_link', 60 );
add_action( 'woocommerce_after_single_product_summary', 'wpcmedical_upsell_display', 15 );
add_action( 'woocommerce_after_add_to_cart_button', 'wpcmedical_compare_button', 20 );
add_action( 'woocommerce_after_add_to_cart_button', 'wpcmedical_wishlist_button', 30 );

/**
 * WPC plugins compatible
 */
// quick view
add_filter( 'woosq_button_position', function () {
	return 'after_add_to_cart';
} );

// compare
add_filter( 'woosc_button_position_single', '__return_false' );
add_filter( 'woosc_button_position_archive', function () {
	return 'after_add_to_cart';
} );
add_filter( 'woosc_bar_bg_color_default', function () {
	return '#222222';
}, 10 );
add_filter( 'woosc_bar_btn_color_default', function () {
	return '#5C98F6';
}, 10 );

// wishlist
add_filter( 'woosw_button_position_single', '__return_false' );
add_filter( 'woosw_button_position_archive', function () {
	return 'after_add_to_cart';
} );
add_filter( 'woosw_color_default', function () {
	return '#5C98F6';
}, 10 );

/**
 * Header
 *
 * @see wpcmedical_product_search()
 * @see wpcmedical_header_wishlist()
 * @see wpcmedical_header_cart()
 */
add_action( 'wpcmedical_header', 'wpcmedical_product_search', 20 );
add_action( 'wpcmedical_header', 'wpcmedical_header_account', 25 );
add_action( 'wpcmedical_header', 'wpcmedical_header_wishlist', 27 );
add_action( 'wpcmedical_header', 'wpcmedical_header_cart', 30 );

/**
 * Cart fragment
 *
 * @see wpcmedical_cart_link_fragment()
 */
add_filter( 'woocommerce_add_to_cart_fragments', 'wpcmedical_cart_link_fragment' );

/**
 * Removing the title on the WooCommerce archive pages
 */
add_filter( 'woocommerce_show_page_title', '__return_null' );
