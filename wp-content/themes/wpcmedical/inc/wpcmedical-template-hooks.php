<?php
/**
 * WPCmedical hooks
 *
 * @package wpcmedical
 */

/**
 * General
 *
 * @see  wpcmedical_get_sidebar()
 */

add_action( 'wpcmedical_sidebar', 'wpcmedical_get_sidebar', 10 );

/**
 * Header
 *
 * @see  wpcmedical_skip_links()
 * @see  wpcmedical_secondary_navigation()
 * @see  wpcmedical_site_branding()
 * @see  wpcmedical_primary_navigation()
 */
add_action( 'wpcmedical_header', 'wpcmedical_header_container', 0 );
add_action( 'wpcmedical_header', 'wpcmedical_header_row', 1 );
add_action( 'wpcmedical_header', 'wpcmedical_skip_links', 5 );
add_action( 'wpcmedical_header', 'wpcmedical_handheld_navigation_button', 10 );
add_action( 'wpcmedical_header', 'wpcmedical_site_branding', 15 );
add_action( 'wpcmedical_header', 'wpcmedical_header_woo_buttons', 21 );
add_action( 'wpcmedical_header', 'wpcmedical_header_woo_buttons_close', 36 );
add_action( 'wpcmedical_header', 'wpcmedical_header_row_close', 41 );
add_action( 'wpcmedical_header', 'wpcmedical_header_row', 42 );
add_action( 'wpcmedical_header', 'wpcmedical_primary_navigation', 50 );
add_action( 'wpcmedical_header', 'wpcmedical_header_row_close', 69 );
add_action( 'wpcmedical_header', 'wpcmedical_header_row', 70 );
add_action( 'wpcmedical_header', 'wpcmedical_handheld_navigation', 75 );
add_action( 'wpcmedical_header', 'wpcmedical_header_row_close', 79 );
add_action( 'wpcmedical_header', 'wpcmedical_header_container_close', 99 );

/**
 * Before Content
 *
 * @see  open_page_title_tag()
 * @see  woocommerce_breadcrumb()
 * @see  wpcmedical_page_title()
 * @see  close_page_title_tag()
 */

add_action( 'wpcmedical_before_content', 'open_page_title_tag', 9 );

add_action( 'wpcmedical_before_content', 'wpcmedical_page_title', 10 );
if ( wpcmedical_is_woocommerce_activated() ) {
	add_action( 'wpcmedical_before_content', 'woocommerce_breadcrumb', 11 );
}

add_action( 'wpcmedical_before_content', 'close_page_title_tag', 12 );

/**
 * Footer
 *
 * @see  wpcmedical_footer_widgets()
 * @see  wpcmedical_credit()
 */
add_action( 'wpcmedical_footer', 'wpcmedical_footer_widgets', 10 );
add_action( 'wpcmedical_footer', 'wpcmedical_credit', 20 );


/**
 * Posts
 *
 * @see  wpcmedical_post_header()
 * @see  wpcmedical_post_meta()
 * @see  wpcmedical_post_content()
 * @see  wpcmedical_paging_nav()
 * @see  wpcmedical_single_post_header()
 * @see  wpcmedical_post_nav()
 * @see  wpcmedical_display_comments()
 */
add_action( 'wpcmedical_loop_post', 'wpcmedical_post_header', 10 );
add_action( 'wpcmedical_loop_post', 'wpcmedical_post_content', 30 );
add_action( 'wpcmedical_loop_after', 'wpcmedical_paging_nav', 10 );
add_action( 'wpcmedical_single_post', 'wpcmedical_post_header', 10 );
add_action( 'wpcmedical_single_post', 'wpcmedical_post_content', 30 );
add_action( 'wpcmedical_single_post_bottom', 'wpcmedical_edit_post_link', 5 );
add_action( 'wpcmedical_single_post_bottom', 'wpcmedical_display_comments', 20 );
add_action( 'wpcmedical_post_header_after', 'wpcmedical_post_meta', 10 );
add_action( 'wpcmedical_post_content_before', 'wpcmedical_post_thumbnail', 10 );

/**
 * Pages
 *
 * @see  wpcmedical_page_header()
 * @see  wpcmedical_page_content()
 * @see  wpcmedical_display_comments()
 */
add_action( 'wpcmedical_page', 'wpcmedical_page_header', 10 );
add_action( 'wpcmedical_page', 'wpcmedical_page_content', 20 );
add_action( 'wpcmedical_page', 'wpcmedical_edit_post_link', 30 );
add_action( 'wpcmedical_page_after', 'wpcmedical_display_comments', 10 );

/**
 * Homepage Page Template
 *
 * @see  wpcmedical_homepage_header()
 * @see  wpcmedical_page_content()
 */
add_action( 'homepage', 'wpcmedical_homepage_content', 20 );
//add_action('wpcmedical_homepage', 'wpcmedical_homepage_header', 10);
add_action( 'wpcmedical_homepage', 'wpcmedical_page_content', 20 );
