<?php

function bosa_store_default_styles(){

	// Begin Style
	$css = '<style>';

	/* Site Title */
	$site_title_color = get_theme_mod( 'site_title_color', '#030303' );
	$site_tagline_color = get_theme_mod( 'site_tagline_color', '#767676' );
	$css .= '
		/* Site Title */
		.header-four .site-branding .site-title {
			color: '. esc_attr( $site_title_color ) .';
		}
		/* Tagline */
		.header-four .site-branding .site-description {
			color: '. esc_attr( $site_tagline_color ) .';
		}
	';

	# Header Color
	/* Top Header Background */
	$top_header_background_color = get_theme_mod( 'top_header_background_color', '' );
	$top_header_text_color = get_theme_mod( 'top_header_text_color', '#333333' );
	$top_header_text_link_hover_color = get_theme_mod( 'top_header_text_link_hover_color', '#086abd' );
	$css .= '
		.header-four .top-header {
			background-color: '. esc_attr( $top_header_background_color ) .';
		}
	';
	$css .= '
		.header-four .header-navigation ul li a,
		.header-four .header-contact ul a,
		.header-four .header-contact ul li {
			color: '. esc_attr( $top_header_text_color ) .';
		}

		.header-four .header-navigation ul li a:hover,
		.header-four .header-navigation ul li a:focus,
		.header-four .header-navigation ul li a:active,
		.header-four .header-contact ul a:hover,
		.header-four .header-contact ul a:focus,
		.header-four .header-contact ul a:active {
			color: '. esc_attr( $top_header_text_link_hover_color ) .';
		}
	';
	
	/* Mid Header Background */
	$mid_header_background_color = get_theme_mod( 'mid_header_background_color', '' );
	$mid_header_text_color = get_theme_mod( 'mid_header_text_color', '#333333' );
	$mid_header_text_link_hover_color = get_theme_mod( 'mid_header_text_link_hover_color', '#086abd' );
	$css .= '
		.mid-header .overlay {
			background-color: '. esc_attr( $mid_header_background_color ) .';
		}
	';

	$css .= '
		.mid-header .header-cart a.cart-icon, 
		.mid-header .header-my-account a, 
		.mid-header .header-wishlist a, 
		.mid-header .header-compare a {
			color: '. esc_attr( $mid_header_text_color ) .';
		}
		.header-right .header-svg-icon svg path {
			fill: '. esc_attr( $mid_header_text_color ) .';
		}
		.mid-header .header-cart a.cart-icon:hover, 
		.mid-header .header-cart a.cart-icon:focus, 
		.mid-header .header-cart a.cart-icon:active,
		.header-four .site-branding .site-title a:hover,
		.header-four .site-branding .site-title a:focus,
		.header-four .site-branding .site-title a:active,
		.mid-header .header-my-account a:hover, 
		.mid-header .header-my-account a:focus, 
		.mid-header .header-my-account a:active, 
		.mid-header .header-wishlist a:hover, 
		.mid-header .header-wishlist a:focus, 
		.mid-header .header-wishlist a:active, 
		.mid-header .header-compare a:hover,
		.mid-header .header-compare a:focus,
		.mid-header .header-compare a:active {
			color: '. esc_attr( $mid_header_text_link_hover_color ) .';
		}
		.header-right a:hover .header-svg-icon svg path,
		.header-right a:focus .header-svg-icon svg path {
			fill: '. esc_attr( $mid_header_text_link_hover_color ) .';
		}
	';

	# Header Image / Slider
	#Header Image Height
	$header_image_height = get_theme_mod( 'header_image_height', 110 );
	$css .= '
		@media only screen and (min-width: 992px) {
			.site-header:not(.sticky-header) .header-image-wrap {
				height: '. esc_attr( $header_image_height ) .'px;
				width: 100%;
				position: relative;
			}
		}
	';

	/* Bottom Header Background */
	$bottom_header_background_color 	 = get_theme_mod( 'bottom_header_background_color', '' );
	$bottom_header_text_color 			 = get_theme_mod( 'bottom_header_text_color', '#333333' );
	$bottom_header_text_link_hover_color = get_theme_mod( 'bottom_header_text_link_hover_color', '#086abd' );
	$css .= '
		.header-four .bottom-header {
			background-color: '. esc_attr( $bottom_header_background_color ) .';
		}
		.header-four .social-profile ul li a,
		.header-four .main-navigation ul.menu > li > a {
			color: '. esc_attr( $bottom_header_text_color ) .';
		}
		.header-four .alt-menu-icon .icon-bar, 
		.header-four .alt-menu-icon .icon-bar:before, 
		.header-four .alt-menu-icon .icon-bar:after {
			background-color: '. esc_attr( $bottom_header_text_color ) .';
		}
		.header-four .main-navigation ul.menu li a:hover,
		.header-four .main-navigation ul.menu li a:focus,
		.header-four .main-navigation ul.menu li a:active,
		.header-four .main-navigation ul.menu li.current-menu-item > a,
		.header-four .main-navigation ul.menu li.current_page_item > a,
		.header-four .main-navigation ul.menu > li:hover > a, 
		.header-four .main-navigation ul.menu > li:focus > a, 
		.header-four .main-navigation ul.menu > li:active > a, 
		.header-four .social-profile ul li a:hover,
		.header-four .social-profile ul li a:focus,
		.header-four .social-profile ul li a:active {
			color: '. esc_attr( $bottom_header_text_link_hover_color ) .';
		}
		.header-four .alt-menu-icon a:hover .icon-bar, 
		.header-four .alt-menu-icon a:focus .icon-bar, 
		.header-four .alt-menu-icon a:active .icon-bar, 
		.header-four .alt-menu-icon a:hover .icon-bar:before, 
		.header-four .alt-menu-icon a:focus .icon-bar:before, 
		.header-four .alt-menu-icon a:active .icon-bar:before, 
		.header-four .alt-menu-icon a:hover .icon-bar:after,
		.header-four .alt-menu-icon a:focus .icon-bar:after,
		.header-four .alt-menu-icon a:active .icon-bar:after {
			background-color: '. esc_attr( $bottom_header_text_link_hover_color ) .';
		}
	';

	$feature_posts_height = get_theme_mod( 'feature_posts_height', 350 );
	$css .= '
		.feature-posts-layout-one .feature-posts-image {
			height: '. esc_attr( $feature_posts_height ) .'px;
			overflow: hidden;
		}
	';

	#Bottom Footer image width
	if( get_theme_mod( 'footer_layout', 'footer_three' ) == 'footer_one' || get_theme_mod( 'footer_layout', 'footer_three' ) == 'footer_two' ){
		$bottom_footer_image_width = get_theme_mod( 'bottom_footer_image_width', 270 );
		$css .= '
			.bottom-footer-image-wrap > a {
				max-width: '. esc_attr( $bottom_footer_image_width ) .'px;
				overflow: hidden;
				display: inline-block;
			}
		';
	}

	$site_primary_color = get_theme_mod( 'site_primary_color', '#EB5A3E' );
	$css .= '
		/* Primary Background */
		.header-cart a.cart-icon span.count {
			background-color: '. esc_attr( $site_primary_color ) .';
		}
	';

	# Theme Skins
	# Dark Skin
	if( get_theme_mod( 'skin_select', 'default' ) == 'dark' ){
		$css .= '
			.header-four .header-search-form form,
			.header-search-form input.header-search-input {
				border-color: #1a1a1a;
			}
			body.woocommerce-page select.header-search-select,
			.mid-header .header-cart a.cart-icon, 
			.mid-header .header-my-account a, 
			.mid-header .header-wishlist a, 
			.mid-header .header-compare a,
			.header-four .social-profile ul li a {
				color: #B1B1B1;
			}
			body.woocommerce-page select.header-search-select {
				background-color: transparent;
				border: none;
			}
			.header-cart-block:hover ul.site-header-cart, 
			.header-cart-block:focus ul.site-header-cart, 
			.header-cart-block:active ul.site-header-cart {
				background-color: #080808;
				border-color: #080808;
			}
			.header-cart .widget_shopping_cart .buttons a {
				background-color: #333333;
				color: #ffffff;
			}
			.woocommerce .widget_shopping_cart .total, 
			.woocommerce.widget_shopping_cart .total {
				border-top-color: #1a1a1a;
			}
		';
	}
	
	// End Style
	$css .= '</style>';

	// return generated & compressed CSS
	echo str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $css); 
}
add_action( 'wp_head', 'bosa_store_default_styles', 99 );